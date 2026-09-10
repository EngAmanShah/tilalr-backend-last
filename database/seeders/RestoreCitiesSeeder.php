<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RestoreCitiesSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('cities')->truncate();

        $now = now();

        $cities = [
            // Riyadh
            [
                'name' => 'الرياض',
                'slug' => 'riyadh',
                'description' => 'الرياض هي عاصمة المملكة العربية السعودية وأكبر مركز مالي فيها، وتقع على هضبة صحراوية شاسعة في وسط شبه الجزيرة العربية. استحالت من بلدة واحة محصنة تاريخية إلى واحدة من أسرع الاقتصادات الحضرية الحديثة نموًا في العالم.',
                'image' => '/cities/riyadh.png',
                'country' => 'Saudi Arabia',
                'order' => 1,
                'lang' => 'ar',
                'is_active' => 1,
                'best_time' => 'من أكتوبر إلى مارس',
                'activities' => json_encode(["جولات المدينة", "زيارة المتاحف", "التسوق", "تناول الطعام", "ركوب المترو"]),
                'landmarks' => json_encode([
                    [
                        'name' => 'مركز الملك عبدالله المالي',
                        'description' => 'مركز تجاري حديث مليء بناطحات السحاب يستضيف شركات دولية كبرى وعجائب معمارية.',
                        'image' => '/cities/riyadh-kafd.jpg'
                    ],
                    [
                        'name' => 'برج المملكة',
                        'description' => 'برج شهير بارتفاع 302 متر مشهور بجسره السماوي المضاء الذي يوفر إطلالات بانورامية على أفق المدينة بالكامل.',
                        'image' => '/cities/riyadh-kingdom-centre.jpg'
                    ],
                    [
                        'name' => 'قصر المصمك',
                        'description' => 'قلب المدينة التاريخي، يضم قلعة عام 1902 الشهيرة التي أعطت آل سعود السيطرة على المنطقة.',
                        'image' => '/cities/riyadh-masmak.jpg'
                    ]
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Riyadh',
                'slug' => 'riyadh',
                'description' => "Riyadh is the capital and largest financial hub of Saudi Arabia, situated on a vast desert plateau in the center of the Arabian Peninsula. Driven by the kingdom's economic blueprint, it has transformed from a historic walled oasis town into one of the world's fastest-growing, ultra-modern metropolitan economies.",
                'image' => '/cities/riyadh.png',
                'country' => 'Saudi Arabia',
                'order' => 1,
                'lang' => 'en',
                'is_active' => 1,
                'best_time' => 'October to March',
                'activities' => json_encode(["City Tours", "Museum Visits", "Shopping", "Dining", "Metro Rides"]),
                'landmarks' => json_encode([
                    [
                        'name' => 'King Abdullah Financial District (KAFD)',
                        'description' => 'A futuristic, skyscraper-filled commercial hub that hosts major international corporations and cutting-edge architectural marvels.',
                        'image' => '/cities/riyadh-kafd.jpg'
                    ],
                    [
                        'name' => 'Kingdom Centre',
                        'description' => 'A landmark 302-meter-high tower famous for its illuminated Sky Bridge, which offers panoramic views of the entire city skyline.',
                        'image' => '/cities/riyadh-kingdom-centre.jpg'
                    ],
                    [
                        'name' => 'Masmak Fortress',
                        'description' => 'The heritage heart of the city, housing the iconic 1902 fortress that gave the Al Saud family control of the region.',
                        'image' => '/cities/riyadh-masmak.jpg'
                    ]
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Jeddah
            [
                'name' => 'جدة',
                'slug' => 'jeddah',
                'description' => 'جدة مدينة ساحلية نابضة بالحياة على البحر الأحمر، تُعرف بأنها بوابة المواقع الإسلامية المقدسة. بفضل كورنيشها الخلاب وأسواقها التقليدية وتطورها الحديث على الواجهة المائية، تقدم مزيجًا فريدًا من التقاليد والثقافة المعاصرة.',
                'image' => '/cities/jeddah.png',
                'country' => 'Saudi Arabia',
                'order' => 2,
                'lang' => 'ar',
                'is_active' => 1,
                'best_time' => 'من أكتوبر إلى أبريل',
                'activities' => json_encode(["الأنشطة الساحلية", "استكشاف المدينة القديمة", "تناول الطعام", "التسوق", "الرياضات المائية"]),
                'landmarks' => json_encode([
                    [
                        'name' => 'كورنيش جدة',
                        'description' => 'رصيف مائي جميل بطول 35 كيلومتر يوفر مناظر رائعة للبحر الأحمر مع مرافق ترفيهية حديثة.',
                        'image' => '/cities/jeddah-corniche.jpg'
                    ],
                    [
                        'name' => 'البلد',
                        'description' => 'المدينة القديمة التاريخية بمعمارها التقليدي والشوارع الضيقة والأسواق الأصيلة التي تعود لعدة قرون.',
                        'image' => '/cities/jeddah-balad.jpg'
                    ],
                    [
                        'name' => 'المسجد العائم',
                        'description' => 'مسجد أيقوني مبني على البحر الأحمر بمعمارية مذهلة وأجواء سلمية.',
                        'image' => '/cities/jeddah-mosque.jpg'
                    ]
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Jeddah',
                'slug' => 'jeddah',
                'description' => "Jeddah is a vibrant coastal city on the Red Sea, known as the gateway to Islamic holy sites. With its stunning corniche, traditional markets, and modern waterfront developments, it offers a unique blend of tradition and contemporary culture.",
                'image' => '/cities/jeddah.png',
                'country' => 'Saudi Arabia',
                'order' => 2,
                'lang' => 'en',
                'is_active' => 1,
                'best_time' => 'October to April',
                'activities' => json_encode(["Beach Activities", "Old Town Exploration", "Dining", "Shopping", "Water Sports"]),
                'landmarks' => json_encode([
                    [
                        'name' => 'Jeddah Corniche',
                        'description' => 'A stunning 35-kilometer waterfront promenade offering beautiful views of the Red Sea with modern entertainment facilities.',
                        'image' => '/cities/jeddah-corniche.jpg'
                    ],
                    [
                        'name' => 'Al-Balad',
                        'description' => 'The historic old town featuring traditional architecture, narrow streets, and authentic souks dating back centuries.',
                        'image' => '/cities/jeddah-balad.jpg'
                    ],
                    [
                        'name' => 'The Floating Mosque',
                        'description' => 'An iconic mosque built on the Red Sea with stunning architecture and peaceful surroundings.',
                        'image' => '/cities/jeddah-mosque.jpg'
                    ]
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // AlUla
            [
                'name' => 'العلا',
                'slug' => 'alula',
                'description' => 'العلا وجهة صحراوية رائعة تتميز بتكوينات صخرية قديمة ومواقع أثرية ومناظر صحراوية خلابة. إنها موطن مدائن صالح، موقع تراث عالمي لليونسكو، وتوفر للزوار لمحة عن الحضارة العربية القديمة.',
                'image' => '/cities/alula.jpg',
                'country' => 'Saudi Arabia',
                'order' => 3,
                'lang' => 'ar',
                'is_active' => 1,
                'best_time' => 'من أكتوبر إلى مارس',
                'activities' => json_encode(["المشي لمسافات طويلة", "الجولات الأثرية", "التصوير الفوتوغرافي", "التخييم", "تسلق الصخور"]),
                'landmarks' => json_encode([
                    [
                        'name' => 'مدائن صالح',
                        'description' => 'موقع أثري مذهل مع قبور منحوتة في الصخور وآثار قديمة تعود للحضارة النبطية.',
                        'image' => '/cities/alula-madain.jpg'
                    ],
                    [
                        'name' => 'صخرة الفيل',
                        'description' => 'تكوين صخري طبيعي أيقوني على شكل فيل، يقف بشموخ في المناظر الطبيعية الصحراوية.',
                        'image' => '/cities/alula-elephant.jpg'
                    ]
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'AlUla',
                'slug' => 'alula',
                'description' => "AlUla is a spectacular desert destination featuring ancient rock formations, archaeological sites, and stunning desert landscapes. It's home to Madain Saleh, a UNESCO World Heritage Site, and offers visitors a glimpse into ancient Arabian civilization.",
                'image' => '/cities/alula.jpg',
                'country' => 'Saudi Arabia',
                'order' => 3,
                'lang' => 'en',
                'is_active' => 1,
                'best_time' => 'October to March',
                'activities' => json_encode(["Hiking", "Archaeological Tours", "Photography", "Camping", "Rock Climbing"]),
                'landmarks' => json_encode([
                    [
                        'name' => 'Madain Saleh',
                        'description' => 'A stunning archaeological site with carved rock tombs and ancient ruins dating back to the Nabatean civilization.',
                        'image' => '/cities/alula-madain.jpg'
                    ],
                    [
                        'name' => 'Elephant Rock',
                        'description' => 'An iconic natural rock formation shaped like an elephant, standing majestically in the desert landscape.',
                        'image' => '/cities/alula-elephant.jpg'
                    ]
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Tabuk
            [
                'name' => 'تبوك',
                'slug' => 'tabuk',
                'description' => 'تبوك مدينة سعودية شمالية معروفة بموقعها الاستراتيجي وأهميتها التاريخية والمناظر الطبيعية الصحراوية الفريدة. تعتبر بوابة للمغامرة مع أنشطة الجبال والمناطق الطبيعية الخلابة.',
                'image' => '/cities/tabuk.jpeg',
                'country' => 'Saudi Arabia',
                'order' => 4,
                'lang' => 'ar',
                'is_active' => 1,
                'best_time' => 'من سبتمبر إلى مايو',
                'activities' => json_encode(["التسلق والهايكنج", "الرياضات المائية", "استكشاف التاريخ", "رحلات السفاري"]),
                'landmarks' => json_encode([
                    [
                        'name' => 'قلعة تبوك',
                        'description' => 'حصن تاريخي يعرض العمارة العثمانية ويقدم رؤى للتراث العسكري للمنطقة.',
                        'image' => '/cities/tabuk-castle.jpg'
                    ],
                    [
                        'name' => 'خليج العقبة',
                        'description' => 'مياه ساحلية جميلة مثالية للسباحة والغطس والأنشطة المائية.',
                        'image' => '/cities/tabuk-aqaba.jpg'
                    ]
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Tabuk',
                'slug' => 'tabuk',
                'description' => "Tabuk is a northern Saudi city known for its strategic location, historical significance, and unique desert landscapes. It serves as a gateway to adventure with mountain activities and scenic natural attractions.",
                'image' => '/cities/tabuk.jpeg',
                'country' => 'Saudi Arabia',
                'order' => 4,
                'lang' => 'en',
                'is_active' => 1,
                'best_time' => 'September to May',
                'activities' => json_encode(["Hiking", "Water Sports", "Historical Sightseeing", "Desert Safaris"]),
                'landmarks' => json_encode([
                    [
                        'name' => 'Tabuk Castle',
                        'description' => "A historic fortress showcasing Ottoman architecture and offering insights into the region's military heritage.",
                        'image' => '/cities/tabuk-castle.jpg'
                    ],
                    [
                        'name' => 'Gulf of Aqaba',
                        'description' => 'Beautiful coastal waters perfect for swimming, snorkeling, and water sports activities.',
                        'image' => '/cities/tabuk-aqaba.jpg'
                    ]
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Makkah
            [
                'name' => 'مكة المكرمة',
                'slug' => 'makkah',
                'description' => 'مكة المكرمة هي أقدس مدينة في الإسلام وموطن المسجد الحرام والكعبة المشرفة. تستقبل ملايين الحجاج والزوار سنويًا لتأدية مناسك الحج والعمرة.',
                'image' => '/cities/makkah.jpeg',
                'country' => 'Saudi Arabia',
                'order' => 5,
                'lang' => 'ar',
                'is_active' => 1,
                'best_time' => 'طوال العام (يفضل من نوفمبر إلى مارس)',
                'activities' => json_encode(["العمرة والزيارة", "التسوق الثقافي", "المتاحف الإسلامية"]),
                'landmarks' => json_encode([
                    [
                        'name' => 'المسجد الحرام',
                        'description' => 'أكبر مسجد في العالم ويضم الكعبة المشرفة القبلة الموحدة لجميع المسلمين.',
                        'image' => '/cities/makkah.jpeg'
                    ],
                    [
                        'name' => 'برج الساعة (أبراج البيت)',
                        'description' => 'مجمع أبراج مهيب يقع بجوار المسجد الحرام ويضم ثالث أطول ناطحة سحاب في العالم.',
                        'image' => '/cities/makkah.jpeg'
                    ]
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Makkah',
                'slug' => 'makkah',
                'description' => "Makkah is the holiest city in Islam, home to the Masjid al-Haram and the Kaaba. Millions of pilgrims visit annually for Hajj and Umrah.",
                'image' => '/cities/makkah.jpeg',
                'country' => 'Saudi Arabia',
                'order' => 5,
                'lang' => 'en',
                'is_active' => 1,
                'best_time' => 'Year-round (Preferably November to March)',
                'activities' => json_encode(["Umrah Pilgrimage", "Cultural Shopping", "Islamic History Tours"]),
                'landmarks' => json_encode([
                    [
                        'name' => 'Masjid al-Haram',
                        'description' => 'The largest mosque in the world and the focal point of Islamic prayers, housing the holy Kaaba.',
                        'image' => '/cities/makkah.jpeg'
                    ],
                    [
                        'name' => 'Abraj Al Bait (Clock Tower)',
                        'description' => 'A towering skyscraper complex next to the Grand Mosque containing the world\'s largest clock face.',
                        'image' => '/cities/makkah.jpeg'
                    ]
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Madina
            [
                'name' => 'المدينة المنورة',
                'slug' => 'madina',
                'description' => 'المدينة المنورة هي ثاني أقدس المدن الإسلامية ومثوى النبي محمد صلى الله عليه وسلم. تشتهر بأجوائها الروحانية الهادئة ومساجدها التاريخية ومزارع النخيل الخصبة.',
                'image' => '/cities/makkah.jpeg',
                'country' => 'Saudi Arabia',
                'order' => 6,
                'lang' => 'ar',
                'is_active' => 1,
                'best_time' => 'من أكتوبر إلى أبريل',
                'activities' => json_encode(["الصلاة في المسجد النبوي", "زيارة المعالم التاريخية", "تذوق التمور"]),
                'landmarks' => json_encode([
                    [
                        'name' => 'المسجد النبوي',
                        'description' => 'المسجد الأيقوني الذي بناه النبي محمد صلى الله عليه وسلم ويضم الحجرة النبوية الشريفة والروضة.',
                        'image' => '/cities/makkah.jpeg'
                    ],
                    [
                        'name' => 'مسجد قباء',
                        'description' => 'أول مسجد بني في تاريخ الإسلام ويقع على أطراف المدينة المنورة.',
                        'image' => '/cities/makkah.jpeg'
                    ]
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Madina',
                'slug' => 'madina',
                'description' => "Madina is the second holiest city in Islam, home to the Prophet's Mosque (Al-Masjid an-Nabawi). It offers a peaceful spiritual atmosphere and rich historical sites.",
                'image' => '/cities/makkah.jpeg',
                'country' => 'Saudi Arabia',
                'order' => 6,
                'lang' => 'en',
                'is_active' => 1,
                'best_time' => 'October to April',
                'activities' => json_encode(["Prophet's Mosque Visits", "Islamic History Tours", "Date Tasting"]),
                'landmarks' => json_encode([
                    [
                        'name' => 'Al-Masjid an-Nabawi',
                        'description' => 'The Prophet\'s Mosque, established by the Prophet Muhammad himself, featuring the iconic Green Dome.',
                        'image' => '/cities/makkah.jpeg'
                    ],
                    [
                        'name' => 'Quba Mosque',
                        'description' => 'The first mosque built in Islamic history, located on the outskirts of Madina.',
                        'image' => '/cities/makkah.jpeg'
                    ]
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Abha
            [
                'name' => 'أبها',
                'slug' => 'abha',
                'description' => 'أبها هي عاصمة منطقة عسير في جنوب غرب المملكة العربية السعودية، وتقع في جبال السروات الشاهقة. تشتهر بمناخها اللطيف المعتدل حتى في الصيف وتلالها الخضراء وثقافتها العسيرية الملونة.',
                'image' => '/cities/abha.jpeg',
                'country' => 'Saudi Arabia',
                'order' => 7,
                'lang' => 'ar',
                'is_active' => 1,
                'best_time' => 'من أبريل إلى سبتمبر',
                'activities' => json_encode(["المشي لمسافات طويلة", "ركوب الدراجات الجبلية", "مشاهدة المعالم", "جولات الأسواق المحلية", "التصوير الفوتوغرافي"]),
                'landmarks' => json_encode([
                    [
                        'name' => 'منتزه عسير الوطني',
                        'description' => 'محمية طبيعية جميلة تتميز بتنوع النباتات والحيوانات ومسارات المشي لمسافات طويلة عبر الجبال والوديان.',
                        'image' => '/cities/abha.jpeg'
                    ],
                    [
                        'name' => 'سد أبها',
                        'description' => 'بحيرة اصطناعية خلابة محاطة بجبال خضراء، مثالية للتصوير الفوتوغرافي والاسترخاء.',
                        'image' => '/cities/abha.jpeg'
                    ]
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Abha',
                'slug' => 'abha',
                'description' => "Abha is the capital of the Asir Province, nestled in the Sarawat Mountains of southwestern Saudi Arabia. Famous for its cool year-round climate, foggy mountain peaks, green terraces, and colorful local culture.",
                'image' => '/cities/abha.jpeg',
                'country' => 'Saudi Arabia',
                'order' => 7,
                'lang' => 'en',
                'is_active' => 1,
                'best_time' => 'April to September',
                'activities' => json_encode(["Hiking", "Mountain Biking", "Sightseeing", "Local Market Tours", "Photography"]),
                'landmarks' => json_encode([
                    [
                        'name' => 'Asir National Park',
                        'description' => 'A stunning reserve featuring dense juniper forests, wild eagles, and panoramic mountain paths.',
                        'image' => '/cities/abha.jpeg'
                    ],
                    [
                        'name' => 'Abha Dam Lake',
                        'description' => 'A serene reservoir surrounded by green hills, perfect for afternoon walks and viewing city lights.',
                        'image' => '/cities/abha.jpeg'
                    ]
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Arar
            [
                'name' => 'عرعر',
                'slug' => 'arar',
                'description' => 'عرعر هي عاصمة منطقة الحدود الشمالية في المملكة العربية السعودية. تقع على الهضبة الصخرية الشمالية، وتعتبر مركزاً تجارياً مهماً غنياً بالتراث الثقافي وقريباً من مسارات خطوط الأنابيب التاريخية.',
                'image' => '/cities/Arar.jpeg',
                'country' => 'Saudi Arabia',
                'order' => 8,
                'lang' => 'ar',
                'is_active' => 1,
                'best_time' => 'من نوفمبر إلى مارس',
                'activities' => json_encode(["التخييم الصحراوي", "النزهات في الوادي", "الاستكشاف الثقافي", "تناول الأطعمة التقليدية"]),
                'landmarks' => json_encode([
                    [
                        'name' => 'وادي عرعر',
                        'description' => 'وادي طبيعي خلاب يكتسي بالخضرة بعد الأمطار الشتوية، مثالي للنزهات العائلية.',
                        'image' => '/cities/Arar.jpeg'
                    ],
                    [
                        'name' => 'متحف الحدود الشمالية',
                        'description' => 'يعرض التاريخ الأثري والثقافة البدوية التقليدية لمنطقة الحدود الشمالية.',
                        'image' => '/cities/Arar.jpeg'
                    ]
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Arar',
                'slug' => 'arar',
                'description' => "Arar is the capital of the Northern Borders Province in Saudi Arabia. Situated on the northern rocky limestone plateau, it is a significant trading hub, rich in cultural heritage and close to the ancient trans-Arabian pipeline routes.",
                'image' => '/cities/Arar.jpeg',
                'country' => 'Saudi Arabia',
                'order' => 8,
                'lang' => 'en',
                'is_active' => 1,
                'best_time' => 'November to March',
                'activities' => json_encode(["Desert Camping", "Valley Picnics", "Cultural Exploration", "Traditional Dining"]),
                'landmarks' => json_encode([
                    [
                        'name' => 'Arar Valley',
                        'description' => 'A stunning valley that greens up beautifully after winter rains, perfect for family picnics.',
                        'image' => '/cities/Arar.jpeg'
                    ],
                    [
                        'name' => 'Northern Borders Museum',
                        'description' => 'Showcases the archaeological history and traditional Bedouin culture of the northern region.',
                        'image' => '/cities/Arar.jpeg'
                    ]
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Sakaka
            [
                'name' => 'سكاكا',
                'slug' => 'sakaka',
                'description' => 'سكاكا هي عاصمة منطقة الجوف في شمال غرب المملكة العربية السعودية. تشتهر بتاريخها العريق الذي يعود لآلاف السنين، وتضم قلاعاً أثرية وأعمدة حجرية غامضة وبساتين زيتون وفيرة.',
                'image' => '/cities/Sakaka.jpeg',
                'country' => 'Saudi Arabia',
                'order' => 9,
                'lang' => 'ar',
                'is_active' => 1,
                'best_time' => 'من أكتوبر إلى أبريل',
                'activities' => json_encode(["الجولات التاريخية", "تذوق زيت الزيتون", "التصوير الفوتوغرافي", "المشي الأثري"]),
                'landmarks' => json_encode([
                    [
                        'name' => 'قلعة زعبل',
                        'description' => 'حصن حجري مهيب يقع على قمة جبلية، يعود تاريخه إلى العصر النبطي.',
                        'image' => '/cities/Sakaka.jpeg'
                    ],
                    [
                        'name' => 'أعمدة الرجاجيل',
                        'description' => 'أعمدة حجرية قائمة غامضة تعود لعصر ما قبل التاريخ، وتُعرف باسم ستونهنج الجزيرة العربية.',
                        'image' => '/cities/Sakaka.jpeg'
                    ]
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Sakaka',
                'slug' => 'sakaka',
                'description' => "Sakaka is the capital city of Al Jouf Province in northwestern Saudi Arabia. Known for its rich history dating back thousands of years, it is home to ancient fortresses, mysterious stone pillars, and lush olive groves.",
                'image' => '/cities/Sakaka.jpeg',
                'country' => 'Saudi Arabia',
                'order' => 9,
                'lang' => 'en',
                'is_active' => 1,
                'best_time' => 'October to April',
                'activities' => json_encode(["Historical Tours", "Olive Oil Tastings", "Scenic Photography", "Archaeological Walks"]),
                'landmarks' => json_encode([
                    [
                        'name' => "Za'abal Castle",
                        'description' => 'An imposing stone fortress perched on a mountain peak, dating back to Nabataean times.',
                        'image' => '/cities/Sakaka.jpeg'
                    ],
                    [
                        'name' => 'Rajajil Columns',
                        'description' => 'Mystery-shrouded prehistoric standing stone pillars, often called the Stonehenge of Arabia.',
                        'image' => '/cities/Sakaka.jpeg'
                    ]
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Hail
            [
                'name' => 'حائل',
                'slug' => 'hail',
                'description' => 'حائل هي مدينة واحة في منطقة نجد شمال غرب المملكة العربية السعودية، تحيط بها جبال شمر المهيبة. ترتبط تاريخياً بالشاعر والرمز العربي الأسطوري حاتم الطائي، وتشتهر بكرم الضيافة والفنون الصخرية المسجلة في اليونسكو.',
                'image' => '/cities/hail.jpeg',
                'country' => 'Saudi Arabia',
                'order' => 10,
                'lang' => 'ar',
                'is_active' => 1,
                'best_time' => 'من أكتوبر إلى أبريل',
                'activities' => json_encode(["المشي الجبلي", "جولات الفنون الصخرية", "سفاري الصحراء", "زيارة المجالس الثقافية"]),
                'landmarks' => json_encode([
                    [
                        'name' => 'قلعة أعيرف',
                        'description' => 'قلعة طينية تاريخية تقع على قمة تل، وتوفر إطلالات بانورامية على مدينة حائل.',
                        'image' => '/cities/hail.jpeg'
                    ],
                    [
                        'name' => 'رسوم جبة الصخرية',
                        'description' => 'موقع تراث عالمي لليونسكو يعرض نقوشاً صخرية استثنائية تعود إلى 10,000 عام.',
                        'image' => '/cities/hail.jpeg'
                    ]
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => "Ha'il",
                'slug' => 'hail',
                'description' => "Ha'il is an oasis city in the Nejd region of northwestern Saudi Arabia, surrounded by the majestic Shammar Mountains. Famously associated with the legendary Arabian poet and host Hatim al-Tai, it is renowned for its generous hospitality and UNESCO-listed rock art.",
                'image' => '/cities/hail.jpeg',
                'country' => 'Saudi Arabia',
                'order' => 10,
                'lang' => 'en',
                'is_active' => 1,
                'best_time' => 'October to April',
                'activities' => json_encode(["Mountain Hiking", "UNESCO Rock Art Tours", "Desert Safaris", "Cultural Majlis Visits"]),
                'landmarks' => json_encode([
                    [
                        'name' => "A'arif Fort",
                        'description' => 'A historic mud-clay fortress sitting on a hilltop, offering panoramic views of Hail city.',
                        'image' => '/cities/hail.jpeg'
                    ],
                    [
                        'name' => 'Jubbah Rock Art',
                        'description' => 'A UNESCO World Heritage Site showing extraordinary carvings and inscriptions dating back 10,000 years.',
                        'image' => '/cities/hail.jpeg'
                    ]
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Dammam
            [
                'name' => 'الدمام',
                'slug' => 'dammam',
                'description' => 'الدمام هي عاصمة المنطقة الشرقية في المملكة العربية السعودية، وتشكل جزءاً رئيسياً من منطقة الدمام الحضرية على ساحل الخليج العربي. وهي مركز صناعي حيوي وميناء حديث بالإضافة لوجهة سياحية تشتهر بكورنيشها الممتد وشواطئها الرملية.',
                'image' => '/cities/dammam.png',
                'country' => 'Saudi Arabia',
                'order' => 11,
                'lang' => 'ar',
                'is_active' => 1,
                'best_time' => 'من نوفمبر إلى مارس',
                'activities' => json_encode(["الرحلات البحرية", "تناول المأكولات البحرية", "الجري على الواجهة المائية", "التسوق في الأسواق التقليدية"]),
                'landmarks' => json_encode([
                    [
                        'name' => 'كورنيش الدمام',
                        'description' => 'ممشى مائي مصمم بشكل جميل يضم منتزهات خضراء ومقاهي ومناطق ترفيه عائلية.',
                        'image' => '/cities/dammam.png'
                    ],
                    [
                        'name' => 'جزيرة المرجان',
                        'description' => 'جزيرة اصطناعية متصلة بجسر، تتميز ببرج مراقبة ورحلات بحرية.',
                        'image' => '/cities/dammam.png'
                    ]
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Dammam',
                'slug' => 'dammam',
                'description' => "Dammam is the capital of the Eastern Province of Saudi Arabia, forming a major part of the Dammam metropolitan area along the Arabian Gulf. It is a vital industrial powerhouse, modern seaport, and a tourist destination famous for its sprawling corniche and sandy beaches.",
                'image' => '/cities/dammam.png',
                'country' => 'Saudi Arabia',
                'order' => 11,
                'lang' => 'en',
                'is_active' => 1,
                'best_time' => 'November to March',
                'activities' => json_encode(["Coastal Cruises", "Seafood Dining", "Waterfront Jogging", "Traditional Souk Shopping"]),
                'landmarks' => json_encode([
                    [
                        'name' => 'Dammam Corniche',
                        'description' => 'A beautifully designed waterfront promenade featuring green parks, cafes, and family recreation areas.',
                        'image' => '/cities/dammam.png'
                    ],
                    [
                        'name' => 'Marjan Island',
                        'description' => 'An artificial island park linked by a bridge, featuring a viewing tower and boat trips.',
                        'image' => '/cities/dammam.png'
                    ]
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Najran
            [
                'name' => 'نجران',
                'slug' => 'najran',
                'description' => 'نجران مدينة أثرية قديمة تقع في جنوب غرب المملكة العربية السعودية بالقرب من الحدود اليمنية. تشتهر بعمارتها الطينية الفريدة وواحات النخيل الخصبة وآثار الأخدود القديمة، وتقدم نافذة مذهلة على تاريخ ما قبل الإسلام.',
                'image' => '/cities/Najran.jpeg',
                'country' => 'Saudi Arabia',
                'order' => 12,
                'lang' => 'ar',
                'is_active' => 1,
                'best_time' => 'من سبتمبر إلى أبريل',
                'activities' => json_encode(["الاستكشاف التاريخي", "جولات القصور التراثية", "المشي في الواحات", "تسوق الحرف التقليدية"]),
                'landmarks' => json_encode([
                    [
                        'name' => 'موقع الأخدود الأثري',
                        'description' => 'بقايا مدينة قديمة تعود لعصر ما قبل الإسلام وتتميز بنقوش ورسومات حجرية تاريخية.',
                        'image' => '/cities/Najran.jpeg'
                    ],
                    [
                        'name' => 'قصر العان',
                        'description' => 'قصر طيني تقليدي متعدد الطوابق رائع يعكس العمارة النجرانية الكلاسيكية الفريدة.',
                        'image' => '/cities/Najran.jpeg'
                    ]
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Najran',
                'slug' => 'najran',
                'description' => "Najran is an ancient city located in southwestern Saudi Arabia near the Yemeni border. Famous for its distinct mud-brick architecture, oasis palms, and archaeological ruins of Al-Ukhdood.",
                'image' => '/cities/Najran.jpeg',
                'country' => 'Saudi Arabia',
                'order' => 12,
                'lang' => 'en',
                'is_active' => 1,
                'best_time' => 'September to April',
                'activities' => json_encode(["Historical Exploration", "Heritage Palace Tours", "Oasis Hiking", "Traditional Craft Shopping"]),
                'landmarks' => json_encode([
                    [
                        'name' => 'Al-Ukhdood Archaeological Site',
                        'description' => 'The ancient ruins of a pre-Islamic city featuring historic stone carvings, inscriptions, and ruins.',
                        'image' => '/cities/Najran.jpeg'
                    ],
                    [
                        'name' => 'Aan Palace',
                        'description' => 'A gorgeous traditional multi-story mud-brick palace showcasing classical Najran heritage architecture.',
                        'image' => '/cities/Najran.jpeg'
                    ]
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Jizan
            [
                'name' => 'جيزان',
                'slug' => 'jizan',
                'description' => 'جيزان هي مدينة ساحلية نابضة بالحياة تقع على الساحل الجنوبي للبحر الأحمر في المملكة العربية السعودية. تشتهر بمناخها الاستوائي وإنتاجها الزراعي الوفير (مثل المانجو والبن) وتضاريسها المتنوعة، وتعتبر البوابة الرئيسية لجزر فرسان البكر.',
                'image' => '/cities/jizan.webp',
                'country' => 'Saudi Arabia',
                'order' => 13,
                'lang' => 'ar',
                'is_active' => 1,
                'best_time' => 'من نوفمبر إلى فبراير',
                'activities' => json_encode(["الغطس في الجزر", "المشي في المدرجات الجبلية", "تذوق المانجو والبن الجيزاني", "تناول الطعام على البحر"]),
                'landmarks' => json_encode([
                    [
                        'name' => 'جزر فرسان',
                        'description' => 'محمية بحرية خلابة تتميز بشواطئها الرملية البيضاء والشعاب المرجانية وقرى صيد اللؤلؤ التاريخية.',
                        'image' => '/cities/jizan.webp'
                    ],
                    [
                        'name' => 'جبال فيفاء',
                        'description' => 'تُعرف بـ \'جارة القمر\'، وهي جبال خضراء مدرجة توفر إطلالات مذهلة وغطاءً نباتياً كثيفاً.',
                        'image' => '/cities/jizan.webp'
                    ]
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Jizan',
                'slug' => 'jizan',
                'description' => "Jizan is a vibrant port city on the southern Red Sea coast of Saudi Arabia. Known for its tropical climate, rich agricultural output (including mangoes and coffee), and serving as the primary gateway to the pristine Farasan Islands.",
                'image' => '/cities/jizan.webp',
                'country' => 'Saudi Arabia',
                'order' => 13,
                'lang' => 'en',
                'is_active' => 1,
                'best_time' => 'November to February',
                'activities' => json_encode(["Island Snorkeling", "Mountain Terrace Hiking", "Mango & Coffee Tasting", "Seaside Dining"]),
                'landmarks' => json_encode([
                    [
                        'name' => 'Farasan Islands',
                        'description' => 'A protected marine sanctuary with white-sand beaches, coral reefs, and historical pearl-trading villages.',
                        'image' => '/cities/jizan.webp'
                    ],
                    [
                        'name' => 'Fayfa Mountains',
                        'description' => 'Known as the \'Neighbors of the Moon\', these terraced green mountains offer spectacular views.',
                        'image' => '/cities/jizan.webp'
                    ]
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Al-Qassim
            [
                'name' => 'القصيم',
                'slug' => 'qassim',
                'description' => 'منطقة القصيم تقع في قلب المملكة العربية السعودية، وتشتهر بأنها سلة الغذاء الزراعية للبلاد. وهي معروفة ببلدات النخيل الشاسعة والتمور اللذيذة والقرى التراثية والمهرجانات الثقافية الحيوية.',
                'image' => '/cities/qassim.jpeg',
                'country' => 'Saudi Arabia',
                'order' => 14,
                'lang' => 'ar',
                'is_active' => 1,
                'best_time' => 'من أكتوبر إلى مارس',
                'activities' => json_encode(["تذوق التمور", "جولات القرى التراثية", "المشي في المزارع", "زيارة الأسواق التقليدية"]),
                'landmarks' => json_encode([
                    [
                        'name' => 'سوق تمور بريدة',
                        'description' => 'أكبر سوق للتمور في العالم، ويستضيف مهرجان التمور الموسمي الشهير كل عام.',
                        'image' => '/cities/qassim.jpeg'
                    ],
                    [
                        'name' => 'قرية أشيقر التراثية',
                        'description' => 'قرية طينية تقليدية محفوظة بشكل جميل تقدم لمحة عن ثقافة نجد التاريخية.',
                        'image' => '/cities/qassim.jpeg'
                    ]
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Al-Qassim',
                'slug' => 'qassim',
                'description' => "Al-Qassim Province is situated in the heart of Saudi Arabia, renowned as the agricultural basket of the country. It is famous for its vast palm groves, delicious dates, traditional heritage towns, and lively cultural festivals.",
                'image' => '/cities/qassim.jpeg',
                'country' => 'Saudi Arabia',
                'order' => 14,
                'lang' => 'en',
                'is_active' => 1,
                'best_time' => 'October to March',
                'activities' => json_encode(["Date Tasting", "Heritage Village Tours", "Agricultural Walks", "Traditional Souk Visits"]),
                'landmarks' => json_encode([
                    [
                        'name' => 'Buraidah Date Market',
                        'description' => 'The largest date market in the world, hosting the famous seasonal date festival every year.',
                        'image' => '/cities/qassim.jpeg'
                    ],
                    [
                        'name' => 'Ushaiqer Heritage Village',
                        'description' => 'A beautifully preserved traditional mud-brick village offering a glimpse into historic Najdi culture.',
                        'image' => '/cities/qassim.jpeg'
                    ]
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        if (Schema::hasColumn('cities', 'lang')) {
            DB::table('cities')->insert($cities);
        } else {
            // Group by slug for Spatie translatable format
            $grouped = [];
            foreach ($cities as $c) {
                $slug = $c['slug'];
                if (!isset($grouped[$slug])) {
                    $grouped[$slug] = [
                        'slug' => $slug,
                        'names' => [],
                        'descriptions' => [],
                        'best_times' => [],
                        'activities' => [],
                        'landmarks' => [],
                        'image' => $c['image'],
                        'images' => $c['images'] ?? null,
                        'country' => $c['country'] ?? 'Saudi Arabia',
                        'order' => $c['order'] ?? 0,
                        'is_active' => $c['is_active'] ?? 1,
                        'created_at' => $c['created_at'],
                        'updated_at' => $c['updated_at'],
                    ];
                }
                $lang = $c['lang'] ?? 'ar';
                $grouped[$slug]['names'][$lang] = $c['name'];
                $grouped[$slug]['descriptions'][$lang] = $c['description'];
                $grouped[$slug]['best_times'][$lang] = $c['best_time'] ?? '';
                
                $acts = json_decode($c['activities'] ?? '[]', true);
                $grouped[$slug]['activities'][$lang] = is_array($acts) ? $acts : [];
                
                $lands = json_decode($c['landmarks'] ?? '[]', true);
                $grouped[$slug]['landmarks'][$lang] = is_array($lands) ? $lands : [];

                if (!empty($c['image'])) {
                    $grouped[$slug]['image'] = $c['image'];
                }
                if (!empty($c['images']) && $c['images'] !== '[]') {
                    $grouped[$slug]['images'] = $c['images'];
                }
            }

            foreach ($grouped as $slug => $data) {
                DB::table('cities')->insert([
                    'slug' => $slug,
                    'name' => json_encode($data['names']),
                    'description' => json_encode($data['descriptions']),
                    'best_time' => json_encode($data['best_times']),
                    'activities' => json_encode($data['activities']),
                    'landmarks' => json_encode($data['landmarks']),
                    'image' => $data['image'],
                    'images' => $data['images'],
                    'country' => $data['country'],
                    'order' => $data['order'],
                    'is_active' => $data['is_active'],
                    'created_at' => $data['created_at'],
                    'updated_at' => $data['updated_at'],
                ]);
            }
        }
        Schema::enableForeignKeyConstraints();
    }
}
