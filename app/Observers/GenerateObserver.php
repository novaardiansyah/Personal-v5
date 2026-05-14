<?php

/*
 * Project Name: personal-v5
 * File: GenerateObserver.php
 * Created Date: May 14, 2026
 * 
 * Author: Nova Ardiansyah admin@novaardiansyah.id
 * Website: https://novaardiansyah.id
 * MIT License: https://github.com/novaardiansyah/personal-v5/blob/main/LICENSE
 * 
 * Copyright (c) 2026 Nova Ardiansyah, Org
 */

namespace App\Observers;

use App\Models\Generate;

class GenerateObserver
{
	public function created(Generate $generate): void
	{
		saveActivityLog([
			'event'       => 'Created',
			'description' => "Created generate {$generate->name}",
		], $generate);
	}

	public function updated(Generate $generate): void
	{
		saveActivityLog([
			'event'       => 'Updated',
			'description' => "Updated generate {$generate->name}",
		], $generate);
	}

	public function deleted(Generate $generate): void
	{
		saveActivityLog([
			'event'       => 'Deleted',
			'description' => "Deleted generate {$generate->name}",
		], $generate);
	}

	public function restored(Generate $generate): void
	{
		saveActivityLog([
			'event'       => 'Restored',
			'description' => "Restored generate {$generate->name}",
		], $generate);
	}

	public function forceDeleted(Generate $generate): void
	{
		saveActivityLog([
			'event'       => 'Force Deleted',
			'description' => "Force deleted generate {$generate->name}",
		], $generate);
	}
}
