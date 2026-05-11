<?php

return [
	'label' => 'Activity Log',
	'plural_label' => 'Activity Logs',
	'fields' => [
		'log_name'        => 'Group',
		'description'     => 'Description',
		'event'           => 'Event',
		'subject'         => 'Subject',
		'causer'          => 'Causer',
		'batch_uuid'      => 'Batch UUID',
		'prev_properties' => 'Previous Properties',
		'properties'      => 'Properties',
		'ip_address'      => 'IP Address',
		'country'         => 'Country',
		'city'            => 'City',
		'region'          => 'Region',
		'postal'          => 'Postal Code',
		'geolocation'     => 'Geolocation',
		'timezone'        => 'Timezone',
		'user_agent'      => 'User Agent',
		'referer'         => 'Referer',
	],
	'sections' => [
		'general_information'    => 'General Information',
		'location_client'        => 'Location & Client Information',
		'properties_information' => 'Properties Information',
	],
];
