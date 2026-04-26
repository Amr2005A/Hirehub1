<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $users = DB::table('users')->pluck('id')->toArray();

        $positiveComments = [
            'عمل ممتاز وتسليم في الوقت المحدد، سأتعامل معه مجدداً بكل تأكيد.',
            'محترف جداً في عمله، يفهم المتطلبات بدقة ويقدم نتائج تفوق التوقعات.',
            'تجربة رائعة، التواصل كان سلساً والنتيجة النهائية أعجبتني جداً.',
            'جودة عالية وسرعة في الإنجاز، أنصح بالتعامل معه بشدة.',
            'تعامل مريح ونتائج احترافية، من أفضل المستقلين الذين تعاملت معهم.',
            'أنجز المشروع قبل الموعد المحدد وبجودة ممتازة، شكراً جزيلاً.',
            'مبدع وملتزم، يقدم أفكاراً إضافية تحسّن المشروع، ننصح به بشدة.',
            'دقيق في التفاصيل ومتجاوب مع كل التعديلات المطلوبة بسرعة.',
        ];

        $neutralComments = [
            'العمل جيد والتسليم في وقته، لكن التواصل كان يمكن أن يكون أفضل.',
            'النتيجة مقبولة وتلبي المتطلبات الأساسية، يمكن التعامل معه مرة أخرى.',
            'أداء جيد بشكل عام، التعديلات استغرقت بعض الوقت.',
            'عمل مقبول يحتاج بعض التحسينات، لكن النتيجة النهائية كانت مقبولة.',
        ];

        $negativeComments = [
            'التسليم تأخر عن الموعد المحدد والتواصل كان صعباً في بعض الأحيان.',
            'الجودة أقل من المتوقع وطلبت تعديلات كثيرة قبل الحصول على نتيجة مقبولة.',
            'التجربة لم تكن بالمستوى المطلوب، أتمنى تحسين التواصل في المستقبل.',
        ];

        $freelancerIds = DB::table('users')->where('role_id', 3)->pluck('id')->toArray();
        $clientIds     = DB::table('users')->where('role_id', 2)->pluck('id')->toArray();

        $reviewedPairs = [];
        $count         = 0;
        $target        = 50;

        while ($count < $target) {
            $reviewerId  = $clientIds[array_rand($clientIds)];
            $targetId    = $freelancerIds[array_rand($freelancerIds)];

            $key = $reviewerId . '-' . $targetId;
            if (isset($reviewedPairs[$key])) {
                continue;
            }
            $reviewedPairs[$key] = true;

            $rating = rand(1, 5);
            if ($rating >= 4) {
                $comment = $positiveComments[array_rand($positiveComments)];
            } elseif ($rating === 3) {
                $comment = $neutralComments[array_rand($neutralComments)];
            } else {
                $comment = $negativeComments[array_rand($negativeComments)];
            }

            $reviewableType = rand(0, 1) === 0 ? 'App\\Models\\User' : 'App\\Models\\Project';
            $reviewableId   = $reviewableType === 'App\\Models\\User'
                ? $targetId
                : (DB::table('projects')->inRandomOrder()->value('id') ?? $targetId);

            DB::table('reviews')->insert([
                'reviewer_id'     => $reviewerId,
                'rating'          => $rating,
                'comment'         => $comment,
                'reviewable_id'   => $reviewableId,
                'reviewable_type' => $reviewableType,
                'created_at'      => now()->subDays(rand(1, 90)),
                'updated_at'      => now(),
            ]);

            $count++;
        }
    }
}
