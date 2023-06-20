<?php

namespace App\Providers;

use App\Services\Telegram;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 */
	public function register(): void
	{
		app()->bind(
			Telegram::class,
			fn () =>
			new Telegram(config('services.telegram.bot_token'))
		);
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void
	{
		//
	}
}
