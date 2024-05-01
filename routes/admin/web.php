<?php

use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth',
    'role:admin|super_admin',
])
    ->group(function () {

        Route::name('admin.')->prefix('admin')->group(function () {

            //home
            Route::get('/home/top_statistics', 'HomeController@topStatistics')->name('home.top_statistics');
            Route::get('/home', 'HomeController@index')->name('home');

            //place routes
            Route::get('/places/data', 'PlaceController@data')->name('places.data');
            Route::delete('/places/bulk_delete', 'PlaceController@bulkDelete')->name('places.bulk_delete');
            Route::resource('places', 'PlaceController');
            //stage routes
            Route::get('/stages/data', 'StagesController@data')->name('stages.data');
            Route::delete('/stages/bulk_delete', 'StagesController@bulkDelete')->name('stages.bulk_delete');
            Route::resource('stages', 'StagesController');

            //question routes
            Route::get('/questions/data', 'QuestionController@data')->name('questions.data');
            Route::delete('/questions/bulk_delete', 'QuestionController@bulkDelete')->name('questions.bulk_delete');
            Route::resource('questions', 'QuestionController');


            //user routes
            Route::get('/users/data', 'UserController@data')->name('users.data');
            Route::delete('/users/bulk_delete', 'UserController@bulkDelete')->name('users.bulk_delete');
            Route::get('/users/{id}/status', 'UserController@editUserStatus')->name('users.status');
            //Route::delete('/users/bulk_delete', 'UserController@bulkDelete')->name('users.bulk_delete');
            Route::post('/users/sss', 'UserController@sss')->name('users.sss');
            Route::resource('users', 'UserController');
            //Route::resource('users', 'UserController')->name('test');
    

            //course routes
            Route::get('/courses/data', 'CourseController@data')->name('courses.data');
            Route::delete('/courses/bulk_delete', 'CourseController@bulkDelete')->name('courses.bulk_delete');
            Route::resource('courses', 'CourseController');
            Route::get('/courses/{id}/get_course', 'CourseController@getCourse')->name('users.get_course');

            //chapter routes
            Route::get('/chapters/data', 'ChapterController@data')->name('chapters.data');
            Route::delete('/chapters/bulk_delete', 'ChapterController@bulkDelete')->name('chapters.bulk_delete');
            Route::resource('chapters', 'ChapterController');

            //lecture routes
            Route::get('/lectures/data', 'LectureController@data')->name('lectures.data');
            Route::delete('/lectures/bulk_delete', 'LectureController@bulkDelete')->name('lectures.bulk_delete');
            Route::get('/lectures/{id}/find', 'LectureController@find')->name('lectures.find');

            Route::resource('lectures', 'LectureController');


            //qRvalue routes
            Route::get('/qRvalues/data', 'QRValueController@data')->name('qRvalues.data');
            Route::delete('/qRvalues/bulk_delete', 'QRValueController@bulkDelete')->name('qRvalues.bulk_delete');
            Route::resource('qRvalues', 'QRValueController');//qRvalue routes
    
            // QR
            Route::get('/QR/data', 'QRController@data')->name('QR.data');
            Route::delete('/QR/bulk_delete', 'QRController@bulkDelete')->name('QR.bulk_delete');
            Route::resource('QR', 'QRController');




            //setting routes
            Route::get('/settings/general', 'SettingController@general')->name('settings.general');
            Route::resource('settings', 'SettingController')->only(['store']);

            //profile routes
            Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
            Route::put('/profile/update', 'ProfileController@update')->name('profile.update');
            Route::name('profile.')->namespace('Profile')->group(function () {

                //password routes
                Route::get('/password/edit', 'PasswordController@edit')->name('password.edit');
                Route::put('/password/update', 'PasswordController@update')->name('password.update');

            });

            // apartments routes
            Route::get('/apartments/data', 'ApartmentController@data')->name('apartments.data');
            Route::delete('/apartments/bulk_delete', 'ApartmentController@bulkDelete')->name('apartments.bulk_delete');
            Route::resource('apartments', 'ApartmentController');

            // posts routes
            Route::get('/posts/data', 'PostController@data')->name('posts.data');
            Route::delete('/posts/bulk_delete', 'PostController@bulkDelete')->name('posts.bulk_delete');
            Route::resource('posts', 'PostController');

            // Banners routes
            Route::get('/banners/data', 'BannerController@data')->name('banners.data');
            Route::delete('/banners/bulk_delete', 'BannerController@bulkDelete')->name('banners.bulk_delete');
            Route::resource('banners', 'BannerController');


        });

    });
