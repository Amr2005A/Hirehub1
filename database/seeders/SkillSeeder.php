<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            'تطوير الويب',
            'تصميم الجرافيك',
            'تطوير تطبيقات الموبايل',
            'التسويق الرقمي',
            'كتابة المحتوى',
            'تصميم واجهة المستخدم',
            'تجربة المستخدم',
            'قواعد البيانات',
            'DevOps',
            'الذكاء الاصطناعي',
            'تحليل البيانات',
            'الأمن السيبراني',
            'تصميم الشعارات',
            'المونتاج والفيديو',
            'التصوير الفوتوغرافي',
            'الترجمة',
            'إدارة المشاريع',
            'إدارة وسائل التواصل الاجتماعي',
            'التجارة الإلكترونية',
            'تحسين محركات البحث',
        ];

        foreach ($skills as $skill) {
            DB::table('skills')->insert([
                'name'       => $skill,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
