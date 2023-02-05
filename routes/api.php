<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Users
    Route::post('users/media', 'UsersApiController@storeMedia')->name('users.storeMedia');
    Route::apiResource('users', 'UsersApiController');
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');

    // Reminders
    Route::apiResource('reminders', 'RemindersApiController');

    // User Health
    Route::apiResource('user-healths', 'UserHealthApiController');

    // User Medical History
    Route::apiResource('user-medical-histories', 'UserMedicalHistoryApiController');

    // User Docs
    Route::post('user-docs/media', 'UserDocsApiController@storeMedia')->name('user-docs.storeMedia');
    Route::apiResource('user-docs', 'UserDocsApiController');

    // Medical Guides
    Route::post('medical-guides/media', 'MedicalGuidesApiController@storeMedia')->name('medical-guides.storeMedia');
    Route::apiResource('medical-guides', 'MedicalGuidesApiController');

    // Services
    Route::post('services/media', 'ServicesApiController@storeMedia')->name('services.storeMedia');
    Route::apiResource('services', 'ServicesApiController');

    // Medicines
    Route::apiResource('medicines', 'MedicinesApiController');

    // Orders
    Route::apiResource('orders', 'OrdersApiController');
});
