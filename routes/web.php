<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\BookRequestsController;
use App\Http\Controllers\Admin\BooksController;
use App\Http\Controllers\Admin\LibrariansController;
use App\Http\Controllers\Admin\LibrariesController;
use App\Http\Controllers\Admin\MagazinesController;
use App\Http\Controllers\Admin\PaymentRequestsController;
use App\Http\Controllers\Admin\RentRequestsController;
use App\Http\Controllers\Admin\TeachersController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);
Route::post('/search', [HomeController::class, 'search'])->name('search');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
Route::post('/profile', [HomeController::class, 'profile_post'])->name('profile.edit');

Route::get('/library/{id}', [LibraryController::class, 'show'])->name('libraries.show');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');

Route::group(['middleware' => 'auth:users'], function() {
    Route::post('/books/{id}/request_book', [BookController::class, 'request_book'])->name('books.request_book');
    Route::post('/books/{id}/rent_book', [BookController::class, 'rent_book'])->name('books.rent_book');
    Route::post('/books/{id}/buy_book', [BookController::class, 'buy_book'])->name('books.buy_book');
    Route::post('/books/{id}/send_message', [BookController::class, 'send_message'])->name('books.send_message');
});

Route::post('contact-us', [HomeController::class, 'contact'])->name('contact');

Route::group(['prefix'=>'admin','as'=>'admin.'], function(){
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('showLoginForm');
    Route::post('/login', [LoginController::class, 'login'])->name('login');

    Route::group(['middleware' => 'auth:admins'], function(){

        Route::get('/', [UsersController::class, 'index']);
        Route::get('/users', [UsersController::class, 'index'])->name('users');
        Route::get('users/create', [UsersController::class, 'create'])->name('users.create');
        Route::post('users/store', [UsersController::class, 'store'])->name('users.store');
        Route::get('users/edit/{id}', [UsersController::class, 'edit'])->name('users.edit');
        Route::patch('users/update/{id}', [UsersController::class, 'update'])->name('users.update');
        Route::get('users/delete/{id}', [UsersController::class, 'destroy'])->name('users.destroy');

        Route::get('/librarians', [LibrariansController::class, 'index'])->name('librarians');
        Route::get('librarians/create', [LibrariansController::class, 'create'])->name('librarians.create');
        Route::post('librarians/store', [LibrariansController::class, 'store'])->name('librarians.store');
        Route::get('librarians/edit/{id}', [LibrariansController::class, 'edit'])->name('librarians.edit');
        Route::patch('librarians/update/{id}', [LibrariansController::class, 'update'])->name('librarians.update');
        Route::get('librarians/delete/{id}', [LibrariansController::class, 'destroy'])->name('librarians.destroy');

        Route::get('/teachers', [TeachersController::class, 'index'])->name('teachers');
        Route::get('teachers/create', [TeachersController::class, 'create'])->name('teachers.create');
        Route::post('teachers/store', [TeachersController::class, 'store'])->name('teachers.store');
        Route::get('teachers/edit/{id}', [TeachersController::class, 'edit'])->name('teachers.edit');
        Route::patch('teachers/update/{id}', [TeachersController::class, 'update'])->name('teachers.update');
        Route::get('teachers/delete/{id}', [TeachersController::class, 'destroy'])->name('teachers.destroy');

        Route::get('/admins', [AdminsController::class, 'index'])->name('admins');
        Route::get('admins/create', [AdminsController::class, 'create'])->name('admins.create');
        Route::post('admins/store', [AdminsController::class, 'store'])->name('admins.store');
        Route::get('admins/edit/{id}', [AdminsController::class, 'edit'])->name('admins.edit');
        Route::patch('admins/update/{id}', [AdminsController::class, 'update'])->name('admins.update');
        Route::get('admins/delete/{id}', [AdminsController::class, 'destroy'])->name('admins.destroy');

        Route::get('/libraries', [LibrariesController::class, 'index'])->name('libraries');
        Route::get('libraries/create', [LibrariesController::class, 'create'])->name('libraries.create');
        Route::post('libraries/store', [LibrariesController::class, 'store'])->name('libraries.store');
        Route::get('libraries/edit/{id}', [LibrariesController::class, 'edit'])->name('libraries.edit');
        Route::patch('libraries/update/{id}', [LibrariesController::class, 'update'])->name('libraries.update');
        Route::get('libraries/delete/{id}', [LibrariesController::class, 'destroy'])->name('libraries.destroy');

        Route::get('/books', [BooksController::class, 'index'])->name('books');
        Route::get('books/create', [BooksController::class, 'create'])->name('books.create');
        Route::post('books/store', [BooksController::class, 'store'])->name('books.store');
        Route::get('books/edit/{id}', [BooksController::class, 'edit'])->name('books.edit');
        Route::patch('books/update/{id}', [BooksController::class, 'update'])->name('books.update');
        Route::get('books/delete/{id}', [BooksController::class, 'destroy'])->name('books.destroy');

        Route::get('/magazines', [MagazinesController::class, 'index'])->name('magazines');
        Route::get('magazines/create', [MagazinesController::class, 'create'])->name('magazines.create');
        Route::post('magazines/store', [MagazinesController::class, 'store'])->name('magazines.store');
        Route::get('magazines/edit/{id}', [MagazinesController::class, 'edit'])->name('magazines.edit');
        Route::patch('magazines/update/{id}', [MagazinesController::class, 'update'])->name('magazines.update');
        Route::get('magazines/delete/{id}', [MagazinesController::class, 'destroy'])->name('magazines.destroy');

        Route::get('/book_requests', [BookRequestsController::class, 'index'])->name('book_requests');

        Route::get('/payment_requests', [PaymentRequestsController::class, 'index'])->name('payment_requests');

        Route::get('/rent_requests', [RentRequestsController::class, 'index'])->name('rent_requests');

        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    });
});

