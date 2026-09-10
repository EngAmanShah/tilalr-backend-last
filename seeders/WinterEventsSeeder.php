<?php

namespace Database\Seeders;

use App\Models\Trip;
use Illuminate\Database\Seeder;

class WinterEventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure Jeddah city reference when available; create minimal record if missing
        $jeddah = \App\Models\City::firstOrCreate(
            ['slug' => 'jeddah'],
            ['name' => 'Jeddah']
        );

     $events = [
    [
        'en' => [
            'title' => 'Winter Tilal & Sand — Egyptian Night',
            'slug' => 'winter-tilal-egyptian-night',
            'description' => 'Experience the pleasure — live oud performance, BBQ dinner, warm sessions and an archery challenge under the stars.',
            'content' => 'Live oud performance, warm sessions, delightful drinks, a BBQ feast and an archery challenge. Evening runs from 16:00 to 24:00.',
            'image' => '/trips/egyptian.jpg',
            'video' => '/videos/egyptian.mp4',
            'type' => 'event',
            'highlights' => ['Live Oud Performance','Warm Sessions','Drinks & BBQ','Archery Challenge'],
            'group_size' => '20-50 Persons',
            'lang' => 'en',
            'city_name' => 'Jeddah - Alghola',
            'start_date' => '2024-01-24',
        ],
        'ar' => [
            'title' => 'شتوية التلال والرمال',
            'slug' => 'winter-tilal-egyptian-night-ar',
            'description' => 'عيش المتعة',
            'content' => "جلسة طربية، جلسات دافئة، متعة المشروبات، الاستمتاع بوجبة الشواء، تحدي الرماية\nالجمعة ٢٤ يناير — جدة-الغولا — ٤ - ١٢ مساء",
            'image' => '/trips/egyptian.jpg',
            'video' => '/videos/egyptian.mp4',
            'type' => 'event',
            'highlights' => ['جلسة طربية','جلسات دافئة','متعة المشروبات','الاستمتاع بوجبة الشواء','تحدي الرماية'],
            'group_size' => '٢٠-٥٠ شخص',
            'lang' => 'ar',
            'city_name' => 'جدة - الغولا',
            'start_date' => '2024-01-24',
        ],
        'zh' => [
            'title' => '冬季蒂拉尔与沙地 — 埃及之夜',
            'slug' => 'winter-tilal-egyptian-night-zh',
            'description' => '体验乐趣 — 现场乌德琴演奏、烧烤晚餐、温馨聚会和星空下的射箭挑战。',
            'content' => '现场乌德琴演奏、温馨聚会、美味饮品、烧烤盛宴和射箭挑战。晚间活动时间为16:00至24:00。',
            'image' => '/trips/egyptian.jpg',
            'video' => '/videos/egyptian.mp4',
            'type' => 'event',
            'highlights' => ['现场乌德琴演奏','温馨聚会','饮品与烧烤','射箭挑战'],
            'group_size' => '20-50人',
            'lang' => 'zh',
            'city_name' => '吉达 - 阿尔古拉',
            'start_date' => '2024-01-24',
        ],
    ],

    [
        'en' => [
            'title' => 'Founding Day at Winter Tilal & Sand',
            'slug' => 'winter-tilal-founding-day',
            'description' => 'Founding Day celebration — parades, live oud, folkloric bands, traditional hospitality, horse & camel riding.',
            'content' => "Parade and celebratory performances. Live oud session by 'Al-Omda', folkloric bands, traditional hospitality, and horse & camel riding. Time: 17:00-00:00.",
            'image' => '/trips/saudifounday.jpg',
            'video' => '/videos/saudifounday.mp4',
            'type' => 'event',
            'highlights' => ['Parade','Oud Session','Folklore Bands','Camel & Horse Riding','Traditional Hospitality'],
            'group_size' => '30-100 Persons',
            'lang' => 'en',
            'city_name' => 'Jeddah - Alghola',
            'start_date' => '2024-02-03',
        ],
        'ar' => [
            'title' => 'يوم التأسيس في شتوية التلال والرمال',
            'slug' => 'yawm-al-tasis-shatwiyat-tilal',
            'description' => 'يوم بدينا',
            'content' => "اعيش اجواء مختلفة\nمسيرة يوم التأسيس، جلسة مع انغام العود بصوت الفنان \"العمدة\"، فرقة شعبية وفلكلور، فرقة شعبية نسائية، الضيافة الشعبية، ركوب الخيول والجمال\nالسبت ٢٣ فبراير — جدة-الغولا — ٤ - ١١ مساء",
            'image' => '/trips/saudifounday.jpg',
            'video' => '/videos/saudifounday.mp4',
            'type' => 'event',
            'highlights' => ['مسيرة يوم التأسيس','جلسة عود','فرق شعبية وفلكلور','ركوب الخيل والجمال','الضيافة الشعبية'],
            'group_size' => '٣٠-١٠٠ شخص',
            'lang' => 'ar',
            'city_name' => 'جدة - الغولا',
            'start_date' => '2024-02-03',
        ],
        'zh' => [
            'title' => '冬季蒂拉尔与沙地建国日庆典',
            'slug' => 'winter-tilal-founding-day-zh',
            'description' => '建国日庆典 — 游行、现场乌德琴、民俗乐队、传统待客之道、骑马与骑骆驼。',
            'content' => "游行和庆祝表演。'Al-Omda'现场乌德琴演奏，民俗乐队，传统待客之道，骑马与骑骆驼。时间：17:00-00:00。",
            'image' => '/trips/saudifounday.jpg',
            'video' => '/videos/saudifounday.mp4',
            'type' => 'event',
            'highlights' => ['游行','乌德琴演奏','民俗乐队','骑骆驼与骑马','传统待客之道'],
            'group_size' => '30-100人',
            'lang' => 'zh',
            'city_name' => '吉达 - 阿尔古拉',
            'start_date' => '2024-02-03',
        ],
    ],

    [
        'en' => [
            'title' => 'Egyptian Cultural Night at Winter Tilal & Sand',
            'slug' => 'winter-tilal-egyptian-cultural-night',
            'description' => 'Live a different atmosphere. Enjoy evening activities in nature with oud performances and Egyptian cuisine.',
            'content' => 'Experience different vibes. Oud session by "Al-Omda", dinner buffet with Egyptian dishes, and classic melodies session by "Amthal". Monday, February 3 — Jeddah - Alghola — 5:00 PM to 12:00 AM.',
            'image' => '/trips/jeddah.jpg',
            'video' => '/videos/jeddah.mp4',
            'type' => 'event',
            'highlights' => ['Oud Performance by Al-Omda','Egyptian Cuisine','Classic Melodies by Amthal','Natural Atmosphere'],
            'group_size' => '20-60 Persons',
            'lang' => 'en',
            'city_name' => 'Jeddah - Alghola',
            'start_date' => '2024-02-03',
        ],
        'ar' => [
            'title' => 'ليلة مصرية في شتوية التلال والرمال',
            'slug' => 'laylat-misriyya-shatwiyat-tilal',
            'description' => 'عيش اجواء مختلفة',
            'content' => "الاستمتاع بفقرات الأمسية في اجواء الطبيعة\nجلسة طربية على انغام العود بصوت \"العمدة\"، وجبة عشاء مشاوي واكلات مصرية، جلسة مع الانغام القديمة بصوت \"امثال\"\nالاثنين ٣ فبراير — جدة-الغولا — ٥ - ١٢ مساء",
            'image' => '/trips/jeddah.jpg',
            'video' => '/videos/jeddah.mp4',
            'type' => 'event',
            'highlights' => ['جلسة طربية','أكلات مصرية','جلسة انغام كلاسيكية','أجواء طبيعية'],
            'group_size' => '٢٠-٦٠ شخص',
            'lang' => 'ar',
            'city_name' => 'جدة - الغولا',
            'start_date' => '2024-02-03',
        ],
        'zh' => [
            'title' => '冬季蒂拉尔与沙地埃及文化之夜',
            'slug' => 'winter-tilal-egyptian-cultural-night-zh',
            'description' => '体验不同氛围。在大自然中享受晚间活动，聆听乌德琴演奏，品尝埃及美食。',
            'content' => "体验不同氛围。'Al-Omda'乌德琴演奏，埃及菜肴自助晚餐，'Amthal'经典旋律演奏。2月3日星期一 — 吉达 - 阿尔古拉 — 下午5:00至午夜12:00。",
            'image' => '/trips/jeddah.jpg',
            'video' => '/videos/jeddah.mp4',
            'type' => 'event',
            'highlights' => ['Al-Omda乌德琴演奏','埃及美食','Amthal经典旋律','自然氛围'],
            'group_size' => '20-60人',
            'lang' => 'zh',
            'city_name' => '吉达 - 阿尔古拉',
            'start_date' => '2024-02-03',
        ],
    ],
];

        foreach ($events as $pair) {
            // English row
            Trip::updateOrCreate([
                'slug' => $pair['en']['slug'],
                'lang' => 'en',
            ], array_merge($pair['en'], [
                'city_id' => $jeddah ? $jeddah->id : null,
            ]));

            // Arabic row
            Trip::updateOrCreate([
                'slug' => $pair['ar']['slug'],
                'lang' => 'ar',
            ], array_merge($pair['ar'], [
                'city_id' => $jeddah ? $jeddah->id : null,
            ]));
        }
    }
}
