<?php

namespace App\Http\Controllers;

use App/task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index($Request requrst){
        $items = task::all();
        return view()
    }
}
