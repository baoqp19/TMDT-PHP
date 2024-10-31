<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Slider;
use App\Models\User;
use App\Observers\AdminObserver;
use App\Observers\GalleryObserver;
use App\Observers\ProductObserver;
use App\Observers\SliderObserver;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
        Blade::directive('money', function ($price) {
            return "<?php echo number_format($price, 0, '', '.')  .  ' VNĐ'; ?>";
        });

        Product::observe(ProductObserver::class);
        Gallery::observe(GalleryObserver::class);
        Slider::observe(SliderObserver::class);
        User::observe(UserObserver::class);
        Admin::observe(AdminObserver::class);
    }
}
