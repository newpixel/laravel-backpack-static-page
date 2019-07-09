<?php
/*
|--------------------------------------------------------------------------
| Newpixel\StaticPageCRUD Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are
| handled by the Newpixel\StaticPageCRUD package.
|
*/
Route::group([
    'namespace' => 'Newpixel\StaticPageCRUD\app\Http\Controllers\Admin',
        'prefix' => config('backpack.base.route_prefix', 'admin'),
        'middleware' => ['web', backpack_middleware()],
    ], function () {
        CRUD::resource('static-page', 'StaticPageCrudController');
    });
