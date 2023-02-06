<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission' => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                        => 'ID',
            'id_helper'                 => ' ',
            'name'                      => 'Name',
            'name_helper'               => ' ',
            'email'                     => 'Email',
            'email_helper'              => ' ',
            'email_verified_at'         => 'Email verified at',
            'email_verified_at_helper'  => ' ',
            'password'                  => 'Password',
            'password_helper'           => ' ',
            'roles'                     => 'Roles',
            'roles_helper'              => ' ',
            'remember_token'            => 'Remember Token',
            'remember_token_helper'     => ' ',
            'created_at'                => 'Created at',
            'created_at_helper'         => ' ',
            'updated_at'                => 'Updated at',
            'updated_at_helper'         => ' ',
            'deleted_at'                => 'Deleted at',
            'deleted_at_helper'         => ' ',
            'approved'                  => 'Approved',
            'approved_helper'           => ' ',
            'verified'                  => 'Verified',
            'verified_helper'           => ' ',
            'verified_at'               => 'Verified at',
            'verified_at_helper'        => ' ',
            'verification_token'        => 'Verification token',
            'verification_token_helper' => ' ',
            'address'                   => 'Address',
            'address_helper'            => ' ',
            'image'                     => 'Image',
            'image_helper'              => ' ',
            'phone'                     => 'Phone',
            'phone_helper'              => ' ',
            'user'                      => 'User ID',
            'user_helper'               => ' ',
            'carebies'                  => 'Carebies',
            'carebies_helper'           => ' ',
        ],
    ],
    'userAlert' => [
        'title'          => 'User Alerts',
        'title_singular' => 'User Alert',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'alert_text'        => 'Alert Text',
            'alert_text_helper' => ' ',
            'alert_link'        => 'Alert Link',
            'alert_link_helper' => ' ',
            'user'              => 'Users',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
        ],
    ],
    'contentManagement' => [
        'title'          => 'Content management',
        'title_singular' => 'Content management',
    ],
    'contentCategory' => [
        'title'          => 'Categories',
        'title_singular' => 'Category',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'slug'               => 'Slug',
            'slug_helper'        => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated At',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted At',
            'deleted_at_helper'  => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'content'            => 'Content',
            'content_helper'     => ' ',
        ],
    ],
    'contentTag' => [
        'title'          => 'Tags',
        'title_singular' => 'Tag',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'slug'              => 'Slug',
            'slug_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'contentPage' => [
        'title'          => 'Pages',
        'title_singular' => 'Page',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'title'                 => 'Title',
            'title_helper'          => ' ',
            'category'              => 'Categories',
            'category_helper'       => ' ',
            'tag'                   => 'Tags',
            'tag_helper'            => ' ',
            'page_text'             => 'Full Text',
            'page_text_helper'      => ' ',
            'excerpt'               => 'Excerpt',
            'excerpt_helper'        => ' ',
            'featured_image'        => 'Featured Image',
            'featured_image_helper' => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated At',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted At',
            'deleted_at_helper'     => ' ',
        ],
    ],
    'reminder' => [
        'title'          => 'Reminders',
        'title_singular' => 'Reminder',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'doses'                => 'Doses',
            'doses_helper'         => ' ',
            'times'                => 'Times',
            'times_helper'         => ' ',
            'days_of_week'         => 'Days Of Week',
            'days_of_week_helper'  => ' ',
            'snooze'               => 'Snooze',
            'snooze_helper'        => ' ',
            'date'                 => 'Date',
            'date_helper'          => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
            'user_reminder'        => 'User Reminder',
            'user_reminder_helper' => ' ',
            'care_reminder'        => 'Care Reminder',
            'care_reminder_helper' => ' ',
            'applying'             => 'Applying',
            'applying_helper'      => ' ',
            'time'                 => 'Time',
            'time_helper'          => ' ',
            'duration'             => 'Duration',
            'duration_helper'      => ' ',
            'start_from'           => 'Start From',
            'start_from_helper'    => ' ',
        ],
    ],
    'userHealth' => [
        'title'          => 'User Health',
        'title_singular' => 'User Health',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => ' ',
            'name'                    => 'Name',
            'name_helper'             => ' ',
            'gender'                  => 'Gender',
            'gender_helper'           => ' ',
            'dob'                     => 'Dob',
            'dob_helper'              => ' ',
            'blood_pressure'          => 'Blood Pressure',
            'blood_pressure_helper'   => ' ',
            'blood_group'             => 'Blood Group',
            'blood_group_helper'      => ' ',
            'height'                  => 'Height',
            'height_helper'           => ' ',
            'weight'                  => 'Weight',
            'weight_helper'           => ' ',
            'bmi'                     => 'Bmi',
            'bmi_helper'              => ' ',
            'total_cholestrol'        => 'Total Cholestrol',
            'total_cholestrol_helper' => ' ',
            'ldl_cholestrol'          => 'Ldl Cholestrol',
            'ldl_cholestrol_helper'   => ' ',
            'hdl_cholestrol'          => 'Hdl Cholestrol',
            'hdl_cholestrol_helper'   => ' ',
            'triglycerides'           => 'Triglycerides',
            'triglycerides_helper'    => ' ',
            'glucose'                 => 'Glucose',
            'glucose_helper'          => ' ',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated at',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted at',
            'deleted_at_helper'       => ' ',
            'careby'                  => 'Careby ID',
            'careby_helper'           => ' ',
            'user'                    => 'User',
            'user_helper'             => ' ',
        ],
    ],
    'userMedicalHistory' => [
        'title'          => 'User Medical History',
        'title_singular' => 'User Medical History',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'disease_name'        => 'Disease Name',
            'disease_name_helper' => ' ',
            'description'         => 'Description',
            'description_helper'  => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
            'user_history'        => 'User History',
            'user_history_helper' => ' ',
            'care_history'        => 'Care History',
            'care_history_helper' => ' ',
        ],
    ],
    'userDoc' => [
        'title'          => 'User Docs',
        'title_singular' => 'User Doc',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'date'               => 'Date',
            'date_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'file'               => 'File',
            'file_helper'        => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'care_docs'          => 'Care Docs',
            'care_docs_helper'   => ' ',
            'user_doc'           => 'User Doc',
            'user_doc_helper'    => ' ',
        ],
    ],
    'medicalGuide' => [
        'title'          => 'Medical Guides',
        'title_singular' => 'Medical Guide',
        'fields'         => [
            'id'                         => 'ID',
            'id_helper'                  => ' ',
            'guide_name'                 => 'Guide Name',
            'guide_name_helper'          => ' ',
            'guide_category'             => 'Guide Category',
            'guide_category_helper'      => ' ',
            'guide_phone'                => 'Guide Phone',
            'guide_phone_helper'         => ' ',
            'guide_image'                => 'Guide Image',
            'guide_image_helper'         => ' ',
            'guide_status'               => 'Guide Status',
            'guide_status_helper'        => ' ',
            'guide_address'              => 'Guide Address',
            'guide_address_helper'       => ' ',
            'latitude'                   => 'Latitude',
            'latitude_helper'            => ' ',
            'longitude'                  => 'Longitude',
            'longitude_helper'           => ' ',
            'created_at'                 => 'Created at',
            'created_at_helper'          => ' ',
            'updated_at'                 => 'Updated at',
            'updated_at_helper'          => ' ',
            'deleted_at'                 => 'Deleted at',
            'deleted_at_helper'          => ' ',
            'guide_working_hours'        => 'Guide Working Hours',
            'guide_working_hours_helper' => ' ',
        ],
    ],
    'service' => [
        'title'          => 'Services',
        'title_singular' => 'Service',
        'fields'         => [
            'id'                         => 'ID',
            'id_helper'                  => ' ',
            'service_name'               => 'Service Name',
            'service_name_helper'        => ' ',
            'service_description'        => 'Service Description',
            'service_description_helper' => ' ',
            'service_price'              => 'Service Price',
            'service_price_helper'       => ' ',
            'service_image'              => 'Service Image',
            'service_image_helper'       => ' ',
            'created_at'                 => 'Created at',
            'created_at_helper'          => ' ',
            'updated_at'                 => 'Updated at',
            'updated_at_helper'          => ' ',
            'deleted_at'                 => 'Deleted at',
            'deleted_at_helper'          => ' ',
        ],
    ],
    'medicine' => [
        'title'          => 'Medicines',
        'title_singular' => 'Medicine',
        'fields'         => [
            'id'                         => 'ID',
            'id_helper'                  => ' ',
            'med_generic_name'           => 'Med Generic Name',
            'med_generic_name_helper'    => ' ',
            'med_scientific_name'        => 'Med Scientific Name',
            'med_scientific_name_helper' => ' ',
            'med_expire_date'            => 'Med Expire Date',
            'med_expire_date_helper'     => ' ',
            'created_at'                 => 'Created at',
            'created_at_helper'          => ' ',
            'updated_at'                 => 'Updated at',
            'updated_at_helper'          => ' ',
            'deleted_at'                 => 'Deleted at',
            'deleted_at_helper'          => ' ',
            'med_quantity'               => 'Med Quantity',
            'med_quantity_helper'        => ' ',
            'user_med'                   => 'User Med',
            'user_med_helper'            => ' ',
            'care_med'                   => 'Care Med',
            'care_med_helper'            => ' ',
        ],
    ],
    'userOrder' => [
        'title'          => 'User Orders',
        'title_singular' => 'User Order',
    ],
    'order' => [
        'title'          => 'Orders',
        'title_singular' => 'Order',
        'fields'         => [
            'id'                         => 'ID',
            'id_helper'                  => ' ',
            'service_price'              => 'Service Price',
            'service_price_helper'       => ' ',
            'payment_method'             => 'Payment Method ID',
            'payment_method_helper'      => ' ',
            'service_description'        => 'Service Description',
            'service_description_helper' => ' ',
            'arriving_date'              => 'Arriving Date',
            'arriving_date_helper'       => ' ',
            'created_at'                 => 'Created at',
            'created_at_helper'          => ' ',
            'updated_at'                 => 'Updated at',
            'updated_at_helper'          => ' ',
            'deleted_at'                 => 'Deleted at',
            'deleted_at_helper'          => ' ',
            'user_orders'                => 'User Orders',
            'user_orders_helper'         => ' ',
        ],
    ],
    'paymentMethod' => [
        'title'          => 'Payment Methods',
        'title_singular' => 'Payment Method',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'type'                => 'Type',
            'type_helper'         => ' ',
            'card_number'         => 'Card Number',
            'card_number_helper'  => ' ',
            'expired_date'        => 'Expired Date',
            'expired_date_helper' => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
        ],
    ],
    'subscription' => [
        'title'          => 'Subscriptions',
        'title_singular' => 'Subscription',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => ' ',
            'user'                    => 'User ID',
            'user_helper'             => ' ',
            'payment_method'          => 'Payment Method ID',
            'payment_method_helper'   => ' ',
            'subsription_date'        => 'Subsription Date',
            'subsription_date_helper' => ' ',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated at',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted at',
            'deleted_at_helper'       => ' ',
            'user_subs'               => 'User Subs',
            'user_subs_helper'        => ' ',
        ],
    ],
];
