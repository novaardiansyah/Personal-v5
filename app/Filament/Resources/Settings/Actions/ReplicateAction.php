<?php

namespace App\Filament\Resources\Settings\Actions;

use App\Models\Setting;
use Filament\Actions\Action;

class ReplicateAction
{
	public static function make(): Action
	{
		return Action::make('replicate')
			->label(__('setting.actions.replicate'))
			->icon('heroicon-s-document-duplicate')
			->color('warning')
			->action(function (Setting $record, Action $action) {
				$newRecord = $record->replicate();
				$newRecord->key .= '_copy';
				$newRecord->name .= ' (Copy)';

				$newRecord->save();

				$action->success();
				$action->successNotificationTitle(__('setting.notifications.replicated_title'));
			})
			->requiresConfirmation()
			->modalHeading(__('setting.actions.replicate_heading'))
			->modalDescription(__('setting.actions.replicate_description'));
	}
}
