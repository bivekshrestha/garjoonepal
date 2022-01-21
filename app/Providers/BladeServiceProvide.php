<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvide extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('checkNull', function ($expression) {
            return "<?php if($expression){ echo {$expression};}else{ echo '';} ?>";
        });

        Blade::directive('userName', function () {
            return "<?php echo auth()->user()->first_name . ' ' . auth()->user()->last_name; ?>";
        });

        Blade::if('owner', function ($userId) {
            return auth()->user() && $userId == auth()->id();
        });

        Blade::directive('endowner', function ($userId) {
            return "<?php endif; ?>";
        });
    }
}
