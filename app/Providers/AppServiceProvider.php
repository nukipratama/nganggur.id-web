<?php

namespace App\Providers;

use App\Observers\UserObserver;
use App\User;
use Blade;
use Carbon\Carbon;
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
        config(['app.locale' => 'id']);
        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id');
        Blade::directive('currency', function ($expression) {
            return "Rp <?php echo number_format($expression, 0, ',', '.'); ?>";
        });

        // Model Observers
        User::observe(UserObserver::class);
    }
}
