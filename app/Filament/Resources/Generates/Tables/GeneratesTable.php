<?php

/*
 * Project Name: personal-v5
 * File: GeneratesTable.php
 * Created Date: May 14, 2026
 *
 * Author: Nova Ardiansyah admin@novaardiansyah.id
 * Website: https://novaardiansyah.id
 * MIT License: https://github.com/novaardiansyah/personal-v5/blob/main/LICENSE
 *
 * Copyright (c) 2026 Nova Ardiansyah, Org
 */

namespace App\Filament\Resources\Generates\Tables;

use App\Models\Generate;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class GeneratesTable
{
	public static function configure(Table $table): Table
	{
		return $table
			->columns([
				TextColumn::make('index')
					->rowIndex()
					->label(__('general.labels.row_index')),
				TextColumn::make('name')
					->label(__('generate.fields.name'))
					->searchable()
					->toggleable(),
				TextColumn::make('alias')
					->label(__('generate.fields.alias'))
					->searchable()
					->toggleable()
					->copyable()
					->badge()
					->color('info'),
				TextColumn::make('prefix')
					->label(__('generate.fields.prefix'))
					->searchable()
					->toggleable()
					->badge()
					->color('info'),
				TextColumn::make('separator')
					->label(__('generate.fields.separator'))
					->searchable()
					->toggleable()
					->badge()
					->color('info'),
				TextColumn::make('queue')
					->label(__('generate.fields.queue'))
					->numeric()
					->sortable()
					->toggleable()
					->badge()
					->color('info'),
				TextColumn::make('preview')
					->label(__('generate.fields.preview'))
					->copyable()
					->badge()
					->color('info')
					->toggleable()
					->state(fn(Generate $record) => $record->getNextId()),
				TextColumn::make('deleted_at')
					->label(__('general.labels.deleted_at'))
					->dateTime()
					->sortable()
					->toggleable(isToggledHiddenByDefault: true),
				TextColumn::make('created_at')
					->label(__('general.labels.created_at'))
					->dateTime()
					->sortable()
					->toggleable(isToggledHiddenByDefault: true),
				TextColumn::make('updated_at')
					->label(__('general.labels.updated_at'))
					->dateTime()
					->sortable()
					->sinceTooltip()
					->toggleable(),
			])
			->defaultSort('updated_at', 'desc')
			->filters([
				TrashedFilter::make()
					->native(false)
					->preload()
					->searchable(),
			])
			->recordActions([
				ActionGroup::make([
					ViewAction::make(),
					EditAction::make(),
					DeleteAction::make(),
					ForceDeleteAction::make(),
					RestoreAction::make(),
				]),
			])
			->toolbarActions([
				BulkActionGroup::make([
					DeleteBulkAction::make(),
					ForceDeleteBulkAction::make(),
					RestoreBulkAction::make(),
				]),
			]);
	}
}
