<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/** ------------------------------------------
 *  Route model binding
 *  ------------------------------------------
 */
Route::model('user', 'User');
Route::model('comment', 'Comment');
Route::model('post', 'Post');
Route::model('role', 'Role');

/** ------------------------------------------
 *  Route constraint patterns
 *  ------------------------------------------
 */
Route::pattern('comment', '[0-9]+');
Route::pattern('post', '[0-9]+');
Route::pattern('user', '[0-9]+');
Route::pattern('role', '[0-9]+');
Route::pattern('token', '[0-9a-z]+');

/** ------------------------------------------
 *  Admin Routes
 *  ------------------------------------------
 */
Route::group(array('prefix' => 'admin', 'before' => 'auth'), function()
{

    # Class Management
    Route::get('classes/{class}/show', 'AdminClassesController@getShow');
    Route::get('classes/{class}/edit', 'AdminClassesController@getEdit');
    Route::post('classes/{class}/edit', 'AdminClassesController@postEdit');
    Route::get('classes/{class}/delete', 'AdminClassesController@getDelete');
    Route::post('classes/{class}/delete', 'AdminClassesController@postDelete');
    Route::controller('classes','AdminClassesController');

    # Meals Management
    Route::get('meals/{meal}/show', 'AdminMealsController@getShow');
    Route::get('meals/{meal}/edit', 'AdminMealsController@getEdit');
    Route::post('meals/{meal}/edit', 'AdminMealsController@postEdit');
    Route::get('meals/{meal}/delete', 'AdminMealsController@getDelete');
    Route::post('meals/{meal}/delete', 'AdminMealsController@postDelete');
    Route::get('meals/{meal}/status', 'AdminMealsController@toggleStatus');
    Route::get('meals/{status}/all-status', 'AdminMealsController@toggleAllStatus');
    Route::controller('meals','AdminMealsController');

    # orders Management
    Route::get('order/{order}/show', 'AdminOrderController@getShow');
    Route::get('order/{order}/edit', 'AdminOrderController@getEdit');
    Route::post('order/{order}/edit', 'AdminOrderController@postEdit');
    Route::get('order/{order}/delete', 'AdminOrderController@getDelete');
    Route::post('order/{order}/delete', 'AdminOrderController@postDelete');
    Route::controller('order','AdminOrderController');

    # Comment Management
    Route::get('comments/{comment}/edit', 'AdminCommentsController@getEdit');
    Route::post('comments/{comment}/edit', 'AdminCommentsController@postEdit');
    Route::get('comments/{comment}/delete', 'AdminCommentsController@getDelete');
    Route::post('comments/{comment}/delete', 'AdminCommentsController@postDelete');
    Route::controller('comments', 'AdminCommentsController');

    # Blog Management
    Route::get('blogs/{post}/show', 'AdminBlogsController@getShow');
    Route::get('blogs/{post}/edit', 'AdminBlogsController@getEdit');
    Route::post('blogs/{post}/edit', 'AdminBlogsController@postEdit');
    Route::get('blogs/{post}/delete', 'AdminBlogsController@getDelete');
    Route::post('blogs/{post}/delete', 'AdminBlogsController@postDelete');
    Route::controller('blogs', 'AdminBlogsController');

    # User Management
    Route::get('users/{user}/show', 'AdminUsersController@getShow');
    Route::get('users/{user}/edit', 'AdminUsersController@getEdit');
    Route::post('users/{user}/edit', 'AdminUsersController@postEdit');
    Route::get('users/{user}/delete', 'AdminUsersController@getDelete');
    Route::post('users/{user}/delete', 'AdminUsersController@postDelete');
    Route::controller('users', 'AdminUsersController');

    # User Role Management
    Route::get('roles/{role}/show', 'AdminRolesController@getShow');
    Route::get('roles/{role}/edit', 'AdminRolesController@getEdit');
    Route::post('roles/{role}/edit', 'AdminRolesController@postEdit');
    Route::get('roles/{role}/delete', 'AdminRolesController@getDelete');
    Route::post('roles/{role}/delete', 'AdminRolesController@postDelete');
    Route::controller('roles', 'AdminRolesController');

    # Admin Dashboard
    Route::controller('/', 'AdminDashboardController');
});


/** ------------------------------------------
 *  Frontend Routes
 *  ------------------------------------------
 */
Route::controller('sell','SellController');

//Cart routes
Route::controller('cart','CartController');

//Order routes
Route::controller('order','OrderController');

// User reset routes
Route::get('user/reset/{token}', 'UserController@getReset');
// User password reset
Route::post('user/reset/{token}', 'UserController@postReset');
//:: User Account Routes ::
Route::post('user/{user}/edit', 'UserController@postEdit');

//:: User Account Routes ::
Route::post('user/login', 'UserController@postLogin');

# User RESTful Routes (Login, Logout, Register, etc)
Route::controller('user', 'UserController');

//:: Application Routes ::

# Filter for detect language
Route::when('contact-us','detectLang');

# Contact Us Static Page
Route::get('contact-us', function()
{
    // Return about us page
    return View::make('site/contact-us');
});

# Posts - Second to last set, match slug
Route::get('{postSlug}', 'BlogController@getView');
Route::post('{postSlug}', 'BlogController@postView');

# Index Page - Last route, no matches
Route::get('/', array('before' => 'detectLang','uses' => 'SellController@getIndex'));




