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





// for settings
// group routes middleware
// admin only routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/settings', 'App\Http\Controllers\FrontEndController@settings')->name('settings');
    Route::post('/settings/update', 'App\Http\Controllers\FrontEndController@settingsUpdate')->name('settings.update');
    Route::get("/admin/settings/update/form", "App\Http\Controllers\AdminController@settingsUpdateForm")->name("settings.update.form");

    Route::post("/admin/settings/update", "App\Http\Controllers\AdminController@settingsUpdate")->name("settings.update");


    // for categories

    Route::get("/admin/categories/create/form", "App\Http\Controllers\AdminController@createCategoryForm")->name("admin.category.create.form");

    Route::post("/admin/categories/create", "App\Http\Controllers\AdminController@createCategory")->name("admin.category.create");
    Route::get("/admin/categories/getCategories", "App\Http\Controllers\AdminController@getCategories")->name("admin.category.getCategories");
    Route::get("/admin/categories/update/{cat_id}", "App\Http\Controllers\AdminController@updateCategoryForm")->name("admin.category.update.form");
    Route::post("/admin/categories/update/{cat_id}", "App\Http\Controllers\AdminController@updateCategory")->name("admin.category.update");

    Route::get("/admin/categories/delete/{cat_id}", "App\Http\Controllers\AdminController@deleteCategory")->name("admin.category.delete");


    Route::get("/admin/users", "App\Http\Controllers\AdminController@getUsers")->name('admin.user.getUsers');
    Route::get("/admin/writers", "App\Http\Controllers\AdminController@getWriters")->name('admin.user.getWriters');


    // Admin Event routes
    Route::get("/admin/events/create/form", "App\Http\Controllers\AdminController@createEventForm")->name("admin.event.create.form");

    Route::post("/admin/events/create", "App\Http\Controllers\AdminController@createEvent")->name("admin.event.create");
    Route::get("/admin/events/get-events", "App\Http\Controllers\AdminController@getEvents")->name("admin.event.getEvents");
    Route::get("/admin/events/update/{event_id}", "App\Http\Controllers\AdminController@updateEventForm")->name("admin.event.update.form");
    Route::post("/admin/events/update/{event_id}", "App\Http\Controllers\AdminController@updateEvent")->name("admin.event.update");

    Route::get("/admin/events/delete/{event_id}", "App\Http\Controllers\AdminController@deleteEvent")->name("admin.event.delete");


    //  Writer request route
    Route::get("/admin/writer-requests", "App\Http\Controllers\AdminController@writerRequests")->name("admin.writer.requests");
    Route::get("/admin/writer-requests/delete/{writer_request_id}", "App\Http\Controllers\AdminController@deleteWriterRequest")->name("admin.writer.request.delete");
    Route::get("/admin/writer-requests/approve/{writer_user_id}", "App\Http\Controllers\AdminController@approveWriterRequest")->name("admin.writer.request.approve");
    Route::get("/admin/writer-requests/ban/{writer_user_id}", "App\Http\Controllers\AdminController@banWriter")->name("admin.writer.ban");

    // Advertiser requests route
    Route::get("/admin/advert-requests", "App\Http\Controllers\AdminController@advertRequests")->name("admin.advert.requests");
    Route::get("/admin/advert-requests/delete/{advert_request_id}", "App\Http\Controllers\AdminController@deleteAdvertRequest")->name("admin.advert.request.delete");
    Route::get("/admin/advert-requests/approve/{advert_user_id}", "App\Http\Controllers\AdminController@approveAdvertRequest")->name("admin.advert.request.approve");
    Route::get("/admin/advert-requests/ban/{advert_user_id}", "App\Http\Controllers\AdminController@banAdvertiser")->name("admin.advertiser.ban");


    // Admin USER CRUD


    Route::get("/admin/users/profile/{user_id}", "App\Http\Controllers\AdminController@getProfile")->name('admin.user.getProfile');
    Route::get("/admin/users/update/form/{user_id}", "App\Http\Controllers\AdminController@updateUserForm")->name('admin.user.update.form');

    Route::post("/admin/users/update/{user_id}", "App\Http\Controllers\AdminController@updateUser")->name('admin.user.update');
    Route::get("/admin/users/delete/{user_id}", "App\Http\Controllers\AdminController@deleteUser")->name('admin.user.delete');
    Route::post("/admin/users/photo/update/{user_id}", "App\Http\Controllers\AdminController@updateProfilePhoto")->name('admin.user.photo.update');



});

