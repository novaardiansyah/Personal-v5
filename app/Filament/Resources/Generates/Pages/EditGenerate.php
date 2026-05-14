<?php

/*
 * Project Name: personal-v5
 * File: EditGenerate.php
 * Created Date: May 14, 2026
 *
 * Author: Nova Ardiansyah admin@novaardiansyah.id
 * Website: https://novaardiansyah.id
 * MIT License: https://github.com/novaardiansyah/personal-v5/blob/main/LICENSE
 *
 * Copyright (c) 2026 Nova Ardiansyah, Org
 */

namespace App\Filament\Resources\Generates\Pages;

use App\Filament\Resources\Generates\GenerateResource;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditGenerate extends EditRecord
{
	protected static string $resource = GenerateResource::class;

	protected function getHeaderActions(): array
	{
		return [
			ViewAction::make(),
			CreateAction::make(),
			DeleteAction::make(),
			ForceDeleteAction::make(),
			RestoreAction::make(),
		];
	}

	protected function fillForm(): void
	{
		$record = $this->getRecord();
		$record->next_id = $record->getNextId();
		$this->fillFormWithDataAndCallHooks($record);
	}
}
