<?php

return [
    'temporary_file_upload' => [
        // Remove the default 12MB Livewire temporary upload limit.
        'rules' => ['required', 'file'],
    ],
];
