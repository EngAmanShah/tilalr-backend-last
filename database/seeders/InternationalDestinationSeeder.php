<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InternationalDestination;

class InternationalDestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $destinations = [
            // UAE
            [
                'name_en' => 'Burj Khalifa Experience',
                'name_ar' => 'تجربة برج خليفة',
                'country_en' => 'UAE',
                'country_ar' => 'الإمارات',
                'city_en' => 'Dubai',
                'city_ar' => 'دبي',
                'description_en' => 'Visit the world\'s tallest building with panoramic views of Dubai',
                'description_ar' => 'زيارة أطول مبنى في العالم مع إطلالات بانورامية على دبي',
                'price' => 500,
                'active' => true,
            ],
            [
                'name_en' => 'Dubai Desert Safari',
                'name_ar' => 'سفاري صحراء دبي',
                'country_en' => 'UAE',
                'country_ar' => 'الإمارات',
                'city_en' => 'Dubai',
                'city_ar' => 'دبي',
                'description_en' => 'Experience the thrill of dune bashing and traditional Bedouin camp',
                'description_ar' => 'استمتع بإثارة القيادة على الكثبان الرملية ومخيم البدو التقليدي',
                'price' => 350,
                'active' => true,
            ],
            [
                'name_en' => 'Abu Dhabi Grand Mosque',
                'name_ar' => 'مسجد الشيخ زايد الكبير',
                'country_en' => 'UAE',
                'country_ar' => 'الإمارات',
                'city_en' => 'Abu Dhabi',
                'city_ar' => 'أبوظبي',
                'description_en' => 'Visit the magnificent Sheikh Zayed Grand Mosque',
                'description_ar' => 'زيارة مسجد الشيخ زايد الكبير الرائع',
                'price' => 250,
                'active' => true,
            ],

            // Turkey
            [
                'name_en' => 'Hagia Sophia Tour',
                'name_ar' => 'جولة آيا صوفيا',
                'country_en' => 'Turkey',
                'country_ar' => 'تركيا',
                'city_en' => 'Istanbul',
                'city_ar' => 'إسطنبول',
                'description_en' => 'Explore the iconic Hagia Sophia museum and mosque',
                'description_ar' => 'استكشف متحف ومسجد آيا صوفيا الأيقوني',
                'price' => 400,
                'active' => true,
            ],
            [
                'name_en' => 'Bosphorus Cruise',
                'name_ar' => 'رحلة بحرية في البوسفور',
                'country_en' => 'Turkey',
                'country_ar' => 'تركيا',
                'city_en' => 'Istanbul',
                'city_ar' => 'إسطنبول',
                'description_en' => 'Scenic cruise along the Bosphorus strait between Europe and Asia',
                'description_ar' => 'رحلة بحرية خلابة على طول مضيق البوسفور بين أوروبا وآسيا',
                'price' => 200,
                'active' => true,
            ],
            [
                'name_en' => 'Cappadocia Hot Air Balloon',
                'name_ar' => 'منطاد كابادوكيا',
                'country_en' => 'Turkey',
                'country_ar' => 'تركيا',
                'city_en' => 'Cappadocia',
                'city_ar' => 'كابادوكيا',
                'description_en' => 'Magical hot air balloon ride over the fairy chimneys',
                'description_ar' => 'رحلة ساحرة بالمنطاد فوق المداخن الجنية',
                'price' => 600,
                'active' => true,
            ],

            // Thailand
            [
                'name_en' => 'Bangkok Temple Tour',
                'name_ar' => 'جولة معابد بانكوك',
                'country_en' => 'Thailand',
                'country_ar' => 'تايلاند',
                'city_en' => 'Bangkok',
                'city_ar' => 'بانكوك',
                'description_en' => 'Visit the Grand Palace and famous Thai temples',
                'description_ar' => 'زيارة القصر الكبير والمعابد التايلاندية الشهيرة',
                'price' => 300,
                'active' => true,
            ],
            [
                'name_en' => 'Phuket Beach Resort',
                'name_ar' => 'منتجع شاطئ بوكيت',
                'country_en' => 'Thailand',
                'country_ar' => 'تايلاند',
                'city_en' => 'Phuket',
                'city_ar' => 'بوكيت',
                'description_en' => 'Relax at beautiful beaches and enjoy water activities',
                'description_ar' => 'استرخِ على الشواطئ الجميلة واستمتع بالأنشطة المائية',
                'price' => 450,
                'active' => true,
            ],

            // Maldives
            [
                'name_en' => 'Maldives Overwater Villa',
                'name_ar' => 'فيلا فوق الماء في المالديف',
                'country_en' => 'Maldives',
                'country_ar' => 'المالديف',
                'city_en' => 'Male',
                'city_ar' => 'ماليه',
                'description_en' => 'Luxury overwater villa experience with crystal clear waters',
                'description_ar' => 'تجربة فيلا فاخرة فوق الماء مع مياه صافية كريستالية',
                'price' => 1500,
                'active' => true,
            ],
            [
                'name_en' => 'Maldives Diving Adventure',
                'name_ar' => 'مغامرة الغوص في المالديف',
                'country_en' => 'Maldives',
                'country_ar' => 'المالديف',
                'city_en' => 'Ari Atoll',
                'city_ar' => 'أتول آري',
                'description_en' => 'Scuba diving with manta rays and tropical fish',
                'description_ar' => 'الغوص مع أسماك المانتا والأسماك الاستوائية',
                'price' => 700,
                'active' => true,
            ],

            // Egypt
            [
                'name_en' => 'Pyramids of Giza Tour',
                'name_ar' => 'جولة أهرامات الجيزة',
                'country_en' => 'Egypt',
                'country_ar' => 'مصر',
                'city_en' => 'Cairo',
                'city_ar' => 'القاهرة',
                'description_en' => 'Explore the ancient wonders of the Pyramids and Sphinx',
                'description_ar' => 'استكشف عجائب الأهرامات وأبو الهول القديمة',
                'price' => 350,
                'active' => true,
            ],
            [
                'name_en' => 'Nile River Cruise',
                'name_ar' => 'رحلة نهر النيل',
                'country_en' => 'Egypt',
                'country_ar' => 'مصر',
                'city_en' => 'Luxor',
                'city_ar' => 'الأقصر',
                'description_en' => 'Cruise along the Nile visiting ancient temples and tombs',
                'description_ar' => 'رحلة بحرية على النيل لزيارة المعابد والمقابر القديمة',
                'price' => 800,
                'active' => true,
            ],

            // Additional rows from provided SQL (name_zh + descriptions + images)
            [
                'name_en' => 'Malaysia',
                'name_ar' => 'ماليزيا',
                'name_zh' => '马来西亚',
                'description_en' => 'Special honeymoon',
                'description_ar' => 'شهر عسل مميز',
                'description_zh' => '特别的蜜月之旅',
                'price' => 499.00,
                'image' => 'international/1.webp',
                'active' => true,
            ],
            [
                'name_en' => 'Indonesia',
                'name_ar' => 'أندونيسيا',
                'name_zh' => '印度尼西亚',
                'description_en' => 'Unique honeymoon',
                'description_ar' => 'شهر عسل فريد من نوعه',
                'description_zh' => '独特的蜜月体验',
                'price' => 699.00,
                'image' => 'international/2.webp',
                'active' => true,
            ],
            [
                'name_en' => 'Singapore',
                'name_ar' => 'سنغافورة',
                'name_zh' => '新加坡',
                'description_en' => 'A romantic city, perfect for a honeymoon.',
                'description_ar' => 'مدينة رومانسية مثالية لشهر العسل.',
                'description_zh' => '浪漫之都，蜜月首选。',
                'price' => 399.00,
                'image' => 'international/3.webp',
                'active' => true,
            ],
            [
                'name_en' => 'Malaysia Family Trip',
                'name_ar' => 'ماليزيا - رحلة عائلية',
                'name_zh' => '马来西亚家庭游',
                'description_en' => 'A fun family trip for everyone.',
                'description_ar' => 'رحلة عائلية ممتعة للجميع.',
                'description_zh' => '适合全家的欢乐旅行。',
                'price' => 799.00,
                'image' => 'international/4.webp',
                'active' => true,
            ],
            [
                'name_en' => 'Indonesia Family Trip',
                'name_ar' => 'أندونيسيا - رحلة عائلية',
                'name_zh' => '印度尼西亚家庭游',
                'description_en' => 'An ideal destination for a fun family trip.',
                'description_ar' => 'وجهة مثالية لرحلة عائلية ممتعة.',
                'description_zh' => '家庭度假的理想目的地。',
                'price' => 449.00,
                'image' => 'international/5.webp',
                'active' => true,
            ],
            [
                'name_en' => 'Indonesia Nature',
                'name_ar' => 'أندونيسيا - الطبيعة',
                'name_zh' => '印度尼西亚自然之旅',
                'description_en' => 'A wonderful blend of nature and culture.',
                'description_ar' => 'مزيج رائع من الطبيعة والثقافة.',
                'description_zh' => '自然与文化的完美结合。',
                'price' => 899.00,
                'image' => 'international/6.webp',
                'active' => true,
            ],
            [
                'name_en' => 'Sri Lanka',
                'name_ar' => 'سريلانكا',
                'name_zh' => '斯里兰卡',
                'description_en' => 'The magic of history and modern spirit.',
                'description_ar' => 'سحر الطبيعة والجمال.',
                'description_zh' => '历史与自然的魅力。',
                'price' => null,
                'image' => 'international/7.webp',
                'active' => true,
            ],
            [
                'name_en' => 'Vietnam',
                'name_ar' => 'فيتنام',
                'name_zh' => '越南',
                'description_en' => 'A collection of history and modern life.',
                'description_ar' => 'مزيج من التاريخ والحياة العصرية.',
                'description_zh' => '历史与现代生活的结合。',
                'price' => null,
                'image' => 'international/8.webp',
                'active' => true,
            ],
            [
                'name_en' => 'China',
                'name_ar' => 'الصين',
                'name_zh' => '中国',
                'description_en' => 'A great destination combining tradition and technology.',
                'description_ar' => 'وجهة رائعة تجمع بين التاريخ والتطور.',
                'description_zh' => '融合传统与科技的精彩目的地。',
                'price' => 599.00,
                'image' => 'international/9.webp',
                'active' => true,
            ],
        ];

        foreach ($destinations as $destination) {
            InternationalDestination::updateOrCreate(
                ['name_en' => $destination['name_en']],
                $destination
            );
        }
    }
}