// admin or writer routes
Route::middleware(['auth', 'adminOrWriter'])->group(function () {
    // for posts


    Route::get("/admin/posts/create/form", "App\Http\Controllers\AdminController@createPostForm")->name("admin.post.create.form");

    Route::post("/admin/posts/create", "App\Http\Controllers\AdminController@createPost")->name("admin.post.create");
    Route::get("/admin/posts/get-posts", "App\Http\Controllers\AdminController@getPosts")->name("admin.post.getPosts");
    Route::get("/admin/posts/update/{post_id}", "App\Http\Controllers\AdminController@updatePostForm")->name("admin.post.update.form");
    Route::post("/admin/posts/update/{post_id}", "App\Http\Controllers\AdminController@updatePost")->name("admin.post.update");

    Route::get("/admin/posts/delete/{post_id}", "App\Http\Controllers\AdminController@deletePost")->name("admin.post.delete");

    // Admin Video routes
    Route::get("/admin/videos/create/form", "App\Http\Controllers\AdminController@createVideoForm")->name("admin.video.create.form");

    Route::post("/admin/videos/create", "App\Http\Controllers\AdminController@createVideo")->name("admin.video.create");
    Route::get("/admin/videos/get-videos", "App\Http\Controllers\AdminController@getVideos")->name("admin.video.getVideos");
    Route::get("/admin/videos/update/{video_id}", "App\Http\Controllers\AdminController@updateVideoForm")->name("admin.video.update.form");
    Route::post("/admin/videos/update/{video_id}", "App\Http\Controllers\AdminController@updateVideo")->name("admin.video.update");

    Route::get("/admin/videos/delete/{video_id}", "App\Http\Controllers\AdminController@deleteVideo")->name("admin.video.delete");


    Route::get("/admin/home", "App\Http\Controllers\AdminController@home")->name("admin.home");




});


// auth routes
Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//pages
Route::get("client/write/form", "App\Http\Controllers\FrontEndController@writeForUsForm")->middleware('auth')->name("client.write.for.us.form");
Route::post("client/write", "App\Http\Controllers\FrontEndController@writeForUs")->middleware('auth')->name("client.write.for.us");

Route::get("client/contact-us/form", "App\Http\Controllers\FrontEndController@contactUsForm")->name("client.contact.us.form");
Route::post("client/contact-us", "App\Http\Controllers\FrontEndController@contactUs")->name("client.contact.us");


Route::get("client/about-us", "App\Http\Controllers\FrontEndController@aboutUsForm")->name("client.about.us");


Route::get("client/advertise/form", "App\Http\Controllers\FrontEndController@advertiseForm")->middleware('auth')->name("client.advertise.form");
Route::post("client/advertise", "App\Http\Controllers\FrontEndController@advertise")->middleware('auth')->name("client.advertise");


Route::get("client/events", "App\Http\Controllers\FrontEndController@clientGetEvents")->name("client.events");



Route::get('/', 'App\Http\Controllers\FrontEndController@home')->name('home');

// ck file upload

Route::post("client/ck/upload", "App\Http\Controllers\FrontEndController@ckUpload")->name("ck.upload");

Route::get("client/posts/post-detail/{post_id}", "App\Http\Controllers\FrontEndController@clientGetPost")->name("client.posts.post-detail");
Route::get("client/posts/category/{cat_id}", "App\Http\Controllers\FrontEndController@clientGetPostsByCategory")->name("client.category.posts");
