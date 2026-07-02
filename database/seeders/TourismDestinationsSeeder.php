<?php

namespace Database\Seeders;

use App\Models\TourismDestination;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TourismDestinationsSeeder extends Seeder
{
    private $commonContactInfo = [
        'address' => 'Exit 5, Al Murooj, Riyadh',
        'phone' => '011 456 2097',
        'whatsapp' => '+966 5951 77774',
        'email' => 'info@travelerclub.sa.com',
    ];

    private $commonPaymentMethods = [
        [
            'name' => 'Bank Transfer',
            'account_no' => '593608010029976',
            'iban' => 'SA1080000593608010029976',
            'logo' => 'rajhi.webp',
        ],
        [
            'name' => 'بنك الرياض',
            'account_no' => '2451449249940',
            'iban' => 'SA202000000245144249940',
            'logo' => 'riyad.webp',
        ],
        [
            'name' => 'SNB الإمارات',
            'account_no' => '26163780000106',
            'iban' => 'SA3210000026163780000106',
            'logo' => 'ahli.webp',
        ],
        [
            'name' => 'Emirates NBD',
            'account_no' => '1016047862801',
            'iban' => 'SA9595000001016047862801',
            'logo' => 'nbd.webp',
        ],
        [
            'name' => 'SABB',
            'account_no' => '155285513001',
            'iban' => 'SA3945000000155285513001',
            'logo' => 'sabb.webp',
        ],
    ];

    public function run(): void
    {
        $destinations = [
            // ===== EUROPE =====
            [
                'title_en' => 'Britain & Ireland Tour',
                'title_ar' => 'جولة بريطانيا وأيرلندا',
                'description_en' => 'Stunning scenery, pretty villages, ancient sights, and exciting cities this Britain and Ireland tour offers all of this and more.',
                'description_ar' => 'مناظر خلابة، قرى جميلة، معالم قديمة، ومدن مثيرة - تقدم هذه الجولة في بريطانيا وأيرلندا كل هذا وأكثر.',
                'long_description_en' => 'Stunning scenery, pretty villages, ancient sights, and exciting cities this Britain and Ireland tour offers all of this and more. Your tour starts in Dublin, Ireland\'s fun capital, ends in London, England\'s exciting capital, and overnights along the way in Ennis, Killarney, Tramore, and Cardiff, the capital of Wales.',
                'long_description_ar' => 'مناظر خلابة، قرى جميلة، معالم قديمة، ومدن مثيرة - تقدم هذه الجولة في بريطانيا وأيرلندا كل هذا وأكثر. تبدأ جولتك في دبلن، عاصمة المرح في أيرلندا، وتنتهي في لندن، عاصمة إنجلترا المثيرة.',
                'location_en' => 'Britain & Ireland',
                'location_ar' => 'بريطانيا وأيرلندا',
                'duration_en' => '9 Days',
                'duration_ar' => '٩ أيام',
                'price' => '4100',
                'rating' => 4.8,
                'image' => '01KW8E20JEXP5P7280VW66CV64.jpeg', // ← CORRECT FILENAME
                'slug' => 'britain-ireland-tour',
                'region' => 'europe',
                'active' => true,
                'features_en' => ['Hotel', 'Full English breakfast daily', '2 dinners with choice of menus', 'Sightseeing tours'],
                'features_ar' => ['فندق', 'إفطار إنجليزي كامل يومياً', 'وجبتي عشاء مع قوائم اختيار', 'جولات سياحية'],
                'not_includes_en' => ['International flight', 'Visa'],
                'not_includes_ar' => ['الرحلات الدولية', 'التأشيرة'],
                'basic_info' => [
                    'trip_code' => 'AB9040',
                    'days_num' => 9,
                    'destination_name' => 'Britain & Ireland',
                    'available_to' => '30-09-2024',
                    'double_room' => 4100,
                    'single_room' => 8250,
                ],
                'contact_info' => $this->commonContactInfo,
                'payment_methods' => $this->commonPaymentMethods,
            ],
            // Poland
            [
                'title_en' => 'Poland Discovery Tour',
                'title_ar' => 'جولة اكتشاف بولندا',
                'description_en' => 'A rich cultural heritage, fascinating history, and beautiful landscapes make Poland an interesting place to discover.',
                'description_ar' => 'التراث الثقافي الغني والتاريخ الرائع والمناظر الطبيعية الجميلة تجعل بولندا مكانًا مثيرًا للاكتشاف.',
                'long_description_en' => 'A rich cultural heritage, fascinating history, and beautiful landscapes make Poland an interesting place to discover. On this Poland tour, you\'ll spend two nights in Warsaw and Gdansk, three nights in Kraków, and one night in Poznan.',
                'long_description_ar' => 'التراث الثقافي الغني والتاريخ الرائع والمناظر الطبيعية الجميلة تجعل بولندا مكانًا مثيرًا للاكتشاف.',
                'location_en' => 'Poland',
                'location_ar' => 'بولندا',
                'duration_en' => '9 Days',
                'duration_ar' => '٩ أيام',
                'price' => '3200',
                'rating' => 4.6,
                'image' => '5.jpg', // ← CORRECT FILENAME
                'slug' => 'poland-discovery',
                'region' => 'europe',
                'active' => true,
                'features_en' => ['Hotel', 'Breakfast daily', 'Sightseeing tours', 'Tour guide'],
                'features_ar' => ['فندق', 'إفطار يومي', 'جولات سياحية', 'مرشد سياحي'],
                'not_includes_en' => ['International flight', 'Visa'],
                'not_includes_ar' => ['الرحلات الدولية', 'التأشيرة'],
                'basic_info' => [
                    'trip_code' => '6080',
                    'days_num' => 9,
                    'destination_name' => 'Poland',
                    'available_to' => '07-09-2024',
                    'double_room' => 3200,
                    'single_room' => 6400,
                ],
                'contact_info' => $this->commonContactInfo,
                'payment_methods' => $this->commonPaymentMethods,
            ],
            // Norway
            [
                'title_en' => 'Norwegian Fjords Adventure',
                'title_ar' => 'مغامرة المضايق النرويجية',
                'description_en' => 'Your affordable guided tour of Norway focuses on the country\'s intact natural beauty with its glistening mountains, fjords, waterfalls, and glaciers.',
                'description_ar' => 'تركز جولتك المصحوبة بمرشد في النرويج على الجمال الطبيعي السليم للبلاد مع جبالها اللامعة ومضايقها وشلالاتها وأنهارها الجليدية.',
                'location_en' => 'Norway',
                'location_ar' => 'النرويج',
                'duration_en' => '11 Days',
                'duration_ar' => '١١ يومًا',
                'price' => '3800',
                'rating' => 4.9,
                'image' => 'norway.jpg', // ← You need to add this file
                'slug' => 'norway-fjords',
                'region' => 'europe',
                'active' => true,
                'features_en' => ['Hotel', 'Breakfast daily', 'Fjord cruise', 'Train journey'],
                'features_ar' => ['فندق', 'إفطار يومي', 'رحلة بحرية في المضايق', 'رحلة قطار'],
                'not_includes_en' => ['International flight', 'Visa'],
                'not_includes_ar' => ['الرحلات الدولية', 'التأشيرة'],
                'basic_info' => [
                    'trip_code' => 'NV7890',
                    'days_num' => 11,
                    'destination_name' => 'Norway',
                    'available_to' => '15-10-2024',
                    'double_room' => 3800,
                    'single_room' => 7600,
                ],
                'contact_info' => $this->commonContactInfo,
                'payment_methods' => $this->commonPaymentMethods,
            ],
            // Germany
            [
                'title_en' => 'Highlights of Germany',
                'title_ar' => 'معالم ألمانيا البارزة',
                'description_en' => 'Spectacular scenery, medieval towns, fairy-tale castles, a fascinating history, and world-class beer...this is Germany!',
                'description_ar' => 'مناظر خلابة، مدن من العصور الوسطى، قلاع خرافية، تاريخ رائع، وبيرة عالمية... هذه هي ألمانيا!',
                'location_en' => 'Germany',
                'location_ar' => 'ألمانيا',
                'duration_en' => '12 Days',
                'duration_ar' => '١٢ يومًا',
                'price' => '3500',
                'rating' => 4.7,
                'image' => 'germany.jpg', // ← You need to add this file
                'slug' => 'highlights-of-germany',
                'region' => 'europe',
                'active' => true,
                'features_en' => ['Hotel', 'Breakfast daily', 'Rhine cruise', 'Castle visits'],
                'features_ar' => ['فندق', 'إفطار يومي', 'رحلة بحرية على نهر الراين', 'زيارات القلاع'],
                'not_includes_en' => ['International flight', 'Visa'],
                'not_includes_ar' => ['الرحلات الدولية', 'التأشيرة'],
                'basic_info' => [
                    'trip_code' => 'GR5678',
                    'days_num' => 12,
                    'destination_name' => 'Germany',
                    'available_to' => '20-11-2024',
                    'double_room' => 3500,
                    'single_room' => 7000,
                ],
                'contact_info' => $this->commonContactInfo,
                'payment_methods' => $this->commonPaymentMethods,
            ],
            // Switzerland
            [
                'title_en' => 'Switzerland Package',
                'title_ar' => 'باقة سويسرا',
                'description_en' => 'This Scenic Switzerland by Train tour is the perfect way to see Switzerland breathtaking mountains, charming mountain resorts, fascinating old towns, and beautiful lakes.',
                'description_ar' => 'هذه الجولة الخلابة في سويسرا بالقطار هي الطريقة المثالية لرؤية جبال سويسرا الخلابة ومنتجعات الجبال الساحرة والمدن القديمة الرائعة والبحيرات الجميلة.',
                'location_en' => 'Switzerland',
                'location_ar' => 'سويسرا',
                'duration_en' => '9 Days',
                'duration_ar' => '٩ أيام',
                'price' => '4200',
                'rating' => 4.9,
                'image' => 'switzerland.jpg', // ← You need to add this file
                'slug' => 'switzerland-package',
                'region' => 'europe',
                'active' => true,
                'features_en' => ['Hotel', 'Buffet breakfasts daily', '3 dinners', 'Train tours'],
                'features_ar' => ['فندق', 'إفطار بوفيه يومي', '٣ وجبات عشاء', 'جولات بالقطار'],
                'not_includes_en' => ['International flight', 'Visa'],
                'not_includes_ar' => ['الرحلات الدولية', 'التأشيرة'],
                'basic_info' => [
                    'trip_code' => 'CH9012',
                    'days_num' => 9,
                    'destination_name' => 'Switzerland',
                    'available_to' => '05-12-2024',
                    'double_room' => 4200,
                    'single_room' => 8400,
                ],
                'contact_info' => $this->commonContactInfo,
                'payment_methods' => $this->commonPaymentMethods,
            ],
            // ===== ASIA =====
            [
                'title_en' => 'Thailand Beach Getaway',
                'title_ar' => 'رحلة شاطئ تايلاند',
                'description_en' => 'Experience the beautiful beaches and rich culture of Thailand.',
                'description_ar' => 'اختبر الشواطئ الجميلة والثقافة الغنية لتايلاند.',
                'location_en' => 'Thailand',
                'location_ar' => 'تايلاند',
                'duration_en' => '7 Days',
                'duration_ar' => '٧ أيام',
                'price' => '2000',
                'rating' => 4.8,
                'image' => 'thailand.jpg', // ← You need to add this file
                'slug' => 'thailand-getaway',
                'region' => 'asia',
                'active' => true,
                'features_en' => ['Hotel', 'Breakfast daily', 'Island tours', 'Water activities'],
                'features_ar' => ['فندق', 'إفطار يومي', 'جولات الجزر', 'الأنشطة المائية'],
                'not_includes_en' => ['International flight', 'Visa'],
                'not_includes_ar' => ['الرحلات الدولية', 'التأشيرة'],
                'basic_info' => [
                    'trip_code' => 'TH3456',
                    'days_num' => 7,
                    'destination_name' => 'Thailand',
                    'available_to' => '15-08-2024',
                    'double_room' => 2000,
                    'single_room' => 4000,
                ],
                'contact_info' => $this->commonContactInfo,
                'payment_methods' => $this->commonPaymentMethods,
            ],
            // ===== AFRICA =====
            [
                'title_en' => 'Morocco Discovery Tour',
                'title_ar' => 'جولة اكتشاف المغرب',
                'description_en' => 'Explore the vibrant culture, stunning architecture, and delicious cuisine of Morocco.',
                'description_ar' => 'استكشف الثقافة النابضة بالحياة والهندسة المعمارية المذهلة والمأكولات اللذيذة في المغرب.',
                'location_en' => 'Morocco',
                'location_ar' => 'المغرب',
                'duration_en' => '10 Days',
                'duration_ar' => '١٠ أيام',
                'price' => '2600',
                'rating' => 4.8,
                'image' => 'morocco.jpg', // ← You need to add this file
                'slug' => 'morocco-discovery',
                'region' => 'africa',
                'active' => true,
                'features_en' => ['Hotel', 'Breakfast daily', 'City tours', 'Desert excursion'],
                'features_ar' => ['فندق', 'إفطار يومي', 'جولات المدينة', 'رحلة صحراوية'],
                'not_includes_en' => ['International flight', 'Visa'],
                'not_includes_ar' => ['الرحلات الدولية', 'التأشيرة'],
                'basic_info' => [
                    'trip_code' => 'MO7890',
                    'days_num' => 10,
                    'destination_name' => 'Morocco',
                    'available_to' => '25-09-2024',
                    'double_room' => 2600,
                    'single_room' => 5200,
                ],
                'contact_info' => $this->commonContactInfo,
                'payment_methods' => $this->commonPaymentMethods,
            ],
            // ===== AUSTRALIA & NEW ZEALAND =====
            [
                'title_en' => 'Australia Adventure Tour',
                'title_ar' => 'جولة مغامرة أستراليا',
                'description_en' => 'Discover the stunning landscapes and unique wildlife of Australia.',
                'description_ar' => 'اكتشف المناظر الطبيعية الخلابة والحياة البرية الفريدة في أستراليا.',
                'location_en' => 'Australia',
                'location_ar' => 'أستراليا',
                'duration_en' => '12 Days',
                'duration_ar' => '١٢ يومًا',
                'price' => '4500',
                'rating' => 4.9,
                'image' => 'datacenter.png', // ← CORRECT FILENAME
                'slug' => 'australia-adventure',
                'region' => 'australia',
                'active' => true,
                'features_en' => ['Hotel', 'Breakfast daily', 'Wildlife tours', 'City sightseeing'],
                'features_ar' => ['فندق', 'إفطار يومي', 'جولات الحياة البرية', 'جولات المدينة'],
                'not_includes_en' => ['International flight', 'Visa'],
                'not_includes_ar' => ['الرحلات الدولية', 'التأشيرة'],
                'basic_info' => [
                    'trip_code' => 'AU1234',
                    'days_num' => 12,
                    'destination_name' => 'Australia',
                    'available_to' => '10-11-2024',
                    'double_room' => 4500,
                    'single_room' => 9000,
                ],
                'contact_info' => $this->commonContactInfo,
                'payment_methods' => $this->commonPaymentMethods,
            ],
        ];

        foreach ($destinations as $destination) {
            // Ensure slug exists
            if (!isset($destination['slug'])) {
                $destination['slug'] = \Illuminate\Support\Str::slug($destination['title_en']);
            }

            // Ensure active is set
            if (!isset($destination['active'])) {
                $destination['active'] = true;
            }

            // Convert arrays to JSON for storage
            $destination['features_en'] = json_encode($destination['features_en'] ?? []);
            $destination['features_ar'] = json_encode($destination['features_ar'] ?? []);
            $destination['not_includes_en'] = json_encode($destination['not_includes_en'] ?? []);
            $destination['not_includes_ar'] = json_encode($destination['not_includes_ar'] ?? []);
            $destination['basic_info'] = json_encode($destination['basic_info'] ?? []);
            $destination['contact_info'] = json_encode($destination['contact_info'] ?? []);
            $destination['payment_methods'] = json_encode($destination['payment_methods'] ?? []);

            TourismDestination::updateOrCreate(
                ['slug' => $destination['slug']],
                $destination
            );
        }
    }
}
