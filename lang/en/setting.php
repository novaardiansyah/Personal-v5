<?php

return [
	'label' => 'Setting',
	'plural_label' => 'Settings',
	'fields' => [
		'code' => 'Setting ID',
		'name' => 'Name',
		'key' => 'Alias',
		'value' => 'Value',
		'value_option' => 'Choose Value',
		'options' => 'Value Options',
		'has_options' => 'Has Options',
		'description' => 'Description',
	],
	'actions' => [
		'change_value' => 'Change Value',
		'change_value_heading' => 'Change setting value',
		'replicate' => 'Replicate',
		'replicate_heading' => 'Replicate Setting',
		'replicate_description' => 'Are you sure you want to replicate this setting?',
	],
	'notifications' => [
		'changed_title' => 'Successfully Changed',
		'changed_body' => 'Setting value has been successfully changed.',
		'replicated_title' => 'Setting replicated successfully',
	],
];
