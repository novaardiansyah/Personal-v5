<?php

namespace App\Models;

use Filament\Auth\MultiFactor\App\Contracts\HasAppAuthentication;
use Filament\Auth\MultiFactor\Email\Contracts\HasEmailAuthentication;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Panel;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Storage;
use App\Observers\UserObserver;

#[Fillable(['name', 'email', 'password', 'app_authentication_secret', 'has_email_authentication', 'avatar_url'])]
#[Hidden(['password', 'remember_token'])]
#[ObservedBy(UserObserver::class)]
class User extends Authenticatable implements FilamentUser, MustVerifyEmail, HasAppAuthentication, HasEmailAuthentication, HasAvatar
{
	use HasFactory, Notifiable;

	protected function casts(): array
	{
		return [
			'email_verified_at' => 'datetime',
			'password' => 'hashed',
			'app_authentication_secret' => 'encrypted',
			'has_email_authentication' => 'boolean',
		];
	}

	public function canAccessPanel(Panel $panel): bool
	{
		if ($panel->getId() === 'app') {
			return str_ends_with($this->email, '@' . config('app.domain')) && $this->hasVerifiedEmail();
		}

		return false;
	}

	public function getAppAuthenticationSecret(): ?string
	{
		return $this->app_authentication_secret;
	}

	public function saveAppAuthenticationSecret(?string $secret): void
	{
		$this->app_authentication_secret = $secret;
		$this->save();
	}

	public function getAppAuthenticationHolderName(): string
	{
		return $this->email;
	}

	public function hasEmailAuthentication(): bool
	{
		return $this->has_email_authentication;
	}

	public function toggleEmailAuthentication(bool $condition): void
	{
		$this->has_email_authentication = $condition;
		$this->save();
	}

	public function getFilamentAvatarUrl(): ?string
	{
		return Storage::url($this->avatar_url);
	}
}
