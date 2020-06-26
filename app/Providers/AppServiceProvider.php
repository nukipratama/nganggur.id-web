<?php

namespace App\Providers;

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
        Carbon::setLocale('id');
        Blade::directive('currency', function ($expression) {
            return "Rp <?php echo number_format($expression, 0, ',', '.'); ?>";
        });
    }
}
