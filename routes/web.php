<?php

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

Route::get('/', function () {
    return view('posts');
});

Route::get('posts/{post}', function ($slug) {
    $path = __DIR__ . "/../resources/posts/{$slug}.html";

    // // ddd($path);
    
    if(!file_exists($path)){
        // ddd('file does not exist');
        return redirect('/');
    }
    $post = Cache::remember("posts.{$slug}", 5, function () use ($path) {
        var_dump('file_get_contents');
        return file_get_contents($path);
    });
    // $post = file_get_contents($path);

    // // dd($post);

    return view('post', [
        'post' => $post

    ]);

});
