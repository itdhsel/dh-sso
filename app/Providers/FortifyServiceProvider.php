<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Fortify;
use LdapRecord\Models\ActiveDirectory\User as LdapUser;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::loginView(fn () => view('auth.login'));

        /**
         * Authenticate using Active Directory
         */
        Fortify::authenticateUsing(function (Request $request) {

            $username = $request->input('username');

            if (!str_contains($username, '@')) {
                $username .= '@hospitalselayang.gov.my';
            }            $password = $request->input('password');

            if (empty($username) || empty($password)) {
                return null;
            }

            try {

                /**
                 * Find AD user
                 */
                $ldapUser = LdapUser::where(
                    'userprincipalname',
                    '=',
                    $username
                )->first();
                
                
                if (!$ldapUser) {
                    return null;
                }
                
                
                $connection = \LdapRecord\Container::getConnection('default');
                
                
                if (!$connection->auth()->attempt($username, $password)) {
                    return null;
                }


                /**
                 * Create / update local SSO user
                 */
                return User::updateOrCreate(
                    [
                        'username' => $username,
                    ],
                    [
                        'name' => $ldapUser->getFirstAttribute('cn')
                            ?? $username,

                        'email' => $ldapUser->getFirstAttribute('mail')
                            ?? $username,

                        /**
                         * Local password is not used.
                         * Store random hash only because Laravel requires it.
                         */
                        'password' => Hash::make(Str::random(64)),
                    ]
                );


            } catch (\Exception $e) {

                logger()->error(
                    'LDAP Authentication Error: '.$e->getMessage()
                );

                return null;
            }

        });


        Fortify::createUsersUsing(
            \App\Actions\Fortify\CreateNewUser::class
        );

        Fortify::updateUserProfileInformationUsing(
            \App\Actions\Fortify\UpdateUserProfileInformation::class
        );

        Fortify::updateUserPasswordsUsing(
            \App\Actions\Fortify\UpdateUserPassword::class
        );

        Fortify::resetUserPasswordsUsing(
            \App\Actions\Fortify\ResetUserPassword::class
        );

        Fortify::redirectUserForTwoFactorAuthenticationUsing(
            RedirectIfTwoFactorAuthenticatable::class
        );


        /**
         * Login throttling
         */
        RateLimiter::for('login', function (Request $request) {

            $throttleKey = Str::transliterate(
                Str::lower(
                    $request->input(Fortify::username())
                )
                .'|'
                .$request->ip()
            );

            return Limit::perMinute(5)->by($throttleKey);

        });


        RateLimiter::for('two-factor', function (Request $request) {

            return Limit::perMinute(5)
                ->by(
                    $request->session()->get('login.id')
                );

        });
    }
}