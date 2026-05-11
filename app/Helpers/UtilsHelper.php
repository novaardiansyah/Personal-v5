<?php

use App\Models\Setting;
use App\Models\ActivityLog;
use Illuminate\Support\Str;

function getSetting(string $key, $default = null)
{
	return cache()->rememberForever("setting.{$key}", function () use ($key, $default) {
		return Setting::where('key', $key)->first()?->value ?? $default;
	});
}

function textCapitalize($text)
{
	return trim(ucwords(strtolower($text)));
}

function textUpper($text)
{
	return trim(strtoupper($text));
}

function textLower($text)
{
	return trim(strtolower($text));
}

function uuid7(): string
{
	$string = Str::uuid7()->toString();
	return textUpper($string);
}

function toIndonesianCurrency(float $number = 0, int $precision = 0, string $currency = 'Rp', bool $showCurrency = true)
{
	$result = 0;

	if ($number < 0) {
		$result = '-' . $currency . number_format(abs($number), $precision, ',', '.');
	} else {
		$result = $currency . number_format($number, $precision, ',', '.');
	}

	if ($showCurrency)
		return $result;

	return number_format($number, $precision, ',', '.');
}

function saveActivityLog(array $data = [], $modelMorph = null): ActivityLog
{
	$logData = [
		'log_name'    => $data['log_name'] ?? 'Resource',
		'description' => $data['description'] ?? null,
		'event'       => $data['event'] ?? null,
		'batch_uuid'  => $data['batch_uuid'] ?? null,
		'ip_address'  => request()->ip(),
		'user_agent'  => request()->userAgent(),
		'referer'     => request()->header('referer'),
	];

	$causer = auth()->user();
	if ($causer) {
		$logData['causer_type'] = get_class($causer);
		$logData['causer_id'] = $causer->id;
	}

	if ($modelMorph) {
		$logData['subject_type'] = get_class($modelMorph);
		$logData['subject_id'] = $modelMorph->id;

		$attributes = $modelMorph->getAttributes();
		$hidden     = $modelMorph->getHidden();
		$attributes = array_diff_key($attributes, array_flip($hidden));

		if (isset($data['event']) && $data['event'] === 'Updated') {
			$dirty = $modelMorph->getDirty();
			$dirty = array_diff_key($dirty, array_flip($hidden));

			$logData['properties'] = $dirty;
			$logData['prev_properties'] = array_intersect_key($modelMorph->getOriginal(), $dirty);
		} else {
			$logData['properties'] = $attributes;
		}
	}

	$logData = array_merge($logData, $data);

	return ActivityLog::create($logData);
}
