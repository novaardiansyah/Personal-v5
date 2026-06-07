<?php

/*
 * Project Name: personal-v5
 * File: ItemObserver.php
 * Created Date: June 7, 2026
 *
 * Author: Nova Ardiansyah admin@novaardiansyah.id
 * Website: https://novaardiansyah.id
 * MIT License: https://github.com/novaardiansyah/personal-v5/blob/main/LICENSE
 *
 * Copyright (c) 2026 Nova Ardiansyah, Org
 */

namespace App\Observers;

use App\Models\Item;

class ItemObserver
{
	public function saving(Item $item): void
	{
		if (!$item->code) {
			$item->code = getCode('item');
		}
	}

	public function created(Item $item): void
	{
		saveActivityLog([
			'event'       => 'Created',
			'description' => "Created item {$item->name}",
		], $item);
	}

	public function updated(Item $item): void
	{
		saveActivityLog([
			'event'       => 'Updated',
			'description' => "Updated item {$item->name}",
		], $item);
	}

	public function deleted(Item $item): void
	{
		saveActivityLog([
			'event'       => 'Deleted',
			'description' => "Deleted item {$item->name}",
		], $item);
	}

	public function restored(Item $item): void
	{
		saveActivityLog([
			'event'       => 'Restored',
			'description' => "Restored item {$item->name}",
		], $item);
	}

	public function forceDeleted(Item $item): void
	{
		saveActivityLog([
			'event'       => 'Force Deleted',
			'description' => "Force deleted item {$item->name}",
		], $item);
	}
}