Route::group(['prefix'=>'librarian','as'=>'librarian.'], function(){
    Route::get('/login', [Librarian\Auth\LoginController::class, 'showLoginForm'])->name('showLoginForm');
    Route::post('/login', [Librarian\Auth\LoginController::class, 'login'])->name('login');

    Route::group(['middleware' => 'auth:librarians'], function(){

        Route::get('/', [Librarian\BooksController::class, 'index']);
        Route::get('/books', [Librarian\BooksController::class, 'index'])->name('books');
        Route::get('books/create', [Librarian\BooksController::class, 'create'])->name('books.create');
        Route::post('books/store', [Librarian\BooksController::class, 'store'])->name('books.store');
        Route::get('books/edit/{id}', [Librarian\BooksController::class, 'edit'])->name('books.edit');
        Route::patch('books/update/{id}', [Librarian\BooksController::class, 'update'])->name('books.update');
        Route::get('books/delete/{id}', [Librarian\BooksController::class, 'destroy'])->name('books.destroy');

        Route::get('/book_requests', [Librarian\BookRequestsController::class, 'index'])->name('book_requests');

        Route::get('/payment_requests', [Librarian\PaymentRequestsController::class, 'index'])->name('payment_requests');

        Route::get('/rent_requests', [Librarian\RentRequestsController::class, 'index'])->name('rent_requests');

        Route::post('/logout', [Librarian\Auth\LoginController::class, 'logout'])->name('logout');

    });
});

Route::group(['prefix'=>'teacher','as'=>'teacher.'], function() {
    Route::get('/login', [Teacher\Auth\LoginController::class, 'showLoginForm'])->name('showLoginForm');
    Route::post('/login', [Teacher\Auth\LoginController::class, 'login'])->name('login');

    Route::group(['middleware' => 'auth:teachers'], function () {
        Route::get('/', [Teacher\MessagesController::class, 'index'])->name('messages');
        Route::get('/show_message', [Teacher\MessagesController::class, 'show_message'])->name('show_message');
    });
});
