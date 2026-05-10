<?php

use App\Models\Setting;
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
