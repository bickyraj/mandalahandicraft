<?php

namespace App\Providers;

use App\Company;
use Illuminate\Support\ServiceProvider;
use View;
use Cart;
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

         view()->composer('*', function ($view) 
            {
                $view->with('cartItems', collect(Cart::content())->values()->sortByDesc('rowId'));
                $view->with('cartCount', Cart::count());
                $view->with('cartSubTotalPrice', Cart::subtotal());
                
                $company = Company::first();
                $view->with('company', $company);


                 
           });  
        // View::share('cartItems',collect(Cart::content())->values());
        
           
    }
}
