<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/register', function () {
    return view('register');
});
Route::post('/register', [ContactController::class, 'register'])->name('register');
Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [ContactController::class, 'login'])->name('login');
Route::prefix('admin')->group(function () {
Route::get('/contacts', [ContactController::class, 'adminIndex'])->name('admin.contacts.index');
Route::get('/contacts/search', [ContactController::class, 'search'])->name('admin.contacts.search');
Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('admin.contacts.destroy');
});
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');
Route::get('/thanks', fn() => view('thanks'))->name('thanks');
Route::get('/confirm', function () {
    return redirect()->route('contact.index');
});

