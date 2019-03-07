<?php

namespace Laraspace\Http\Controllers;

use Illuminate\Http\Request;

class ManageController extends Controller
{
    public function main()
    {
        $data['users'] = \Laraspace\User::get();
        $data['menu'] = 'Manage';
        return view('admin.manage.main')->with($data);
    }
    public function detail()
    {
        $data['users'] = \Laraspace\User::get();
        $data['menu'] = 'Manage';
        return view('admin.manage.detail')->with($data);
    }
}
