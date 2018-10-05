<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

        Route::resource('companies', 'CompaniesController', ['except' => ['create', 'edit']]);

        Route::resource('company_categories', 'CompanyCategoriesController', ['except' => ['create', 'edit']]);

});
