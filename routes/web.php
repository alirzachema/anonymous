<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('user_actions', 'Admin\UserActionsController');
    Route::resource('companies', 'Admin\CompaniesController');
    Route::post('companies_mass_destroy', ['uses' => 'Admin\CompaniesController@massDestroy', 'as' => 'companies.mass_destroy']);
    Route::post('companies_restore/{id}', ['uses' => 'Admin\CompaniesController@restore', 'as' => 'companies.restore']);
    Route::delete('companies_perma_del/{id}', ['uses' => 'Admin\CompaniesController@perma_del', 'as' => 'companies.perma_del']);
    Route::resource('company_categories', 'Admin\CompanyCategoriesController');
    Route::post('company_categories_mass_destroy', ['uses' => 'Admin\CompanyCategoriesController@massDestroy', 'as' => 'company_categories.mass_destroy']);
    Route::post('company_categories_restore/{id}', ['uses' => 'Admin\CompanyCategoriesController@restore', 'as' => 'company_categories.restore']);
    Route::delete('company_categories_perma_del/{id}', ['uses' => 'Admin\CompanyCategoriesController@perma_del', 'as' => 'company_categories.perma_del']);
    Route::resource('products', 'Admin\ProductsController');
    Route::post('products_mass_destroy', ['uses' => 'Admin\ProductsController@massDestroy', 'as' => 'products.mass_destroy']);
    Route::resource('product_categories', 'Admin\ProductCategoriesController');
    Route::post('product_categories_mass_destroy', ['uses' => 'Admin\ProductCategoriesController@massDestroy', 'as' => 'product_categories.mass_destroy']);
    Route::resource('product_tags', 'Admin\ProductTagsController');
    Route::post('product_tags_mass_destroy', ['uses' => 'Admin\ProductTagsController@massDestroy', 'as' => 'product_tags.mass_destroy']);
    Route::resource('states', 'Admin\StatesController');
    Route::post('states_mass_destroy', ['uses' => 'Admin\StatesController@massDestroy', 'as' => 'states.mass_destroy']);
    Route::post('states_restore/{id}', ['uses' => 'Admin\StatesController@restore', 'as' => 'states.restore']);
    Route::delete('states_perma_del/{id}', ['uses' => 'Admin\StatesController@perma_del', 'as' => 'states.perma_del']);
    Route::resource('cities', 'Admin\CitiesController');
    Route::post('cities_mass_destroy', ['uses' => 'Admin\CitiesController@massDestroy', 'as' => 'cities.mass_destroy']);
    Route::post('cities_restore/{id}', ['uses' => 'Admin\CitiesController@restore', 'as' => 'cities.restore']);
    Route::delete('cities_perma_del/{id}', ['uses' => 'Admin\CitiesController@perma_del', 'as' => 'cities.perma_del']);
    Route::post('/spatie/media/upload', 'Admin\SpatieMediaController@create')->name('media.upload');
    Route::post('/spatie/media/remove', 'Admin\SpatieMediaController@destroy')->name('media.remove');



 
});
