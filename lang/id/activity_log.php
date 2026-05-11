<?php

return [
    'label' => 'Log Aktivitas',
    'plural_label' => 'Log Aktivitas',
    'fields' => [
        'log_name' => 'Grup',
        'description' => 'Deskripsi',
        'event' => 'Peristiwa',
        'subject' => 'Subjek',
        'causer' => 'Pelaku',
        'batch_uuid' => 'Batch UUID',
        'prev_properties' => 'Properti Sebelumnya',
        'properties' => 'Properti',
        'ip_address' => 'Alamat IP',
        'country' => 'Negara',
        'city' => 'Kota',
        'region' => 'Wilayah',
        'postal' => 'Kode Pos',
        'geolocation' => 'Geolokasi',
        'timezone' => 'Zona Waktu',
        'user_agent' => 'User Agent',
        'referer' => 'Referer',
    ],
    'sections' => [
        'general_information' => 'Informasi Umum',
        'location_client' => 'Lokasi & Klien',
        'properties_information' => 'Informasi Properti',
    ],
];
