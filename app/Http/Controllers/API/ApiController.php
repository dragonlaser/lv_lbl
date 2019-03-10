<?php

namespace Laraspace\Http\Controllers\API;

use Illuminate\Http\Request;
use Laraspace\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function get_menu(Request $request)
    {
        return \Laraspace\Models\FrontMenu::with('FrontSubMenu')->get();
    }
}
