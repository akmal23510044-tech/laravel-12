<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/about', function () {
    return view('about');
});

Route::get('/view', function () {
    return view('kota');
});

Route::get('/hello', function () {
    return "Hello World";
});

Route::get('/selamat', function () {
return 'Selamat Datang';
});

Route::get('/about', function () {
    return view("about");
});

Route::get('/user/{name?}', function ($name='paijo') {
return 'Hallo Nama saya '.$name;
});

Route::get('/user/{name}', function ($name) {
return 'Hallo Nama saya '.$name;
});

Route::get('/posts/{post}/comments/{comment}', function
($postId, $commentId) {
return 'Pos ke-'.$postId." Komentar ke-: ".$commentId;
});

Route::get('/articles/{id}', function
($Id) {
return 'Pos ke-'.$postId." Komentar ke-: ".$commentId;
});