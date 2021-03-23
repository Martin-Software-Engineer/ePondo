<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use App\Models\Role;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Fortify::registerView(function() {

            $roles = Role::where('name','!=','Admin')->get();
            return view ('auth.register', ['roles' => $roles]);
        });

        Fortify::loginView(function() {
            return view ('auth.login');
        });

        Fortify::requestPasswordResetLinkView(function() {
            return view ('auth.forgot-password');
        });

        Fortify::resetPasswordView(function($request){
            return view('auth.reset-password', ['request' => $request]);
        });

        Fortify::verifyEmailView(function() {
            return view ('auth.verify-email');
        });
    }
}
