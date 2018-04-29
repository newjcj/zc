<?php

namespace App\Providers;

use App\Http\Requests\Request;
use App\Models\Cart;
use App\Models\Dists;
use App\Models\Goodscategory;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //有时候我们需要在所有视图之间共享数据片段
        view()->share([
            'category'=>Goodscategory::getTopCategory(),
            'dists'=>Dists::all(),
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
