<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;

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
        //
        // $categories = Category::all();でも良いが
        //遅延ロードといって最小限のSQLでリレーションを取得
        $categories = Category::with('posts')->get();
        view()->share('categories', $categories); 
    }
}
