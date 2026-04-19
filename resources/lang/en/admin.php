<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Admin Panel Translations - English
    |--------------------------------------------------------------------------
    */

    // Panel
    'panel_name' => 'Admin Panel',
    'dashboard' => 'Dashboard',
    'logout' => 'Logout',
    'profile' => 'Profile',
    'switch_language' => 'Switch Language',
    'language' => 'Language',
    'english' => 'English',
    'arabic' => 'العربية',

    // Navigation Groups
    'nav' => [
        'administration' => 'Administration',
        'users' => 'Users',
        'content' => 'Content',
        'local_destinations' => 'Local Destinations',
        'international_destinations' => 'International Destinations',
        'reservations_bookings' => 'Reservations & Bookings',
        'payments' => 'Payments',
        'communication' => 'Communication',
        'settings' => 'Settings',
        'website' => 'Website',
    ],

    // Resources
    'resources' => [
        // Booking
        'booking' => 'Booking',
        'bookings' => 'Bookings',
        'booking_number' => 'Booking #',
        
        // Reservation
        'reservation' => 'Reservation',
        'reservations' => 'Reservations',
        
        // User
        'user' => 'User',
        'users' => 'Users',
        
        // Trip
        'trip' => 'Trip',
        'trips' => 'Trips',
        
        // Offer
        'offer' => 'Offer',
        'offers' => 'Offers',
        
        // Service
        'service' => 'Service',
        'services' => 'Services',
        
        // Payment
        'payment' => 'Payment',
        'payments' => 'Payments',
        
        // City
        'city' => 'City',
        'cities' => 'Cities',
        
        // Contact
        'contact' => 'Contact',
        'contacts' => 'Contacts',
        
        // Product
        'product' => 'Product',
        'products' => 'Products',
        
        // Project
        'project' => 'Project',
        'projects' => 'Projects',
        
        // Role
        'role' => 'Role',
        'roles' => 'Roles',
        
        // Permission
        'permission' => 'Permission',
        'permissions' => 'Permissions',
        
        // Island Destination
        'island_destination' => 'Island Destination',
        'island_destinations' => 'Island Destinations',
        
        // International Destination
        'international_destination' => 'International Destination',
        'international_destinations' => 'International Destinations',
        
        // International Package
        'international_package' => 'International Package',
        'international_packages' => 'International Packages',
        
        // International Hotel
        'international_hotel' => 'International Hotel',
        'international_hotels' => 'International Hotels',
        
        // International Flight
        'international_flight' => 'International Flight',
        'international_flights' => 'International Flights',
        
        // International Island
        'international_island' => 'International Island',
        'international_islands' => 'International Islands',
        
        // Custom Payment Offer
        'custom_payment_offer' => 'Custom Payment Offer',
        'custom_payment_offers' => 'Custom Payment Offers',
        
        // App Setting
        'app_setting' => 'App Setting',
        'app_settings' => 'App Settings',
        'setting' => 'Setting',
        'settings' => 'Settings',
        
        // Destination (generic)
        'destination' => 'Destination',
        'destinations' => 'Destinations',
    ],

    // Form Labels
    'form' => [
        // Common
        'id' => 'ID',
        'name' => 'Name',
        'full_name' => 'Full Name',
        'email' => 'Email',
        'email_address' => 'Email Address',
        'phone' => 'Phone',
        'phone_number' => 'Phone Number',
        'password' => 'Password',
        'password_confirmation' => 'Confirm Password',
        'title' => 'Title',
        'title_en' => 'Title (English)',
        'title_ar' => 'Title (Arabic)',
        'description' => 'Description',
        'description_en' => 'Description (English)',
        'description_ar' => 'Description (Arabic)',
        'slug' => 'Slug',
        'image' => 'Image',
        'images' => 'Images',
        'video' => 'Video',
        'status' => 'Status',
        'type' => 'Type',
        'price' => 'Price',
        'amount' => 'Amount',
        'discount' => 'Discount',
        'duration' => 'Duration',
        'date' => 'Date',
        'start_date' => 'Start Date',
        'end_date' => 'End Date',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At',
        'group' => 'Group',
        'is_active' => 'Active',
        'is_featured' => 'Featured',
        'language' => 'Language',
        'notes' => 'Notes',
        'message' => 'Message',
        'address' => 'Address',
        'location' => 'Location',
        'location_en' => 'Location (English)',
        'location_ar' => 'Location (Arabic)',
        'country' => 'Country',
        'city' => 'City',
        'destination' => 'Destination',
        
        // Permission and Role specific
        'permission_key' => 'Permission Key',
        'role_key' => 'Role Key',
        'display_name' => 'Display Name',
        'role_description' => 'Role Description',
        
        // User specific
        'user_id' => 'User ID',
        'admin_access' => 'Admin Access',
        'admin_access_helper' => 'Grant this user access to the admin panel',
        'leave_blank_password' => 'Leave blank to keep current password',
        
        // Booking specific
        'customer_information' => 'Customer Information',
        'customer_name' => 'Customer Name',
        'customer_email' => 'Customer Email',
        'customer_phone' => 'Customer Phone',
        'booking_details' => 'Booking Details',
        'booking_date' => 'Booking Date',
        'number_of_guests' => 'Number of Guests',
        'guests' => 'Guests',
        'service_trip_id' => 'Service/Trip ID',
        'trip_title' => 'Trip Title',
        'additional_details' => 'Additional Details',
        'all_details' => 'All Details',
        'payment_status' => 'Payment Status',
        'guest_bookings_helper' => 'Leave empty for guest bookings',
        
        // Trip specific
        'trip_information' => 'Trip Information',
        'trip_type' => 'Trip Type',
        'trip_slug' => 'Trip Slug',
        'preferred_date' => 'Preferred Date',
        'highlights' => 'Highlights',
        'highlights_en' => 'Highlights (English)',
        'highlights_ar' => 'Highlights (Arabic)',
        'features' => 'Features',
        'features_en' => 'Features (English)',
        'features_ar' => 'Features (Arabic)',
        'group_size' => 'Group Size',
        'group_size_en' => 'Group Size (English)',
        'group_size_ar' => 'Group Size (Arabic)',
        'destination_choose' => 'Destination (choose existing)',
        'destination_custom' => 'Destination (custom)',
        'destination_custom_helper' => 'If set, this text will be used as the destination name instead of the linked city',
        
        // Hotel specific
        'hotel_booking_details' => 'Hotel Booking Details',
        'room_count' => 'Number of Rooms',
        'rooms_near_each_other' => 'Rooms Near Each Other',
        'rooms_near_helper' => 'Guest requested adjacent/nearby rooms',
        'adjacent_rooms_count' => 'Adjacent Rooms Count',
        'room_type' => 'Room Type',
        
        // Offer specific
        'copy_en_to_ar' => 'Copy English to Arabic',
        'copy_helper' => 'Click to copy all English content to Arabic fields',
        'pricing' => 'Pricing',
        'media_status' => 'Media & Status',
        'badge' => 'Badge',
        'badge_en' => 'Badge (English)',
        'badge_ar' => 'Badge (Arabic)',
        
        // Payment specific
        'booking_id' => 'Booking ID',
        'method' => 'Method',
        'transaction_id' => 'Transaction ID',
        'meta' => 'Meta Data',
        
        // Role specific
        'role_assignment' => 'Role Assignment',
        'role_assignment_desc' => 'Assign one or more roles to this user. Roles determine what the user can access.',
        'select_roles' => 'Select the roles for this user',
        'display_name' => 'Display Name',
        'permissions' => 'Permissions',
        
        // Content tabs
        'english_tab' => 'English',
        'arabic_tab' => 'العربية',
        'language_tools' => 'Language Tools',
    ],

    // Table Columns
    'table' => [
        'id' => 'ID',
        'name' => 'Name',
        'email' => 'Email',
        'phone' => 'Phone',
        'title' => 'Title',
        'status' => 'Status',
        'amount' => 'Amount',
        'price' => 'Price',
        'date' => 'Date',
        'customer' => 'Customer',
        'trip' => 'Trip',
        'guests' => 'Guests',
        'payment' => 'Payment',
        'destination' => 'Destination',
        'active' => 'Active',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At',
        'actions' => 'Actions',
        'booking_number' => 'Booking #',
        'method' => 'Method',
        'transaction_id' => 'Transaction ID',
        'roles' => 'Roles',
    ],

    // Status Labels
    'status' => [
        'pending' => 'Pending',
        'confirmed' => 'Confirmed',
        'cancelled' => 'Cancelled',
        'completed' => 'Completed',
        'processing' => 'Processing',
        'failed' => 'Failed',
        'paid' => 'Paid',
        'unpaid' => 'Unpaid',
        'active' => 'Active',
        'inactive' => 'Inactive',
        'approved' => 'Approved',
        'rejected' => 'Rejected',
        'draft' => 'Draft',
        'published' => 'Published',
    ],

    // Trip Types
    'trip_types' => [
        'activity' => 'Activity',
        'hotel' => 'Hotel',
        'flight' => 'Flight',
        'package' => 'Package',
        'school' => 'School Trip',
        'corporate' => 'Corporate Trip',
        'family' => 'Family Trip',
        'private' => 'Private Group Trip',
    ],

    // Actions
    'actions' => [
        'create' => 'Create',
        'edit' => 'Edit',
        'view' => 'View',
        'delete' => 'Delete',
        'save' => 'Save',
        'save_changes' => 'Save Changes',
        'cancel' => 'Cancel',
        'confirm' => 'Confirm',
        'search' => 'Search',
        'filter' => 'Filter',
        'reset' => 'Reset',
        'export' => 'Export',
        'import' => 'Import',
        'download' => 'Download',
        'upload' => 'Upload',
        'refresh' => 'Refresh',
        'back' => 'Back',
        'next' => 'Next',
        'previous' => 'Previous',
        'submit' => 'Submit',
        'approve' => 'Approve',
        'reject' => 'Reject',
        'send' => 'Send',
        'resend' => 'Resend',
        'copy' => 'Copy',
        'copy_link' => 'Copy Link',
        'duplicate' => 'Duplicate',
        'restore' => 'Restore',
        'force_delete' => 'Force Delete',
        'bulk_delete' => 'Delete Selected',
        'select_all' => 'Select All',
        'deselect_all' => 'Deselect All',
        'mark_as_read' => 'Mark as Read',
        'mark_as_unread' => 'Mark as Unread',
        'archive' => 'Archive',
        'unarchive' => 'Unarchive',
        'toggle_active' => 'Toggle Active',
    ],

    // Messages
    'messages' => [
        'created_successfully' => ':resource created successfully.',
        'updated_successfully' => ':resource updated successfully.',
        'deleted_successfully' => ':resource deleted successfully.',
        'saved_successfully' => 'Changes saved successfully.',
        'error_occurred' => 'An error occurred. Please try again.',
        'confirm_delete' => 'Are you sure you want to delete this :resource?',
        'confirm_bulk_delete' => 'Are you sure you want to delete the selected :resource?',
        'no_records_found' => 'No records found.',
        'loading' => 'Loading...',
        'processing' => 'Processing...',
        'please_wait' => 'Please wait...',
        'success' => 'Success',
        'error' => 'Error',
        'warning' => 'Warning',
        'info' => 'Information',
        'are_you_sure' => 'Are you sure?',
        'this_action_cannot_be_undone' => 'This action cannot be undone.',
        'unauthorized' => 'You are not authorized to perform this action.',
        'not_found' => 'The requested :resource was not found.',
        'validation_error' => 'Please check the form for errors.',
    ],

    // Widgets / Stats
    'stats' => [
        'total_users' => 'Total Users',
        'registered_users' => 'Registered users',
        'trips' => 'Trips',
        'active_trips' => 'Active trips available',
        'offers' => 'Offers',
        'special_offers' => 'Special offers',
        'island_destinations' => 'Island Destinations',
        'local_island_destinations' => 'Local island destinations',
        'international_destinations' => 'International Destinations',
        'international_travel_packages' => 'International travel packages',
        'reservations' => 'Reservations',
        'total_bookings' => 'Total bookings',
        'total_revenue' => 'Total Revenue',
        'pending_reservations' => 'Pending Reservations',
        'confirmed_reservations' => 'Confirmed Reservations',
        'cancelled_reservations' => 'Cancelled Reservations',
    ],

    // Validation
    'validation' => [
        'required' => 'This field is required.',
        'email' => 'Please enter a valid email address.',
        'min' => 'Must be at least :min characters.',
        'max' => 'Cannot exceed :max characters.',
        'unique' => 'This value has already been taken.',
        'confirmed' => 'The confirmation does not match.',
        'numeric' => 'Must be a number.',
        'integer' => 'Must be a whole number.',
        'date' => 'Please enter a valid date.',
        'image' => 'Must be an image file.',
        'mimes' => 'Invalid file type.',
        'max_size' => 'File size cannot exceed :max KB.',
    ],

    // Placeholders
    'placeholders' => [
        'search' => 'Search...',
        'select_option' => 'Select an option',
        'enter_name' => 'Enter name',
        'enter_email' => 'Enter email address',
        'enter_phone' => 'Enter phone number',
        'enter_password' => 'Enter password',
        'add_feature' => 'Add a feature and press Enter',
        'add_highlight' => 'Add a highlight and press Enter',
        'select_city' => 'Select a city',
        'select_status' => 'Select status',
        'select_date' => 'Select date',
    ],

    // Currency
    'currency' => [
        'sar' => 'SAR',
        'usd' => 'USD',
        'eur' => 'EUR',
    ],

    // Time
    'time' => [
        'days' => 'days',
        'hours' => 'hours',
        'minutes' => 'minutes',
        'seconds' => 'seconds',
        'today' => 'Today',
        'yesterday' => 'Yesterday',
        'last_week' => 'Last Week',
        'last_month' => 'Last Month',
        'this_year' => 'This Year',
    ],

    // Misc
    'misc' => [
        'yes' => 'Yes',
        'no' => 'No',
        'all' => 'All',
        'none' => 'None',
        'other' => 'Other',
        'n_a' => 'N/A',
        'unknown' => 'Unknown',
        'total' => 'Total',
        'subtotal' => 'Subtotal',
        'tax' => 'Tax',
        'per_page' => 'Per Page',
        'showing' => 'Showing',
        'of' => 'of',
        'results' => 'results',
        'no_results' => 'No results',
        'empty' => 'Empty',
    ],

    // Notifications
    'notifications' => [
        'payment_link_copied' => 'Payment Link Copied',
        'payment_created' => 'Payment offer created successfully',
        'payment_updated' => 'Payment offer updated',
        'payment_deleted' => 'Payment offer deleted',
        'payment_confirmed' => 'Payment confirmed',
        'payment_failed' => 'Payment failed',
    ],
];
