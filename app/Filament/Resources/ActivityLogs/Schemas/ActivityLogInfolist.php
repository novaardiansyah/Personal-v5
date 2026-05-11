<?php

namespace App\Filament\Resources\ActivityLogs\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\KeyValueEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ActivityLogInfolist
{
	public static function configure(Schema $schema): Schema
	{
		return $schema
			->components([
				Section::make([
					TextEntry::make('causer.name')
						->label(__('activity_log.fields.causer')),
					TextEntry::make('subject')
						->label(__('activity_log.fields.subject'))
						->formatStateUsing(function ($state, $record) {
							if (!$record->subject_type) {
								return '-';
							}

							$modelName = class_basename($record->subject_type);
							return "{$modelName} #{$record->subject_id}";
						}),
					TextEntry::make('created_at')
						->label(__('general.labels.created_at'))
						->dateTime()
						->sinceTooltip(),
					TextEntry::make('log_name')
						->label(__('activity_log.fields.log_name'))
						->badge()
						->formatStateUsing(fn(string $state): string => ucwords($state))
						->color(fn(string $state, $record): string => $record->getLognameColor($state)),
					TextEntry::make('event')
						->label(__('activity_log.fields.event'))
						->badge()
						->color(fn(string $state, $record): string => $record->getEventColor($state)),
					TextEntry::make('description')
						->label(__('activity_log.fields.description'))
						->wrap()
						->limit(300)
						->columnSpanFull(),
				])
					->description(__('activity_log.sections.general_information'))
					->columns(3)
					->collapsible(),

				Section::make([
					TextEntry::make('ip_address')
						->label(__('activity_log.fields.ip_address')),
					TextEntry::make('timezone')
						->label(__('activity_log.fields.timezone')),
					TextEntry::make('geolocation')
						->label(__('activity_log.fields.geolocation')),
					TextEntry::make('country')
						->label(__('activity_log.fields.country')),
					TextEntry::make('city')
						->label(__('activity_log.fields.city')),
					TextEntry::make('region')
						->label(__('activity_log.fields.region')),
					TextEntry::make('postal')
						->label(__('activity_log.fields.postal')),
					TextEntry::make('user_agent')
						->label(__('activity_log.fields.user_agent'))
						->columnSpan(2),
					TextEntry::make('referer')
						->label(__('activity_log.fields.referer'))
						->columnSpan(2),
				])
					->description(__('activity_log.sections.location_client'))
					->columns(3)
					->collapsible()
					->visible(fn($record) => $record->ip_address !== null),

				Section::make([
					KeyValueEntry::make('properties_str')
						->label(__('activity_log.fields.properties')),
					KeyValueEntry::make('prev_properties_str')
						->label(__('activity_log.fields.prev_properties'))
						->visible(fn($record) => $record->prev_properties !== null),
				])
					->description(__('activity_log.sections.properties_information'))
					->collapsible()
					->visible(fn($record) => $record->properties !== null),
			])
			->columns(1);
	}
}
