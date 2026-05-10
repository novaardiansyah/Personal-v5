<?php

return [
	'navigation_groups' => [
		'settings' => 'Pengaturan',
		'logs' => 'Log',
		'operations' => 'Operasional',
	],
	'resources' => [
		'setting' => [
			'label' => 'Pengaturan',
			'plural_label' => 'Pengaturan',
			'fields' => [
				'name' => 'Nama',
				'key' => 'Alias',
				'value' => 'Nilai',
				'value_option' => 'Pilih Nilai',
				'options' => 'Opsi Nilai',
				'has_options' => 'Memiliki Opsi',
				'description' => 'Deskripsi',
			],
			'actions' => [
				'change_value' => 'Ubah Nilai',
				'change_value_heading' => 'Ubah nilai pengaturan',
				'replicate' => 'Duplikat',
				'replicate_heading' => 'Duplikat Pengaturan',
				'replicate_description' => 'Apakah Anda yakin ingin menduplikat pengaturan ini?',
			],
			'notifications' => [
				'changed_title' => 'Berhasil Diubah',
				'changed_body' => 'Nilai pengaturan telah berhasil diubah.',
				'replicated_title' => 'Pengaturan berhasil diduplikat',
			],
		],
	],
	'actions' => [
		'create' => 'Buat',
		'edit' => 'Ubah',
		'delete' => 'Hapus',
		'save' => 'Simpan',
		'cancel' => 'Batal',
		'view' => 'Lihat',
	],
	'labels' => [
		'row_index' => '#',
		'deleted_at' => 'Dihapus Pada',
		'created_at' => 'Dibuat Pada',
		'updated_at' => 'Diperbarui Pada',
		'timestamps_description' => 'Informasi Waktu',
	],
];
