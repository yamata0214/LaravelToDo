<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ToDoServiceProvider extends ServiceProvider{

    public function boot(){
        View::composer('ToDo.index', function($view){
            $view->with('view_message', 'これはメッセージの表示です。Service Provider');
        });
    }
}
