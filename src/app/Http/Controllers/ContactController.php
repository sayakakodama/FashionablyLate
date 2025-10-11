<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthorRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    public function register(AuthorRequest $request)
    {
        $register = $request->only(['name', 'email', 'password']);
        return view('register', compact('register'));
    }

    public function login(LoginRequest $request)
    {
        $login = $request->only(['email', 'password']);
        return view('login', compact('login'));
    }

    public function adminIndex()
    {
        $contacts = Contact::with('category')->paginate(7);
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }

    public function search(Request $request)
    {
        $query = Contact::query()->with('category');

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', "%{$request->keyword}%")
                  ->orWhere('last_name', 'like', "%{$request->keyword}%")
                  ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ["%{$request->keyword}%"])
                  ->orWhere('email', 'like', "%{$request->keyword}%");
            });
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->paginate(7)->appends($request->query());
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()
            ->route('admin.contacts.index')
            ->with('success', 'お問い合わせ内容を削除しました。');
    }

    public function index()
    {
        $categories = Category::all();
        return view('contact', compact('categories'));
    }

    public function confirm(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect()->route('contact.index');
        }

        $validated = $request->validate([
            'last_name'    => 'required|string|max:255',
            'first_name'   => 'required|string|max:255',
            'gender'       => 'required|in:男性,女性,その他',
            'email'        => 'required|email|max:255',
            'tel1'         => 'required|digits_between:2,4',
            'tel2'         => 'required|digits_between:2,4',
            'tel3'         => 'required|digits_between:3,4',
            'address'      => 'required|string|max:255',
            'building'     => 'nullable|string|max:255',
            'category_id'  => 'required|exists:categories,id',
            'content'      => 'required|string|max:1000',
        ]);

        $data = $validated;
        $data['tel'] = "{$request->tel1}-{$request->tel2}-{$request->tel3}";

        return view('confirm', compact('data'));
    }

    public function store(Request $request)
    {
        if ($request->input('action') === 'back') {
            return redirect()->route('contact.index')->withInput();
        }

        Contact::create([
            'last_name'   => $request->input('last_name'),
            'first_name'  => $request->input('first_name'),
            'gender'      => $request->input('gender'),
            'email'       => $request->input('email'),
            'tel'         => "{$request->input('tel1')}-{$request->input('tel2')}-{$request->input('tel3')}",
            'address'     => $request->input('address'),
            'building'    => $request->input('building'),
            'category_id' => $request->input('category_id'),
            'content'     => $request->input('content'),
        ]);
        return redirect()->route('contact.thanks');
    }
}
