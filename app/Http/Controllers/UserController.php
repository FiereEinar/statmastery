<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function updateProfileView() {
        $user = auth()->guard("web")->user();
        return view("update-profile", ["user"=> $user]);
    }
}