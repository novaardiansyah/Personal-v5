<?php

return [
	'label' => 'Akun Pembayaran',
	'plural_label' => 'Akun Pembayaran',
	'fields' => [
		'name'            => 'Nama',
		'deposit'         => 'Deposit',
		'logo'            => 'Logo',
		'logo_url'        => 'Logo',
		'current_deposit' => 'Deposit Saat Ini',
		'new_deposit'     => 'Deposit Baru',
		'difference'      => 'Selisih',
		'user_name'       => 'Nama Pengguna',
	],
	'actions' => [
		'audit'       => 'Audit',
		'audit_title' => 'Audit :name',
	],
	'notifications' => [
		'audit_success_title' => 'Audit Berhasil',
		'audit_success_body'  => 'Audit telah berhasil disimpan.',
	],
];
