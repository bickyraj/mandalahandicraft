<?php

namespace App\Providers;

use App\Category;
use App\Company;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        view()->composer(['frontend.partials.header'], function ($view) {

            $category = new Category();
            $allMenu = $category->getParentCategory();
            $headerMenu = $category->getHeaderMenu();
            $all_categories = $category->all();

            $view->with(compact('allMenu', 'headerMenu', 'all_categories'));
        });

        view()->composer(['frontend.layouts.header_menu_mobile'], function ($view) {
            $category = new Category();
            $allMenu = $category->getParentCategory();
            $headerMenu = $category->getHeaderMenu();

            $view->with(compact('allMenu', 'headerMenu'));
        });


        view()->composer(['frontend.layouts.footer_menu'], function ($view)  {

            $category = new Category();
            $allMenu = $category->getParentCategory();

            $view->with(compact('allMenu'));
        });

        view()->composer(['emails.email_layout'], function ($view)  {
            $company = Company::first();

            $view->with(compact('company'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
