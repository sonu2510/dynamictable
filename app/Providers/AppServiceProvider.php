<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Schema;
use View;
use Auth;
use App;
use Illuminate\Support\Facades\Route;

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
        Schema::defaultStringLength(191);

        view()->composer('*',function($view) {
            //$view->with('user', Auth::user());
            $view->with('categories', \App\Models\admin_menu::tree());

        });

        view()->composer('*',function($view) {
            if(Auth::user()){
            $view->with('role_permission',\App\Models\role_permission_model::join('users','users.id','=','role_permission.user_id')
                    ->where('users.id','=',Auth::user()->id)
                    ->first());
        }
          });
    }
}
