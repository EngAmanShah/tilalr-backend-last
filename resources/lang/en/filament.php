<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Filament Translations - English
    |--------------------------------------------------------------------------
    */

    'pages' => [
        'dashboard' => [
            'title' => 'Dashboard',
        ],
    ],

    'resources' => [
        'label' => 'Resource',
        'plural_label' => 'Resources',
    ],

    'actions' => [
        'create' => [
            'label' => 'Create :label',
            'modal' => [
                'heading' => 'Create :label',
                'actions' => [
                    'create' => [
                        'label' => 'Create',
                    ],
                    'create_another' => [
                        'label' => 'Create & create another',
                    ],
                ],
            ],
            'notifications' => [
                'created' => [
                    'title' => 'Created',
                ],
            ],
        ],
        'edit' => [
            'label' => 'Edit',
            'modal' => [
                'heading' => 'Edit :label',
                'actions' => [
                    'save' => [
                        'label' => 'Save changes',
                    ],
                ],
            ],
            'notifications' => [
                'saved' => [
                    'title' => 'Saved',
                ],
            ],
        ],
        'view' => [
            'label' => 'View',
        ],
        'delete' => [
            'label' => 'Delete',
            'modal' => [
                'heading' => 'Delete :label',
                'actions' => [
                    'delete' => [
                        'label' => 'Delete',
                    ],
                ],
            ],
            'notifications' => [
                'deleted' => [
                    'title' => 'Deleted',
                ],
            ],
        ],
        'replicate' => [
            'label' => 'Replicate',
            'modal' => [
                'heading' => 'Replicate :label',
                'actions' => [
                    'replicate' => [
                        'label' => 'Replicate',
                    ],
                ],
            ],
            'notifications' => [
                'replicated' => [
                    'title' => 'Replicated',
                ],
            ],
        ],
        'restore' => [
            'label' => 'Restore',
            'modal' => [
                'heading' => 'Restore :label',
                'actions' => [
                    'restore' => [
                        'label' => 'Restore',
                    ],
                ],
            ],
            'notifications' => [
                'restored' => [
                    'title' => 'Restored',
                ],
            ],
        ],
        'force_delete' => [
            'label' => 'Force delete',
            'modal' => [
                'heading' => 'Force delete :label',
                'actions' => [
                    'force_delete' => [
                        'label' => 'Force delete',
                    ],
                ],
            ],
            'notifications' => [
                'force_deleted' => [
                    'title' => 'Force deleted',
                ],
            ],
        ],
    ],

    'bulk_actions' => [
        'delete' => [
            'label' => 'Delete selected',
            'modal' => [
                'heading' => 'Delete selected :label',
                'actions' => [
                    'delete' => [
                        'label' => 'Delete',
                    ],
                ],
            ],
            'notifications' => [
                'deleted' => [
                    'title' => 'Deleted',
                ],
            ],
        ],
        'force_delete' => [
            'label' => 'Force delete selected',
            'modal' => [
                'heading' => 'Force delete selected :label',
                'actions' => [
                    'force_delete' => [
                        'label' => 'Force delete',
                    ],
                ],
            ],
            'notifications' => [
                'force_deleted' => [
                    'title' => 'Force deleted',
                ],
            ],
        ],
        'restore' => [
            'label' => 'Restore selected',
            'modal' => [
                'heading' => 'Restore selected :label',
                'actions' => [
                    'restore' => [
                        'label' => 'Restore',
                    ],
                ],
            ],
            'notifications' => [
                'restored' => [
                    'title' => 'Restored',
                ],
            ],
        ],
    ],

    'search' => [
        'placeholder' => 'Search',
        'no_results' => 'No results found.',
    ],

    'filters' => [
        'button' => [
            'label' => 'Filter',
        ],
        'indicator' => 'Active filters',
        'remove_all' => [
            'label' => 'Remove all filters',
            'tooltip' => 'Remove all filters',
        ],
        'select_all' => [
            'label' => 'Select all',
        ],
    ],

    'pagination' => [
        'label' => 'Pagination Navigation',
        'overview' => 'Showing :first to :last of :total results',
        'previous' => 'Previous',
        'next' => 'Next',
        'per_page' => 'Per page',
    ],

    'empty_state' => [
        'heading' => 'No :label',
        'description' => 'Create a :label to get started.',
    ],

    'selection_indicator' => [
        'selected_count' => '1 record selected|:count records selected',
        'buttons' => [
            'select_all' => [
                'label' => 'Select all :count',
            ],
            'deselect_all' => [
                'label' => 'Deselect all',
            ],
        ],
    ],
];
