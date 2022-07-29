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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::get('/', 'App\Http\Controllers\FrontendController@index');
Route::get('user/profile/{id}', 'App\Http\Controllers\FrontendController@userAlbum')->name('user.album');
Route::get('/{id}/category', 'App\Http\Controllers\FrontendController@albumCategory')->name('user.category');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/albums/create', [App\Http\Controllers\AlbumController::class, 'create'])->name('albums.create')->middleware('auth');
Route::post('/albums/store', [App\Http\Controllers\AlbumController::class, 'store'])->name('albums.store')->middleware('auth');
Route::get('/albums', [App\Http\Controllers\AlbumController::class, 'index'])->name('albums.index')->middleware('auth');
Route::get('/getalbums', [App\Http\Controllers\AlbumController::class, 'getAlbums'])->name('albums.get')->middleware('auth');
Route::put('/albums/{id}/edit', [App\Http\Controllers\AlbumController::class, 'update'])->name('albums.update')->middleware('auth');
Route::delete('/albums/{id}/delete', [App\Http\Controllers\AlbumController::class, 'destroy'])->name('albums.destroy')->middleware('auth');

Route::get('/albums/{slug}/{id}', [App\Http\Controllers\GalleryController::class, 'viewAlbum'])->name('gallery.view');
Route::get('upload/images/{id}', [App\Http\Controllers\GalleryController::class, 'create'])->name('gallery.create')->middleware('auth');
Route::post('uploadImage', [App\Http\Controllers\GalleryController::class, 'upload'])->name('gallery.upload')->middleware('auth');
Route::get('getImages', [App\Http\Controllers\GalleryController::class, 'images'])->name('gallery.images')->middleware('auth');
Route::delete('/image/{id}', [App\Http\Controllers\GalleryController::class, 'destroy'])->name('gallery.destroy')->middleware('auth');

Route::post('/follow','App\Http\Controllers\FollowController@followUnfollow')->middleware('auth');
Route::get('/profile', 'App\Http\Controllers\FollowController@profile')->name('profile')->middleware('auth');
Route::get('/user/{id}','App\Http\Controllers\FollowController@userProfilePic')->middleware('auth');
Route::post('/profile-pic','App\Http\Controllers\FollowController@updateProfilePic')->middleware('auth');
Route::post('/bg-pic','App\Http\Controllers\FollowController@updatebgPic')->middleware('auth');
Route::get('/user/bg/{id}','App\Http\Controllers\FollowController@userbgPic')->middleware('auth');
