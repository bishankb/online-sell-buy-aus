<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Product;
use App\Models\ContactUs;
use Carbon\Carbon;

class ComposerViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        view()->composer(
            ['frontend.partials.featured-products'],
            function ($view) {
                $featured_products = Product::where('status', 1)
                                            ->where('is_sold', 0)
                                            ->where('is_featured', 1)
                                            ->where('expiry_period', '>', Carbon::now())
                                            ->latest()
                                            ->take(15)
                                            ->get();

                $view->with('featured_products', $featured_products);
            }
        );

        view()->composer(
            ['frontend.partials.footer'],
            function ($view) {
                $contact_us =  ContactUs::select('facebook', 'twitter')->first();

                $view->with('contact_us', $contact_us);
            }
        );
    }
}
