<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfferSeeder extends Seeder
{
    public function run(): void
    {
        $freelancerUserIds = DB::table('users')->where('role_id', 3)->pluck('id')->toArray();
        $projects          = DB::table('projects')->get();
        $statuses          = ['pending', 'accepted', 'rejected'];

        $descriptions = [
            'أنا مطور ذو خبرة واسعة في هذا المجال وقد نفّذت مشاريع مشابهة من قبل. سأضمن لك جودة عالية وتسليماً في الوقت المحدد مع دعم ما بعد التسليم لمدة شهر.',
            'لديّ فريق متكامل يستطيع تنفيذ هذا المشروع بكفاءة عالية. سنبدأ العمل فوراً بعد الموافقة وسنقدم تقارير دورية عن التقدم.',
            'خبرتي في هذا المجال تتجاوز 5 سنوات وقد عملت مع عملاء في 10 دول مختلفة. المشروع سيُنجز وفق أعلى معايير الجودة.',
            'سأبدأ بعمل نموذج أولي خلال 48 ساعة للحصول على موافقتك قبل المتابعة. هذا يضمن أن النتيجة النهائية ستكون مطابقة لتوقعاتك.',
            'أقدم ضمان استرداد المبلغ إذا لم تكن راضياً عن النتيجة. أنا أثق بجودة عملي وأريد أن يكون عميلي سعيداً.',
            'استطعت إنجاز مشروع مشابه في وقت أقصر من المطلوب وبتكلفة أقل. سأطبق نفس الكفاءة على مشروعك.',
            'سأقدم لك تقرير مفصل عن خطة العمل والجدول الزمني قبل البدء. الشفافية والتواصل المستمر هما أساس عملي.',
            'لديّ تجربة طويلة في التعامل مع متطلبات مشابهة. سأضمن أن الحل سيكون قابلاً للتوسع والتطوير مستقبلاً.',
            'أتعامل مع هذا النوع من المشاريع بشكل منتظم ولديّ قوالب وأدوات جاهزة توفر الوقت والجهد وتضمن الجودة.',
            'خطتي للعمل واضحة: أسبوع للتخطيط، أسبوعان للتنفيذ، أسبوع للاختبار. السعر يشمل التعديلات اللازمة.',
            'سأقدم نموذجاً مجانياً للمفهوم قبل البدء الفعلي حتى تتأكد من فهمي لمتطلباتك تماماً.',
            'عملت سابقاً مع شركات رائدة في نفس قطاعك وأفهم متطلبات السوق جيداً. هذه الخبرة ستعود بالفائدة على مشروعك.',
        ];

        $inserted = [];

        foreach ($projects as $project) {
            $offerCount = rand(1, 5);
            $shuffled   = $freelancerUserIds;
            shuffle($shuffled);
            $selectedFreelancers = array_slice($shuffled, 0, min($offerCount, count($shuffled)));

            $hasAccepted = false;

            foreach ($selectedFreelancers as $idx => $freelancerId) {
                $key = $project->id . '-' . $freelancerId;
                if (isset($inserted[$key])) {
                    continue;
                }
                $inserted[$key] = true;

                if ($project->status === 'in_progress' && !$hasAccepted) {
                    $status      = 'accepted';
                    $hasAccepted = true;
                } elseif ($project->status === 'closed') {
                    $status = $idx === 0 ? 'accepted' : 'rejected';
                } else {
                    $status = 'pending';
                }

                $basePrice = $project->budget_type === 'fixed'
                    ? ($project->fixed_price ?? 500) * (rand(80, 120) / 100)
                    : ($project->hourly_price ?? 30) * (rand(80, 110) / 100);

                DB::table('offers')->insert([
                    'project_id'      => $project->id,
                    'user_id'      => $freelancerId,
                    'suggested_price' => round($basePrice, 2),
                    'cover_letter'     => $descriptions[array_rand($descriptions)],
                    'count_of_days'   => rand(7, 60),
                    'status'          => $status,
                    'file_path'       => null,
                    'created_at'      => now()->subDays(rand(1, 30)),
                    'updated_at'      => now(),
                ]);
            }
        }
    }
}
