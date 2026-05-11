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

use App\Models\PaymentAccount;
use Filament\Actions\Action;
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
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Support\Enums\Width;
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
					Action::make('audit')
						->label(__('payment_account.actions.audit'))
						->color('info')
						->icon('heroicon-o-scale')
						->modalHeading(fn(PaymentAccount $record) => __('payment_account.actions.audit_title', ['name' => $record->name]))
						->modalWidth(Width::Medium)
						->form([
							TextInput::make('current_deposit')
								->label(__('payment_account.fields.current_deposit'))
								->readOnly(),
							TextInput::make('deposit')
								->label(__('payment_account.fields.new_deposit'))
								->required()
								->integer()
								->numeric()
								->minValue(0)
								->autofocus()
								->live(onBlur: true)
								->afterStateUpdated(function ($state, Get $get, Set $set) {
									$current = (float) str_replace(['Rp', '.', ' '], '', $get('current_deposit'));
									$diff = $current - (float) $state;
									$diff = $diff > 0 ? -$diff : abs($diff);
									$set('diff_deposit', (int) $diff);
								}),
							TextInput::make('diff_deposit')
								->label(__('payment_account.fields.difference'))
								->readOnly(),
						])
						->fillForm(fn(PaymentAccount $record): array => [
							'current_deposit' => $record->deposit ?? 0,
							'deposit'         => $record->deposit ?? 0,
							'diff_deposit'    => 0,
						])
						->action(function (Action $action, PaymentAccount $record, array $data) {
							$record->audit((float) $data['deposit']);
							$action->success();
							Notification::make()
								->success()
								->title(__('payment_account.notifications.audit_success_title'))
								->body(__('payment_account.notifications.audit_success_body'))
								->send();
						}),
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
