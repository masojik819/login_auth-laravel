<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/about', function () {
    return view('about');
})->middleware(['auth', 'verified'])->name('about');

Route::get('/post', function () {
    return view('posts');
// })->middleware(['auth', 'verified','posts'=>Post::filter(request(['search']))->latest()->simplePaginate(12)])->name('posts');
})->middleware(['auth', 'verified'])->name('post');

// Route::get('/posts', function () {

// return view('posts', [
//     'title' => 'Blog',
//     'posts' =>Post::filter(request(['search']))->latest()->simplePaginate(12)
// ]);
//     // return 'hello world';
// });


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
