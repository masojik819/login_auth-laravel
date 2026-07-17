<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Cache\RateLimiting\Limit;

use Illuminate\Support\Facades\RateLimiter;


class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

   public function boot(): void
{
    RateLimiter::for('login', function (Request $request) {
        return Limit::perMinute(5)->by(
            $request->email.$request->ip()
        );
    });

    RateLimiter::for('two-factor', function (Request $request) {
        return Limit::perMinute(5)->by(
            $request->session()->get('login.id')
        );
    });

    Fortify::loginView(fn () => view('auth.login'));

    Fortify::registerView(fn () => view('auth.register'));

    Fortify::requestPasswordResetLinkView(fn () => view('auth.forgot-password'));

    Fortify::resetPasswordView(fn ($request) => view('auth.reset-password', [
        'request' => $request,
    ]));

    Fortify::verifyEmailView(fn () => view('auth.verify-email'));

    Fortify::confirmPasswordView(fn () => view('auth.confirm-password'));

    Fortify::twoFactorChallengeView(fn () => view('auth.two-factor-challenge'));

    // authenticateUsing() jika sudah Anda tambahkan, biarkan tetap ada.
}
}