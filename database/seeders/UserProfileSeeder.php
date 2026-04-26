<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserProfileSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = ['available', 'unavailable', 'busy'];

        $bios = [
            'مطور ويب متخصص في Laravel و Vue.js مع خبرة أكثر من 5 سنوات في بناء تطبيقات الويب المتكاملة.',
            'مصمم جرافيك إبداعي شغوف بتصميم الهويات البصرية والمطبوعات الإعلانية.',
            'مطور تطبيقات موبايل خبرة 4 سنوات في Flutter وReact Native.',
            'متخصص في التسويق الرقمي وإدارة حملات الإعلانات المدفوعة على منصات التواصل الاجتماعي.',
            'كاتب محتوى متخصص في المحتوى التقني والتسويقي باللغتين العربية والإنجليزية.',
            'مهندس DevOps خبرة في Docker و Kubernetes و CI/CD pipelines.',
            'محلل بيانات يعمل على استخراج الرؤى من البيانات باستخدام Python وSQL.',
            'مصمم UI/UX متخصص في تصميم تجارب مستخدم سلسة وجذابة باستخدام Figma.',
            'مطور Backend متخصص في بناء APIs باستخدام Node.js و Python.',
            'خبير أمن معلومات واختبار اختراق مع شهادات دولية في هذا المجال.',
            'مصور فوتوغرافي محترف متخصص في التصوير التجاري والإعلاني.',
            'مترجم قانوني وتقني ذو خبرة في ترجمة العقود والوثائق القانونية.',
            'مدير مشاريع معتمد PMP خبرة في قيادة فرق العمل وإدارة المشاريع التقنية.',
            'مطور Full Stack خبرة في React و Laravel و MySQL.',
            'متخصص في التجارة الإلكترونية وبناء المتاجر الإلكترونية على Shopify و WooCommerce.',
            'خبير SEO متخصص في تحسين ترتيب المواقع في محركات البحث.',
            'مطور WordPress خبرة في بناء وتخصيص القوالب والإضافات.',
            'مصمم شعارات وهويات بصرية متخصص في بناء هويات العلامات التجارية من الصفر.',
            'محرر فيديو محترف متخصص في المونتاج والمؤثرات البصرية.',
            'مطور Python خبرة في الذكاء الاصطناعي ومعالجة اللغات الطبيعية.',
        ];

        $portfolioLinks = [
            'https://portfolio.example.com/user1',
            'https://behance.net/example_user',
            'https://github.com/example_dev',
            'https://dribbble.com/example_designer',
            'https://linkedin.com/in/example_pro',
            null,
            null,
            'https://portfolio.example.com/user8',
            'https://github.com/example_backend',
            null,
        ];

        $phones = [
            '+963991234567',
            '+963941234567',
            '+963931234567',
            '+9611234567',
            '+9626789012',
            '+96650123456',
            '+97150123456',
            '+96599123456',
            '+97455123456',
            '+97317123456',
        ];

        $users = DB::table('users')->pluck('id')->toArray();

        foreach ($users as $index => $userId) {
            DB::table('user_profiles')->insert([
                'user_id'             => $userId,
                'personal_info'       => $bios[$index % count($bios)],
                'hourly_price'        => rand(5, 80) + (rand(0, 3) * 0.5),
                'image'               => null,
                'phone_number'        => $phones[$index % count($phones)],
                'availability_status' => $statuses[$index % count($statuses)],
                'portfolio_link'      => $portfolioLinks[$index % count($portfolioLinks)],
                'intry_date'          => now()->subDays(rand(30, 365))->toDateString(),
                'created_at'          => now(),
                'updated_at'          => now(),
            ]);
        }
    }
}
