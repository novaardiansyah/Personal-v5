<?php

/*
 * Project Name: personal-v5
 * File: UtilsHelper.php
 * Created Date: May 14, 2026
 *
 * Author: Nova Ardiansyah admin@novaardiansyah.id
 * Website: https://novaardiansyah.id
 * MIT License: https://github.com/novaardiansyah/personal-v5/blob/main/LICENSE
 *
 * Copyright (c) 2026 Nova Ardiansyah, Org
 */

use App\Models\Setting;
use App\Models\ActivityLog;
use App\Models\Generate;
use Carbon\Carbon;
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

function money(int|float|null $amount, string $currency = 'IDR', ?string $locale = null, int $divideBy = 1): string
{
	if ($amount === null) {
		return '-';
	}

	$locale ??= match (strtoupper($currency)) {
		'IDR' => 'id_ID',
		'USD' => 'en_US',
		'EUR' => 'de_DE',
		'JPY' => 'ja_JP',
		'GBP' => 'en_GB',
		default => 'en_US',
	};

	$formatter = new NumberFormatter($locale, NumberFormatter::CURRENCY);

	return $formatter->formatCurrency($amount / $divideBy, strtoupper($currency));
}

function getCode(string $alias, bool $isNotPreview = true)
{
  $genn = Generate::withTrashed()->where('alias', $alias)->first();
  $date = now()->translatedFormat('ymd');

  if (!$genn) {
    $queue = substr($date, 0, 4) . substr(time(), -4) . substr($date, 4, 2);
    return 'ER-' . $queue;
  }

  $separator = Carbon::createFromFormat('ymd', $genn->separator)->translatedFormat('ymd');

  $diffMonthAndYear = substr($date, 0, 4) != substr($separator, 0, 4);
  $maxLimitQueue = 9999;

  if ((int) $genn->queue >= $maxLimitQueue || $diffMonthAndYear) {
    $genn->queue = 1;
    $genn->separator = $date;
  }

  $queue = substr($date, 0, 4) . str_pad($genn->queue, 4, '0', STR_PAD_LEFT) . substr($date, 4, 2);

  if ($genn->prefix)
    $queue = $genn->prefix . $queue;
  if ($genn->suffix)
    $queue .= $genn->suffix;

  if ($isNotPreview) {
    $genn->queue += 1;
    $genn->save();
  }

  return $queue;
}
