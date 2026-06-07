<?php

/*
 * Project Name: personal-v5
 * File: ItemTypeObserver.php
 * Created Date: June 7, 2026
 *
 * Author: Nova Ardiansyah admin@novaardiansyah.id
 * Website: https://novaardiansyah.id
 * MIT License: https://github.com/novaardiansyah/personal-v5/blob/main/LICENSE
 *
 * Copyright (c) 2026 Nova Ardiansyah, Org
 */

namespace App\Observers;

use App\Models\ItemType;

class ItemTypeObserver
{
	public function saving(ItemType $itemType): void
	{
		if (!$itemType->code) {
			$itemType->code = getCode('item_type');
		}
	}

	public function created(ItemType $itemType): void
	{
		saveActivityLog([
			'event'       => 'Created',
			'description' => "Created item type {$itemType->name}",
		], $itemType);
	}

	public function updated(ItemType $itemType): void
	{
		saveActivityLog([
			'event'       => 'Updated',
			'description' => "Updated item type {$itemType->name}",
		], $itemType);
	}

	public function deleted(ItemType $itemType): void
	{
		saveActivityLog([
			'event'       => 'Deleted',
			'description' => "Deleted item type {$itemType->name}",
		], $itemType);
	}

	public function restored(ItemType $itemType): void
	{
		saveActivityLog([
			'event'       => 'Restored',
			'description' => "Restored item type {$itemType->name}",
		], $itemType);
	}

	public function forceDeleted(ItemType $itemType): void
	{
		saveActivityLog([
			'event'       => 'Force Deleted',
			'description' => "Force deleted item type {$itemType->name}",
		], $itemType);
	}
}
