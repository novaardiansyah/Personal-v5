<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\EditProfile;
use Filament\Auth\MultiFactor\App\AppAuthentication;
use Filament\Auth\MultiFactor\Email\EmailAuthentication;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Width;
use Filament\View\PanelsRenderHook;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\HtmlString;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AppPanelProvider extends PanelProvider
{
	public function panel(Panel $panel): Panel
	{
		return $panel
			->default()
			->id('app')
			->path('app')
			->brandName(config('app.name'))
			->spa()
			->login()
			->registration()
			->profile(EditProfile::class)
			->when(config('app.env') === 'production', fn (Panel $panel) => $panel->domain(config('app.url')))
			->topbar(false)
			->sidebarCollapsibleOnDesktop()
			->maxContentWidth(Width::Full)
			->passwordReset()
			->emailVerification()
			->authGuard('web')
			->favicon(asset('favicon.png'))
			->colors([
				'primary' => Color::Cyan,
			])
			->multiFactorAuthentication([
				AppAuthentication::make(),
				EmailAuthentication::make()
					->codeExpiryMinutes(10),
			])
			->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
			->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
			->pages([
				Dashboard::class,
			])
			->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
			->widgets([
				AccountWidget::class,
				// FilamentInfoWidget::class,
			])
			->middleware([
				EncryptCookies::class,
				AddQueuedCookiesToResponse::class,
				StartSession::class,
				AuthenticateSession::class,
				ShareErrorsFromSession::class,
				PreventRequestForgery::class,
				SubstituteBindings::class,
				DisableBladeIconComponents::class,
				DispatchServingFilamentEvent::class,
			])
			->authMiddleware([
				Authenticate::class,
			])
			->renderHook(
				PanelsRenderHook::HEAD_END,
				fn(): HtmlString => new HtmlString('
          <style>
            *::-webkit-scrollbar { display: none; }
            * { -ms-overflow-style: none; scrollbar-width: none; }
          </style>
        ')
			);
	}
}
