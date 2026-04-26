<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'أحمد محمد الحسن',     'email' => 'ahmed.hassan@example.com',   'role_id' => 1, 'city_id' => 1],
            ['name' => 'سارة علي النعيمي',     'email' => 'sara.naaimi@example.com',    'role_id' => 2, 'city_id' => 2],
            ['name' => 'محمد خالد الزعبي',     'email' => 'mo.zaabi@example.com',       'role_id' => 3, 'city_id' => 3],
            ['name' => 'ليلى إبراهيم الشريف',  'email' => 'layla.sharif@example.com',   'role_id' => 2, 'city_id' => 4],
            ['name' => 'عمر عبد الرحمن قاسم',  'email' => 'omar.qasem@example.com',     'role_id' => 3, 'city_id' => 5],
            ['name' => 'نور الدين طاهر',        'email' => 'nourdin.taher@example.com',  'role_id' => 3, 'city_id' => 6],
            ['name' => 'هدى محمود سليم',        'email' => 'huda.salim@example.com',     'role_id' => 2, 'city_id' => 7],
            ['name' => 'كريم يوسف منصور',       'email' => 'karim.mansour@example.com',  'role_id' => 3, 'city_id' => 8],
            ['name' => 'رنا جمال الخطيب',       'email' => 'rana.khateeb@example.com',   'role_id' => 2, 'city_id' => 9],
            ['name' => 'بلال عدنان درويش',      'email' => 'bilal.darwish@example.com',  'role_id' => 3, 'city_id' => 10],
            ['name' => 'ديما فارس عطية',        'email' => 'dima.atia@example.com',      'role_id' => 2, 'city_id' => 11],
            ['name' => 'وسام حسين العلي',       'email' => 'wisam.ali@example.com',      'role_id' => 3, 'city_id' => 12],
            ['name' => 'مايا سامي البكري',      'email' => 'maya.bakri@example.com',     'role_id' => 2, 'city_id' => 13],
            ['name' => 'يزن طارق الحمدان',      'email' => 'yazan.hamdan@example.com',   'role_id' => 3, 'city_id' => 14],
            ['name' => 'إيمان رضا الجابر',      'email' => 'iman.jaber@example.com',     'role_id' => 2, 'city_id' => 15],
            ['name' => 'سليم حمزة الأيوبي',     'email' => 'salim.ayoubi@example.com',   'role_id' => 3, 'city_id' => 16],
            ['name' => 'لمى وليد الرشيد',       'email' => 'lama.rashid@example.com',    'role_id' => 2, 'city_id' => 17],
            ['name' => 'فادي جورج سمعان',       'email' => 'fadi.samaan@example.com',    'role_id' => 3, 'city_id' => 18],
            ['name' => 'غادة نزار الحلبي',      'email' => 'ghada.halabi@example.com',   'role_id' => 2, 'city_id' => 19],
            ['name' => 'حسن ماهر عوض',          'email' => 'hassan.awad@example.com',    'role_id' => 3, 'city_id' => 20],
            ['name' => 'تالا رامي الحمصي',      'email' => 'tala.homsi@example.com',     'role_id' => 2, 'city_id' => 21],
            ['name' => 'ربيع صالح القاضي',      'email' => 'rabee.qadi@example.com',     'role_id' => 3, 'city_id' => 22],
            ['name' => 'شيرين أنور المسلم',     'email' => 'shirin.muslim@example.com',  'role_id' => 2, 'city_id' => 23],
            ['name' => 'نادر علاء الشهابي',     'email' => 'nader.shehabi@example.com',  'role_id' => 3, 'city_id' => 24],
            ['name' => 'ميار ياسر زيدان',       'email' => 'miyar.zeidan@example.com',   'role_id' => 2, 'city_id' => 25],
            ['name' => 'زياد كمال عيسى',        'email' => 'ziyad.issa@example.com',     'role_id' => 3, 'city_id' => 26],
            ['name' => 'أمل سعيد البلوشي',      'email' => 'amal.balushi@example.com',   'role_id' => 2, 'city_id' => 27],
            ['name' => 'جاد منير السيد',        'email' => 'jad.sayed@example.com',      'role_id' => 3, 'city_id' => 28],
            ['name' => 'شذى زاهر الكيلاني',    'email' => 'shatha.kilani@example.com',  'role_id' => 2, 'city_id' => 29],
            ['name' => 'مرام بشير الطويل',      'email' => 'maram.taweel@example.com',   'role_id' => 2, 'city_id' => 30],
            ['name' => 'أنس قيس المصطفى',       'email' => 'anas.mustafa@example.com',   'role_id' => 3, 'city_id' => 1],
            ['name' => 'وفاء توفيق حداد',       'email' => 'wafa.haddad@example.com',    'role_id' => 2, 'city_id' => 2],
            ['name' => 'حازم نبيل جرجور',       'email' => 'hazem.jarjour@example.com',  'role_id' => 3, 'city_id' => 3],
            ['name' => 'ريم عمار الشاهين',      'email' => 'reem.shahin@example.com',    'role_id' => 2, 'city_id' => 4],
            ['name' => 'عصام مصطفى غانم',       'email' => 'issam.ghanem@example.com',   'role_id' => 3, 'city_id' => 5],
            ['name' => 'رولا فيصل الحوراني',    'email' => 'rola.hourani@example.com',   'role_id' => 2, 'city_id' => 6],
            ['name' => 'أيمن ربيع السبع',       'email' => 'ayman.sabe@example.com',     'role_id' => 3, 'city_id' => 7],
            ['name' => 'سوزان جلال العبد',      'email' => 'suzane.abd@example.com',     'role_id' => 2, 'city_id' => 8],
            ['name' => 'أشرف لؤي الصباغ',       'email' => 'ashraf.sabbagh@example.com', 'role_id' => 3, 'city_id' => 9],
            ['name' => 'حياة راشد الدوسري',     'email' => 'hayat.dosari@example.com',   'role_id' => 2, 'city_id' => 10],
            ['name' => 'مراد حامد الغزاوي',     'email' => 'murad.ghazawi@example.com',  'role_id' => 3, 'city_id' => 11],
            ['name' => 'ندى زهير العمر',        'email' => 'nada.omor@example.com',      'role_id' => 2, 'city_id' => 12],
            ['name' => 'وائل جهاد الصالح',      'email' => 'wael.saleh@example.com',     'role_id' => 3, 'city_id' => 13],
            ['name' => 'سنا إياد الحايك',       'email' => 'sana.hayek@example.com',     'role_id' => 2, 'city_id' => 14],
            ['name' => 'علاء الدين فاروق بدر',  'email' => 'aladin.badr@example.com',    'role_id' => 3, 'city_id' => 15],
            ['name' => 'فيروز حيدر المير',      'email' => 'fayruz.mir@example.com',     'role_id' => 2, 'city_id' => 16],
            ['name' => 'ضياء سرحان القره',      'email' => 'diya.qara@example.com',      'role_id' => 3, 'city_id' => 17],
            ['name' => 'ألاء باسل الجمل',       'email' => 'alaa.jamal@example.com',     'role_id' => 2, 'city_id' => 18],
            ['name' => 'روان محفوظ عيتاني',     'email' => 'rawan.itani@example.com',    'role_id' => 3, 'city_id' => 19],
            ['name' => 'جمال عزيز النصر',       'email' => 'jamal.nasr@example.com',     'role_id' => 3, 'city_id' => 20],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'name'              => $user['name'],
                'email'             => $user['email'],
                'password'          => Hash::make('password123'),
                'role_id'           => $user['role_id'],
                'city_id'           => $user['city_id'],
                'email_verified_at' => now(),
                'created_at'        => now()->subDays(rand(1, 180)),
                'updated_at'        => now(),
            ]);
        }
    }
}
