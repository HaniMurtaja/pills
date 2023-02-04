<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 18,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 19,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 20,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 21,
                'title' => 'content_management_access',
            ],
            [
                'id'    => 22,
                'title' => 'content_category_create',
            ],
            [
                'id'    => 23,
                'title' => 'content_category_edit',
            ],
            [
                'id'    => 24,
                'title' => 'content_category_show',
            ],
            [
                'id'    => 25,
                'title' => 'content_category_delete',
            ],
            [
                'id'    => 26,
                'title' => 'content_category_access',
            ],
            [
                'id'    => 27,
                'title' => 'content_tag_create',
            ],
            [
                'id'    => 28,
                'title' => 'content_tag_edit',
            ],
            [
                'id'    => 29,
                'title' => 'content_tag_show',
            ],
            [
                'id'    => 30,
                'title' => 'content_tag_delete',
            ],
            [
                'id'    => 31,
                'title' => 'content_tag_access',
            ],
            [
                'id'    => 32,
                'title' => 'content_page_create',
            ],
            [
                'id'    => 33,
                'title' => 'content_page_edit',
            ],
            [
                'id'    => 34,
                'title' => 'content_page_show',
            ],
            [
                'id'    => 35,
                'title' => 'content_page_delete',
            ],
            [
                'id'    => 36,
                'title' => 'content_page_access',
            ],
            [
                'id'    => 37,
                'title' => 'reminder_create',
            ],
            [
                'id'    => 38,
                'title' => 'reminder_edit',
            ],
            [
                'id'    => 39,
                'title' => 'reminder_show',
            ],
            [
                'id'    => 40,
                'title' => 'reminder_delete',
            ],
            [
                'id'    => 41,
                'title' => 'reminder_access',
            ],
            [
                'id'    => 42,
                'title' => 'user_health_create',
            ],
            [
                'id'    => 43,
                'title' => 'user_health_edit',
            ],
            [
                'id'    => 44,
                'title' => 'user_health_show',
            ],
            [
                'id'    => 45,
                'title' => 'user_health_delete',
            ],
            [
                'id'    => 46,
                'title' => 'user_health_access',
            ],
            [
                'id'    => 47,
                'title' => 'user_medical_history_create',
            ],
            [
                'id'    => 48,
                'title' => 'user_medical_history_edit',
            ],
            [
                'id'    => 49,
                'title' => 'user_medical_history_show',
            ],
            [
                'id'    => 50,
                'title' => 'user_medical_history_delete',
            ],
            [
                'id'    => 51,
                'title' => 'user_medical_history_access',
            ],
            [
                'id'    => 52,
                'title' => 'user_doc_create',
            ],
            [
                'id'    => 53,
                'title' => 'user_doc_edit',
            ],
            [
                'id'    => 54,
                'title' => 'user_doc_show',
            ],
            [
                'id'    => 55,
                'title' => 'user_doc_delete',
            ],
            [
                'id'    => 56,
                'title' => 'user_doc_access',
            ],
            [
                'id'    => 57,
                'title' => 'medical_guide_create',
            ],
            [
                'id'    => 58,
                'title' => 'medical_guide_edit',
            ],
            [
                'id'    => 59,
                'title' => 'medical_guide_show',
            ],
            [
                'id'    => 60,
                'title' => 'medical_guide_delete',
            ],
            [
                'id'    => 61,
                'title' => 'medical_guide_access',
            ],
            [
                'id'    => 62,
                'title' => 'service_create',
            ],
            [
                'id'    => 63,
                'title' => 'service_edit',
            ],
            [
                'id'    => 64,
                'title' => 'service_show',
            ],
            [
                'id'    => 65,
                'title' => 'service_delete',
            ],
            [
                'id'    => 66,
                'title' => 'service_access',
            ],
            [
                'id'    => 67,
                'title' => 'medicine_create',
            ],
            [
                'id'    => 68,
                'title' => 'medicine_edit',
            ],
            [
                'id'    => 69,
                'title' => 'medicine_show',
            ],
            [
                'id'    => 70,
                'title' => 'medicine_delete',
            ],
            [
                'id'    => 71,
                'title' => 'medicine_access',
            ],
            [
                'id'    => 72,
                'title' => 'user_order_access',
            ],
            [
                'id'    => 73,
                'title' => 'order_create',
            ],
            [
                'id'    => 74,
                'title' => 'order_edit',
            ],
            [
                'id'    => 75,
                'title' => 'order_show',
            ],
            [
                'id'    => 76,
                'title' => 'order_delete',
            ],
            [
                'id'    => 77,
                'title' => 'order_access',
            ],
            [
                'id'    => 78,
                'title' => 'payment_method_create',
            ],
            [
                'id'    => 79,
                'title' => 'payment_method_edit',
            ],
            [
                'id'    => 80,
                'title' => 'payment_method_show',
            ],
            [
                'id'    => 81,
                'title' => 'payment_method_delete',
            ],
            [
                'id'    => 82,
                'title' => 'payment_method_access',
            ],
            [
                'id'    => 83,
                'title' => 'subscription_create',
            ],
            [
                'id'    => 84,
                'title' => 'subscription_edit',
            ],
            [
                'id'    => 85,
                'title' => 'subscription_show',
            ],
            [
                'id'    => 86,
                'title' => 'subscription_delete',
            ],
            [
                'id'    => 87,
                'title' => 'subscription_access',
            ],
            [
                'id'    => 88,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
