<?php

/*
 * Project Name: personal-v5
 * File: PaymentAccountsTable.php
 * Created Date: May 11, 2026
 *
 * Author: Nova Ardiansyah admin@novaardiansyah.id
 * Website: https://novaardiansyah.id
 * MIT License: https://github.com/novaardiansyah/personal-v5/blob/main/LICENSE
 *
 * Copyright (c) 2026 Nova Ardiansyah, Org
 */

namespace App\Filament\Resources\PaymentAccounts\Tables;

use App\Filament\Resources\PaymentAccounts\Actions\AuditPaymentAccount;
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
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class PaymentAccountsTable
{
	public static function configure(Table $table): Table
	{
		return $table
			->columns([
				TextColumn::make('index')
					->rowIndex()
					->label(__('general.labels.row_index')),
				TextColumn::make('code')
					->label(__('payment_account.fields.code'))
					->searchable()
					->copyable()
					->badge()
					->toggleable(),
				TextColumn::make('user.name')
					->label(__('payment_account.fields.user_name'))
					->searchable()
					->toggleable(isToggledHiddenByDefault: true),
				TextColumn::make('name')
					->label(__('payment_account.fields.name'))
					->searchable()
					->toggleable(),
				TextColumn::make('deposit')
					->label(__('payment_account.fields.deposit'))
					->numeric()
					->sortable()
					->toggleable()
					->money('IDR', locale: 'id-ID'),
				ImageColumn::make('logo_url')
					->label(__('payment_account.fields.logo_url'))
					->checkFileExistence(false)
					->circular(),
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
					AuditPaymentAccount::make(),
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
