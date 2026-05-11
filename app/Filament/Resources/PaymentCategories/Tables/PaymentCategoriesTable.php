<?php

namespace App\Filament\Resources\PaymentCategories\Tables;

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
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class PaymentCategoriesTable
{
	public static function configure(Table $table): Table
	{
		return $table
			->columns([
				TextColumn::make('index')
					->rowIndex()
					->label(__('general.labels.row_index')),
				TextColumn::make('code')
					->label(__('payment_category.fields.code'))
					->badge()
					->copyable()
					->searchable()
					->sortable(),
				TextColumn::make('user.name')
					->label(__('payment_category.fields.user_id'))
					->searchable()
					->toggleable(),
				TextColumn::make('name')
					->label(__('payment_category.fields.name'))
					->sortable()
					->searchable()
					->toggleable(),
				IconColumn::make('is_default')
					->label(__('payment_category.fields.is_default'))
					->boolean()
					->sortable(),
				TextColumn::make('created_at')
					->label(__('general.labels.created_at'))
					->dateTime()
					->sortable()
					->sinceTooltip()
					->toggleable(isToggledHiddenByDefault: true),
				TextColumn::make('updated_at')
					->label(__('general.labels.updated_at'))
					->dateTime()
					->sortable()
					->sinceTooltip()
					->toggleable(),
				TextColumn::make('deleted_at')
					->label(__('general.labels.deleted_at'))
					->dateTime()
					->sortable()
					->sinceTooltip()
					->toggleable(isToggledHiddenByDefault: true),
			])
			->defaultSort('name', 'asc')
			->filters([
				TrashedFilter::make()
					->preload()
					->searchable()
					->native(false),
			])
			->recordAction(null)
			->recordUrl(null)
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
