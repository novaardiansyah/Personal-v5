<?php

namespace App\Filament\Resources\ActivityLogs\Tables;

use App\Filament\Resources\ActivityLogs\Schemas\ActivityLogInfolist;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Support\Enums\Width;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ActivityLogsTable
{
	public static function configure(Table $table): Table
	{
		return $table
			->columns([
				TextColumn::make('index')
					->label(__('general.labels.row_index'))
					->rowIndex(),
				TextColumn::make('log_name')
					->label(__('activity_log.fields.log_name'))
					->badge()
					->formatStateUsing(fn(string $state): string => ucwords($state))
					->color(fn(string $state, $record): string => $record->getLognameColor($state))
					->toggleable(),
				TextColumn::make('event')
					->label(__('activity_log.fields.event'))
					->badge()
					->color(fn(string $state, $record): string => $record->getEventColor($state))
					->toggleable(),
				TextColumn::make('description')
					->label(__('activity_log.fields.description'))
					->wrap()
					->limit(80)
					->searchable()
					->toggleable(),
				TextColumn::make('subject')
					->label(__('activity_log.fields.subject'))
					->formatStateUsing(function ($state, $record) {
						if (!$record->subject_type) {
							return '-';
						}

						$modelName = class_basename($record->subject_type);
						return "{$modelName} #{$record->subject_id}";
					})
					->searchable()
					->toggleable(),
				TextColumn::make('causer.name')
					->label(__('activity_log.fields.causer'))
					->searchable()
					->hidden(),
				TextColumn::make('batch_uuid')
					->label(__('activity_log.fields.batch_uuid'))
					->searchable()
					->hidden(),
				TextColumn::make('created_at')
					->label(__('general.labels.created_at'))
					->dateTime()
					->sortable()
					->sinceTooltip()
					->toggleable(),
			])
			->defaultSort('created_at', 'desc')
			->recordUrl(null)
			->filters([
				//
			])
			->recordActions([
				ActionGroup::make([
					ViewAction::make()
						->slideOver()
						->modalWidth(Width::FiveExtraLarge),
				]),
			])
			->toolbarActions([
				BulkActionGroup::make([
					DeleteBulkAction::make(),
				]),
			]);
	}
}
