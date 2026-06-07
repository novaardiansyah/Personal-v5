<?php

namespace App\Observers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingObserver
{
	public function saving(Setting $setting): void
	{
		if (!$setting->code) {
			$setting->code = getCode('setting');
		}
	}

	public function created(Setting $setting): void
	{
		$this->clearCache($setting);
		saveActivityLog([
			'event'       => 'Created',
			'description' => "Created setting {$setting->name}",
		], $setting);
	}

	public function updated(Setting $setting): void
	{
		$this->clearCache($setting);
		saveActivityLog([
			'event'       => 'Updated',
			'description' => "Updated setting {$setting->name}",
		], $setting);
	}

	public function deleted(Setting $setting): void
	{
		$this->clearCache($setting);
		saveActivityLog([
			'event'       => 'Deleted',
			'description' => "Deleted setting {$setting->name}",
		], $setting);
	}

	public function restored(Setting $setting): void
	{
		$this->clearCache($setting);
		saveActivityLog([
			'event'       => 'Restored',
			'description' => "Restored setting {$setting->name}",
		], $setting);
	}

	public function forceDeleted(Setting $setting): void
	{
		$this->clearCache($setting);
		saveActivityLog([
			'event'       => 'Force Deleted',
			'description' => "Force deleted setting {$setting->name}",
		], $setting);
	}

	private function clearCache(Setting $setting): void
	{
		Cache::forget("setting.{$setting->key}");
	}
}
