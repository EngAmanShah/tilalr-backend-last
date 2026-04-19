<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Filament Translations - Arabic
    |--------------------------------------------------------------------------
    */

    'pages' => [
        'dashboard' => [
            'title' => 'لوحة التحكم',
        ],
    ],

    'resources' => [
        'label' => 'مورد',
        'plural_label' => 'موارد',
    ],

    'actions' => [
        'create' => [
            'label' => 'إنشاء :label',
            'modal' => [
                'heading' => 'إنشاء :label',
                'actions' => [
                    'create' => [
                        'label' => 'إنشاء',
                    ],
                    'create_another' => [
                        'label' => 'إنشاء وإنشاء آخر',
                    ],
                ],
            ],
            'notifications' => [
                'created' => [
                    'title' => 'تم الإنشاء',
                ],
            ],
        ],
        'edit' => [
            'label' => 'تعديل',
            'modal' => [
                'heading' => 'تعديل :label',
                'actions' => [
                    'save' => [
                        'label' => 'حفظ التغييرات',
                    ],
                ],
            ],
            'notifications' => [
                'saved' => [
                    'title' => 'تم الحفظ',
                ],
            ],
        ],
        'view' => [
            'label' => 'عرض',
        ],
        'delete' => [
            'label' => 'حذف',
            'modal' => [
                'heading' => 'حذف :label',
                'actions' => [
                    'delete' => [
                        'label' => 'حذف',
                    ],
                ],
            ],
            'notifications' => [
                'deleted' => [
                    'title' => 'تم الحذف',
                ],
            ],
        ],
        'replicate' => [
            'label' => 'تكرار',
            'modal' => [
                'heading' => 'تكرار :label',
                'actions' => [
                    'replicate' => [
                        'label' => 'تكرار',
                    ],
                ],
            ],
            'notifications' => [
                'replicated' => [
                    'title' => 'تم التكرار',
                ],
            ],
        ],
        'restore' => [
            'label' => 'استعادة',
            'modal' => [
                'heading' => 'استعادة :label',
                'actions' => [
                    'restore' => [
                        'label' => 'استعادة',
                    ],
                ],
            ],
            'notifications' => [
                'restored' => [
                    'title' => 'تم الاستعادة',
                ],
            ],
        ],
        'force_delete' => [
            'label' => 'حذف نهائي',
            'modal' => [
                'heading' => 'حذف نهائي :label',
                'actions' => [
                    'force_delete' => [
                        'label' => 'حذف نهائي',
                    ],
                ],
            ],
            'notifications' => [
                'force_deleted' => [
                    'title' => 'تم الحذف نهائياً',
                ],
            ],
        ],
    ],

    'bulk_actions' => [
        'delete' => [
            'label' => 'حذف المحدد',
            'modal' => [
                'heading' => 'حذف :label المحدد',
                'actions' => [
                    'delete' => [
                        'label' => 'حذف',
                    ],
                ],
            ],
            'notifications' => [
                'deleted' => [
                    'title' => 'تم الحذف',
                ],
            ],
        ],
        'force_delete' => [
            'label' => 'حذف نهائي للمحدد',
            'modal' => [
                'heading' => 'حذف نهائي :label المحدد',
                'actions' => [
                    'force_delete' => [
                        'label' => 'حذف نهائي',
                    ],
                ],
            ],
            'notifications' => [
                'force_deleted' => [
                    'title' => 'تم الحذف نهائياً',
                ],
            ],
        ],
        'restore' => [
            'label' => 'استعادة المحدد',
            'modal' => [
                'heading' => 'استعادة :label المحدد',
                'actions' => [
                    'restore' => [
                        'label' => 'استعادة',
                    ],
                ],
            ],
            'notifications' => [
                'restored' => [
                    'title' => 'تم الاستعادة',
                ],
            ],
        ],
    ],

    'search' => [
        'placeholder' => 'بحث',
        'no_results' => 'لم يتم العثور على نتائج.',
    ],

    'filters' => [
        'button' => [
            'label' => 'تصفية',
        ],
        'indicator' => 'فلاتر نشطة',
        'remove_all' => [
            'label' => 'إزالة جميع الفلاتر',
            'tooltip' => 'إزالة جميع الفلاتر',
        ],
        'select_all' => [
            'label' => 'تحديد الكل',
        ],
    ],

    'pagination' => [
        'label' => 'التنقل بين الصفحات',
        'overview' => 'عرض :first إلى :last من :total نتيجة',
        'previous' => 'السابق',
        'next' => 'التالي',
        'per_page' => 'لكل صفحة',
    ],

    'empty_state' => [
        'heading' => 'لا يوجد :label',
        'description' => 'قم بإنشاء :label للبدء.',
    ],

    'selection_indicator' => [
        'selected_count' => 'سجل واحد محدد|:count سجلات محددة',
        'buttons' => [
            'select_all' => [
                'label' => 'تحديد الكل :count',
            ],
            'deselect_all' => [
                'label' => 'إلغاء تحديد الكل',
            ],
        ],
    ],
];
