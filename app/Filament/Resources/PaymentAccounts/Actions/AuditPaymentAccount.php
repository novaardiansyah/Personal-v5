<?php

/*
 * Project Name: personal-v5
 * File: AuditPaymentAccount.php
 * Created Date: May 12, 2026
 *
 * Author: Nova Ardiansyah admin@novaardiansyah.id
 * Website: https://novaardiansyah.id
 * MIT License: https://github.com/novaardiansyah/personal-v5/blob/main/LICENSE
 *
 * Copyright (c) 2026 Nova Ardiansyah, Org
 */

use App\Models\PaymentAccount;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Support\Enums\Width;

class AuditPaymentAccount
{
	public static function make()
	{
		return Action::make('audit')
			->label(__('payment_account.actions.audit'))
			->color('info')
			->icon('heroicon-o-scale')
			->modalHeading(__('payment_account.actions.audit_title'))
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
					->afterStateUpdated(function ($state, Set $set, PaymentAccount $record) {
						$current = (float) $record->deposit;
						$diff    = $current - (float) $state;
						$diff    = $diff > 0 ? -$diff : abs($diff);

						$set('diff_deposit', money($diff, 'IDR', locale: 'id-ID'));
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
			});
	}
}
