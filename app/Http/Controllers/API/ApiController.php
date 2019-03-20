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
    public function get_content($id, Request $request)
    {
        return \Laraspace\Models\FrontContent::with('FrontPhotoContent')->find($id);
    }
}
