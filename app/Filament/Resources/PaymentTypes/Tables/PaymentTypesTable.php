<?php

namespace App\Filament\Resources\PaymentTypes\Tables;

use App\Models\PaymentType;
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

class PaymentTypesTable
{
	public static function configure(Table $table): Table
	{
		return $table
			->columns([
				TextColumn::make('index')
					->rowIndex()
					->label(__('general.labels.row_index')),
				TextColumn::make('code')
					->label(__('payment_type.fields.code'))
					->searchable()
					->copyable()
					->badge()
					->toggleable(),
				TextColumn::make('name')
					->label(__('payment_type.fields.name'))
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
					->toggleable(),
			])
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
					ViewAction::make()
						->modalHeading('View details')
						->slideOver()
						->modalWidth(Width::ThreeExtraLarge),
					EditAction::make()
						->modalWidth(Width::Medium),
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
