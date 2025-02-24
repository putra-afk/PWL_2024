<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return 'welcome';
});

Route::get('/hello', [WelcomeController::class, 'hello']);

Route::get('/world', function () {
    return 'World';
});

Route::get('/about', function () {
    return 'NIM : 2341720240' . '<br>' . 'Nama : Bayu Putra Laksmana';
});

Route::get('/user/{name}', function ($name) {
    return 'Nama saya ' . $name;
});

Route::get('/posts/{post}/comments/{comment}', function ($postId, $commentId) {
    return 'Pos ke-' . $postId . " Komentar ke-: " . $commentId;
});

Route::get('articles/{id}', function ($id) {
    return 'Halaman artikel dengan ID ' . $id;
});

Route::get('/user/{name?}', function ($name = null) {
    return 'Nama saya ' . $name;
});

Route::get('/user/{name?}', function ($name = 'John') {
    return 'Nama saya ' . $name;
});

Route::get('/user/profile', function () {
    //
})->name('profile');

Route::middleware(['first', 'second'])->group(function () {
    Route::get('/', function () {
        // Uses first & second middleware...
    });

    Route::get('/user/profile', function () {
        // Uses first & second middleware...
    });
});

Route::domain('{account}.example.com')->group(function () {
    Route::get('user/{id}', function ($account, $id) {
        //
    });
});

//Route Group and Prefix
//Route group ini akan sering digunakan pada kasus kasus CRUD atau kasus lain yang membutuhkan group tertentu.
Route::middleware(['first', 'second'])->group(function () {
    Route::get('/', function () {
        // Uses first & second middleware...

    });

    Route::get('/user/profile', function () {
        // Uses first & second middleware...
    });
});

Route::domain('{account}.example.com')->group(function () {
    Route::get('user/{id}', function ($account, $id) {
        //
    });
});
Route::middleware('auth')->group(function () {
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/post', [PostController::class, 'index']);
    Route::get('/event', [EventController::class, 'index']);
});

//Route prefix
//Route prefix ini akan sering digunakan pada kasus kasus CRUD atau kasus lain yang membutuhkan prefix tertentu.
Route::prefix('admin')->group(function () {
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/post', [PostController::class, 'index']);
    Route::get('/event', [EventController::class, 'index']);
});

//Redirect Route
//Redirect ini akan sering digunakan pada kasus kasus CRUD atau kasus lain yang membutuhkan redirect ke halaman tertentu.
Route::redirect('/here', '/there');

//view Route
//View Route ini akan sering digunakan pada kasus kasus CRUD atau kasus lain yang membutuhkan view tertentu.
Route::view('/welcome', 'welcome');
Route::view('/welcome', 'welcome', ['name' => 'Taylor']);

//Konsep controller
//Controller Route ini akan sering digunakan pada kasus kasus CRUD atau kasus lain yang membutuhkan controller tertentu.
Route::get('/', [HomeController::class, 'index']);
Route::get('about', [AboutController::class, 'about']);
Route::get('articles/{id}', [ArticleController::class, 'articles']);

//Resource Route
//Resource Route ini akan sering digunakan pada kasus kasus CRUD atau kasus lain yang membutuhkan resource tertentu.
Route::resource('photos', PhotoController::class)->only([
    'index',
    'show'
]);
Route::resource('photos', PhotoController::class)->except([
    'create',
    'store',
    'update',
    'destroy'
]);

//view Route
//View Route ini akan sering digunakan pada kasus kasus CRUD atau kasus lain yang membutuhkan view tertentu.
//Route::get('/greeting', function () {
//return view('blog.hello', ['name' => 'Bayu Putra Laksmana']);
//});
Route::get('/greeting', [WelcomeController::class, 'greeting']);
