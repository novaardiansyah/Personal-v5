<?php

return [
	'label' => 'Payment Account',
	'plural_label' => 'Payment Accounts',
	'fields' => [
		'name'            => 'Name',
		'deposit'         => 'Deposit',
		'logo'            => 'Logo',
		'logo_url'        => 'Logo',
		'current_deposit' => 'Current Deposit',
		'new_deposit'     => 'New Deposit',
		'difference'      => 'Difference',
		'user_name'       => 'Username',
	],
	'actions' => [
		'audit'       => 'Audit',
		'audit_title' => 'Audit Payment Account',
	],
	'notifications' => [
		'audit_success_title' => 'Audit Success',
		'audit_success_body'  => 'Audit has been successfully saved.',
	],
];
