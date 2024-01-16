<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
        // Gate::define('it', function (User $user) {
        //     return $user->departement !== 'IT';
        // });
        // Gate::define('product', function (User $user) {
        //     return $user->departement !== 'Product';
        // });
        // Gate::define('management', function (User $user) {
        //     return $user->departement !== 'Management';
        // });
        // Gate::define('fna', function (User $user) {
        //     return $user->departement !== '
        //     Finance and Accounting';
        // });
        // Gate::define('sales', function (User $user) {
        //     return $user->departement !== '
        //     Sales';
        // });
        // Gate::define('warehouse', function (User $user) {
        //     return $user->departement !== '
        //     Warehouse';
        // });
        // Gate::define('billing', function (User $user) {
        //     return $user->departement !== '
        //     Billing';
        // });
        // Gate::define('hrd', function (User $user) {
        //     return $user->departement !== '
        //     HRD';
        // });
    }
}
