<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ToDoMiddleware{
    public function handle(Request $request, Closure $next){
        
        $data2 = [
           ['message'=>'これはToDo管理のアプリケーションです。'],
           ['message'=>'これはToDo管理のアプリケーションです。２'],
           ['message'=>'これはToDo管理のアプリケーションです。３'],
       ];
        
       $request->merge(['data2'=>$data2]);
       return $next($request);
    }
}
