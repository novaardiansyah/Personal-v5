<?php

namespace App\Filament\Resources\Settings\Actions;

use App\Models\Setting;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Width;

class ChangeValueAction
{
	public static function make(): Action
	{
		return Action::make('change_value')
			->label(__('setting.actions.change_value'))
			->icon('heroicon-o-arrows-right-left')
			->modalWidth(Width::ExtraLarge)
			->modalHeading(__('setting.actions.change_value_heading'))
			->color('primary')
			->form(fn (Schema $form) => self::schema($form))
			->fillForm(fn (Setting $record): array => self::fillForm($record))
			->action(fn (Action $action, Setting $record, array $data) => self::handleAction($action, $record, $data));
	}

	private static function schema(Schema $schema): Schema
	{
		return $schema
			->components([
				TextInput::make('name')
					->label(__('setting.fields.name'))
					->disabled(),

				TextInput::make('options')
					->hidden(),

				Toggle::make('has_options')
					->live()
					->hidden(),

				Textarea::make('value')
					->label(__('setting.fields.value'))
					->required()
					->rows(3)
					->maxLength(255)
					->visible(fn (Get $get) => ! $get('has_options')),

				Select::make('value_option')
					->label(__('setting.fields.value_option'))
					->required()
					->native(false)
					->searchable()
					->options(function (Get $get) {
						$options = $get('options') ?? [];

						return collect($options)->mapWithKeys(function ($option) {
							return [$option => $option];
						});
					})
					->visible(fn (Get $get) => $get('has_options')),
			])
			->columns(1);
	}

	private static function fillForm(Setting $record): array
	{
		return [
			'name' => $record->name,
			'value' => $record->value,
			'has_options' => $record->has_options,
			'options' => $record->options ? explode(',', $record->options) : [],
			'value_option' => $record->value,
		];
	}

	private static function handleAction(Action $action, Setting $record, array $data): void
	{
		$value = $data['value'] ?? $data['value_option'];
		$record->update(['value' => $value]);

		$action->success();

		Notification::make()
			->success()
			->title(__('setting.notifications.changed_title'))
			->body(__('setting.notifications.changed_body'))
			->send();

		$action->getLivewire()->redirect(request()->header('Referer'));
	}
}
