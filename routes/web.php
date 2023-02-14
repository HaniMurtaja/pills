<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');


    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');


    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::post('users/parse-csv-import', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('users/process-csv-import', 'UsersController@processCsvImport')->name('users.processCsvImport');
    Route::resource('users', 'UsersController');


    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);


    // Content Category
    Route::delete('content-categories/destroy', 'ContentCategoryController@massDestroy')->name('content-categories.massDestroy');
    Route::resource('content-categories', 'ContentCategoryController');

    // Content Tag
    Route::delete('content-tags/destroy', 'ContentTagController@massDestroy')->name('content-tags.massDestroy');
    Route::resource('content-tags', 'ContentTagController');

    // Content Page
    Route::delete('content-pages/destroy', 'ContentPageController@massDestroy')->name('content-pages.massDestroy');
    Route::post('content-pages/media', 'ContentPageController@storeMedia')->name('content-pages.storeMedia');
    Route::post('content-pages/ckmedia', 'ContentPageController@storeCKEditorImages')->name('content-pages.storeCKEditorImages');
    Route::resource('content-pages', 'ContentPageController');


    // Reminders
    Route::delete('reminders/destroy', 'RemindersController@massDestroy')->name('reminders.massDestroy');
    Route::post('reminders/parse-csv-import', 'RemindersController@parseCsvImport')->name('reminders.parseCsvImport');
    Route::post('reminders/process-csv-import', 'RemindersController@processCsvImport')->name('reminders.processCsvImport');
    Route::resource('reminders', 'RemindersController');


    // User Health
    Route::delete('user-healths/destroy', 'UserHealthController@massDestroy')->name('user-healths.massDestroy');
    Route::post('user-healths/parse-csv-import', 'UserHealthController@parseCsvImport')->name('user-healths.parseCsvImport');
    Route::post('user-healths/process-csv-import', 'UserHealthController@processCsvImport')->name('user-healths.processCsvImport');
    Route::resource('user-healths', 'UserHealthController');


    // User Medical History
    Route::delete('user-medical-histories/destroy', 'UserMedicalHistoryController@massDestroy')->name('user-medical-histories.massDestroy');
    Route::post('user-medical-histories/parse-csv-import', 'UserMedicalHistoryController@parseCsvImport')->name('user-medical-histories.parseCsvImport');
    Route::post('user-medical-histories/process-csv-import', 'UserMedicalHistoryController@processCsvImport')->name('user-medical-histories.processCsvImport');
    Route::resource('user-medical-histories', 'UserMedicalHistoryController');


    // User Docs
    Route::delete('user-docs/destroy', 'UserDocsController@massDestroy')->name('user-docs.massDestroy');
    Route::post('user-docs/media', 'UserDocsController@storeMedia')->name('user-docs.storeMedia');
    Route::post('user-docs/ckmedia', 'UserDocsController@storeCKEditorImages')->name('user-docs.storeCKEditorImages');
    Route::post('user-docs/parse-csv-import', 'UserDocsController@parseCsvImport')->name('user-docs.parseCsvImport');
    Route::post('user-docs/process-csv-import', 'UserDocsController@processCsvImport')->name('user-docs.processCsvImport');
    Route::resource('user-docs', 'UserDocsController');


    // Medical Guides
    Route::delete('medical-guides/destroy', 'MedicalGuidesController@massDestroy')->name('medical-guides.massDestroy');
    Route::post('medical-guides/media', 'MedicalGuidesController@storeMedia')->name('medical-guides.storeMedia');
    Route::post('medical-guides/ckmedia', 'MedicalGuidesController@storeCKEditorImages')->name('medical-guides.storeCKEditorImages');
    Route::post('medical-guides/parse-csv-import', 'MedicalGuidesController@parseCsvImport')->name('medical-guides.parseCsvImport');
    Route::post('medical-guides/process-csv-import', 'MedicalGuidesController@processCsvImport')->name('medical-guides.processCsvImport');
    Route::resource('medical-guides', 'MedicalGuidesController');


    // Services
    Route::delete('services/destroy', 'ServicesController@massDestroy')->name('services.massDestroy');
    Route::post('services/media', 'ServicesController@storeMedia')->name('services.storeMedia');
    Route::post('services/ckmedia', 'ServicesController@storeCKEditorImages')->name('services.storeCKEditorImages');
    Route::post('services/parse-csv-import', 'ServicesController@parseCsvImport')->name('services.parseCsvImport');
    Route::post('services/process-csv-import', 'ServicesController@processCsvImport')->name('services.processCsvImport');
    Route::resource('services', 'ServicesController');


    // Medicines
    Route::delete('medicines/destroy', 'MedicinesController@massDestroy')->name('medicines.massDestroy');
    Route::post('medicines/parse-csv-import', 'MedicinesController@parseCsvImport')->name('medicines.parseCsvImport');
    Route::post('medicines/process-csv-import', 'MedicinesController@processCsvImport')->name('medicines.processCsvImport');
    Route::resource('medicines', 'MedicinesController');


    // Orders
    Route::delete('orders/destroy', 'OrdersController@massDestroy')->name('orders.massDestroy');
    Route::post('orders/parse-csv-import', 'OrdersController@parseCsvImport')->name('orders.parseCsvImport');
    Route::post('orders/process-csv-import', 'OrdersController@processCsvImport')->name('orders.processCsvImport');
    Route::resource('orders', 'OrdersController');


    // Payment Methods
    Route::delete('payment-methods/destroy', 'PaymentMethodsController@massDestroy')->name('payment-methods.massDestroy');
    Route::post('payment-methods/parse-csv-import', 'PaymentMethodsController@parseCsvImport')->name('payment-methods.parseCsvImport');
    Route::post('payment-methods/process-csv-import', 'PaymentMethodsController@processCsvImport')->name('payment-methods.processCsvImport');
    Route::resource('payment-methods', 'PaymentMethodsController');


    // Subscriptions
    Route::delete('subscriptions/destroy', 'SubscriptionsController@massDestroy')->name('subscriptions.massDestroy');
    Route::post('subscriptions/parse-csv-import', 'SubscriptionsController@parseCsvImport')->name('subscriptions.parseCsvImport');
    Route::post('subscriptions/process-csv-import', 'SubscriptionsController@processCsvImport')->name('subscriptions.processCsvImport');
    Route::resource('subscriptions', 'SubscriptionsController');
});


Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
