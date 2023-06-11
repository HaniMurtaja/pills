<?php


use App\Http\Controllers\Api\V1\Admin\FirebaseAuthController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'namespace' => 'Api\V1\Admin'], function () {
    //Auth
    Route::post('register', 'AuthController@register');// done
    Route::post('login', 'AuthController@login'); //done
//    Route::post('register_firebase', [FirebaseAuthController::class,'store']); //done
    //Forget Password
    Route::post('password/email', 'ForgotPasswordController@forgot');

    Route::group(['as' => 'api.', 'middleware' => ['auth:sanctum']], function () {
        //logout
      Route::post('logout', 'AuthController@logout'); //done
        //user_basic_info
        Route::post('user_basic_info_update/{id?}', 'UserBasicInfoController@user_basic_info_update'); //done

        // Users
    Route::post('users/media', 'UsersApiController@storeMedia')->name('users.storeMedia');//done
    Route::apiResource('users', 'UsersApiController');//done



    // Reminders
    Route::apiResource('reminders', 'RemindersApiController'); //done
        //user_reminders
    Route::get('user_reminders','RemindersApiController@getUserReminders')->name('user-reminders');


    // User Health
    Route::apiResource('user-healths', 'UserHealthApiController'); //done


    // User Medical History
    Route::apiResource('user-medical-histories', 'UserMedicalHistoryApiController'); //done


    // User Docs
    Route::post('user-docs/media', 'UserDocsApiController@storeMedia')->name('user-docs.storeMedia'); //done
    Route::apiResource('user-docs', 'UserDocsApiController'); //done


    // Medical Guides
    Route::post('medical-guides/media', 'MedicalGuidesApiController@storeMedia')->name('medical-guides.storeMedia'); //done
    Route::apiResource('medical-guides', 'MedicalGuidesApiController');//done
    Route::get('medical-guides-doctors', 'MedicalGuidesApiController@doctors');//done
    Route::get('medical-guides-hospitals', 'MedicalGuidesApiController@hospitals');//done
    Route::get('medical-guides-heathcenter', 'MedicalGuidesApiController@heathcenter');//done
    Route::get('medical-guides-pharmacy', 'MedicalGuidesApiController@pharmacy');//done


    // Services
    Route::post('services/media', 'ServicesApiController@storeMedia')->name('services.storeMedia'); //done
    Route::apiResource('services', 'ServicesApiController'); //done


    // Medicines
    Route::apiResource('medicines', 'MedicinesApiController'); //done


    // Orders
    Route::apiResource('orders', 'OrdersApiController'); //done

        //Cares
        //care_basic_info
        Route::get('care_basic_info/{care_id}', 'CareBasicInfoController@care_basic_info'); //done
        Route::post('care_basic_info_store', 'CareBasicInfoController@care_basic_info_store'); //done
        Route::post('care_basic_info_update/{id}', 'CareBasicInfoController@care_basic_info_update'); //done

        //care_reminder_store
        Route::get('care_reminders', 'CareReminderController@get_all_care_reminder'); //done

        Route::post('care_reminder_store', 'CareReminderController@store'); //done
        Route::get('care_user_reminders/{id}','CareReminderController@getCareReminders')->name('care-reminder');
        Route::get('get_care_user','CareBasicInfoController@getCaresUser')->name('list_care_reminders');
            //care_user_heath
        Route::post('care_user_heath_store', 'CareUserHealthApiController@store'); //done
        Route::post('care_user_heath_update/{id}', 'CareUserHealthApiController@update'); //done
        Route::get('care_user_heath', 'CareUserHealthApiController@index'); //done
        Route::post('search_care_reminder', 'CareReminderController@searchCareReminders'); //done



        //Care-medical-histories
        Route::post('care_medical_histories_store', 'CareMedicalHistoryController@store'); //done
        Route::post('care_medical_histories_update/{id}', 'CareMedicalHistoryController@update'); //done
        Route::get('care_medical_histories', 'CareMedicalHistoryController@index'); //done

        // Payment Methods
//     Route::apiResource('payment-methods', 'PaymentMethodsApiController');


     // Subscriptions
//     Route::apiResource('subscriptions', 'SubscriptionsApiController');
});
});