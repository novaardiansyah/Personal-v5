<?php

namespace App\Filament\Resources\Settings\Tables;

use App\Filament\Resources\Settings\Actions\ChangeValueAction;
use App\Filament\Resources\Settings\Actions\ReplicateAction;
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
use Filament\Support\Enums\Width;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class SettingsTable
{
	public static function configure(Table $table): Table
	{
		return $table
			->columns([
				TextColumn::make('index')
					->rowIndex()
					->label(__('general.labels.row_index')),
				TextColumn::make('name')
					->label(__('general.resources.setting.fields.name'))
					->searchable()
					->toggleable(),
				TextColumn::make('key')
					->label(__('general.resources.setting.fields.key'))
					->badge()
					->searchable()
					->copyable()
					->toggleable(),
				TextColumn::make('value')
					->label(__('general.resources.setting.fields.value'))
					->searchable()
					->toggleable()
					->badge(),
				TextColumn::make('description')
					->label(__('general.resources.setting.fields.description'))
					->limit(50)
					->searchable()
					->toggleable(),
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
					->toggleable(isToggledHiddenByDefault: false),
			])
			->filters([
				TrashedFilter::make(),
			])
			->recordAction('change_value')
			->recordUrl(null)
			->recordActions([
				ActionGroup::make([
					ViewAction::make(),
					EditAction::make()
						->modalWidth(Width::Medium),
					ChangeValueAction::make(),
					ReplicateAction::make(),
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
