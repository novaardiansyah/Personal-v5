<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SwitchLanguage extends Page
{
	protected static bool $shouldRegisterNavigation = false;
	protected string $view = 'filament.pages.switch-language';

	public function mount(): void
	{
		$currentLocale = App::getLocale();
		$newLocale = $currentLocale === 'en' ? 'id' : 'en';

		Session::put('locale', $newLocale);
		App::setLocale($newLocale);

		$this->redirect(url()->previous() ?: '/app');
	}
}
