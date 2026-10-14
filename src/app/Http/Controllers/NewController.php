<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class NewController extends Controller
{
    public function index()
    {
        $users=User::all();
       
        return view('new.index');
    }
}
