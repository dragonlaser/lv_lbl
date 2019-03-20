<?php

namespace Laraspace\Http\Controllers;

use Illuminate\Http\Request;

class ManageController extends Controller
{
    /*
     * index
     */

    public function main()
    {
        $data['users'] = \Laraspace\User::get();
        $data['menu'] = 'Manage';
        return view('admin.manage.main')->with($data);
    }
    public function detail()
    {
        $data['users'] = \Laraspace\User::get();
        $data['main'] = \Laraspace\Models\FrontMenu::get();
        $data['menu'] = 'Manage';
        return view('admin.manage.detail')->with($data);
    }
    public function contact_us()
    {
        $data['menu'] = 'Contact us';
        return view('admin.manage.contact_us')->with($data);
    }
    public function content()
    {
        $data['users'] = \Laraspace\User::get();
        $data['categories'] = \Laraspace\Models\FrontCategory::get();
        $data['menu'] = 'Content';
        return view('admin.manage.content')->with($data);
    }
    public function category()
    {
        $data['users'] = \Laraspace\User::get();
        $data['menu'] = 'category';
        return view('admin.manage.category')->with($data);
    }
    public function customer()
    {
        $data['users'] = \Laraspace\User::get();
        $data['menu'] = 'customer';
        return view('admin.manage.customer')->with($data);
    }

    /*
     * store & update
     */
    public function main_store(Request $request)
    {
        $insert = $request->all();
        $insert['created_at'] = date('Y-m-d H:i:s');
        unset($insert['id']);
        if($request->id == null) {
            \Laraspace\Models\FrontMenu::insert($insert);
        } else {
            $insert['updated_at'] = date('Y-m-d H:i:s');
            \Laraspace\Models\FrontMenu::where('id', $request->id)->update($insert);
        }
    }
    public function detail_store(Request $request)
    {
        $insert = $request->all();
        $insert['created_at'] = date('Y-m-d H:i:s');
        unset($insert['id']);
        if($request->id == null) {
            \Laraspace\Models\FrontSubMenu::insert($insert);
        } else {
            $insert['updated_at'] = date('Y-m-d H:i:s');
            \Laraspace\Models\FrontSubMenu::where('id', $request->id)->update($insert);
        }
    }
    public function contact_us_store(Request $request)
    {
        $insert = $request->all();
        $insert['created_at'] = date('Y-m-d H:i:s');
        $insert['ip'] = $request->ip();
        unset($insert['id']);
        if($request->id == null) {
            \Laraspace\Models\FrontContact::insert($insert);
        } else {
            $insert['updated_at'] = date('Y-m-d H:i:s');
            \Laraspace\Models\FrontContact::where('id', $request->id)->update($insert);
        }
    }
    public function content_store(Request $request)
    {
        $insert = $request->all();
        $insert['created_at'] = date('Y-m-d H:i:s');
        unset($insert['id']);
        if($request->id == null) {
            \Laraspace\Models\FrontContent::insert($insert);
        } else {
            $insert['updated_at'] = date('Y-m-d H:i:s');
            \Laraspace\Models\FrontContent::where('id', $request->id)->update($insert);
        }
    }
    public function category_store(Request $request)
    {
        $insert = $request->all();
        $insert['created_at'] = date('Y-m-d H:i:s');
        unset($insert['id']);
        if($request->id == null) {
            \Laraspace\Models\FrontCategory::insert($insert);
        } else {
            $insert['updated_at'] = date('Y-m-d H:i:s');
            \Laraspace\Models\FrontCategory::where('id', $request->id)->update($insert);
        }
    }
    public function customer_store(Request $request)
    {
        $insert = $request->all();
        $insert['created_at'] = date('Y-m-d H:i:s');
        unset($insert['id']);
        if($request->id == null) {
            \Laraspace\Models\CustomerCompany::insert($insert);
        } else {
            $insert['updated_at'] = date('Y-m-d H:i:s');
            \Laraspace\Models\CustomerCompany::where('id', $request->id)->update($insert);
        }
    }

    /*
     * show
     */

    public function main_show($id)
    {
        return json_encode(\Laraspace\Models\FrontMenu::find($id));
    }
    public function detail_show($id)
    {
        return json_encode(\Laraspace\Models\FrontSubMenu::find($id));
    }
    public function contact_us_show($id)
    {
        return json_encode(\Laraspace\Models\FrontContact::find($id));
    }
    public function content_show($id)
    {
        return json_encode(\Laraspace\Models\FrontContent::find($id));
    }
    public function category_show($id)
    {
        return json_encode(\Laraspace\Models\FrontCategory::find($id));
    }
    public function customer_show($id)
    {
        return json_encode(\Laraspace\Models\CustomerCompany::find($id));
    }

    /*
     * delete
     */

    public function main_delete($id)
    {
        \Laraspace\Models\FrontMenu::where('id', $id)->delete();
    }
    public function detail_delete($id)
    {
        \Laraspace\Models\FrontSubMenu::where('id', $id)->delete();
    }
    public function contact_us_delete($id)
    {
        \Laraspace\Models\FrontContact::where('id', $id)->delete();
    }
    public function content_delete($id)
    {
        \Laraspace\Models\FrontContent::where('id', $id)->delete();
    }
    public function category_delete($id)
    {
        \Laraspace\Models\FrontCategory::where('id', $id)->delete();
    }
    public function Customer_delete($id)
    {
        \Laraspace\Models\CustomerCompany::where('id', $id)->delete();
    }
    
    /*
     * dataTable
     */

    public function main_lists(){
        $model = \Laraspace\Models\FrontMenu::select();
        return  \DataTables::eloquent($model)
        ->addColumn('action',function($rec){
            $str = '
            <button class="btn btn-icon btn-outline-default btn-edit" data-id="'.$rec->id.'">
                <i class="icon-fa icon-fa-edit"></i>
            </button>
            <button class="btn btn-icon btn-outline-default btn-delete" data-confirmation="notie" data-id="'.$rec->id.'">
                <i class="icon-fa icon-fa-trash"></i>
            </button>
            ';
            return $str;
        })
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->toJson();
    }
    public function detail_lists(){
        $model = \Laraspace\Models\FrontSubMenu::leftjoin('front_menus', 'front_menus.id', 'front_sub_menus.menu_id')->select('front_sub_menus.*', 'front_menus.title as m_title');
        return  \DataTables::eloquent($model)
        ->addColumn('action',function($rec){
            $str = '
            <button class="btn btn-icon btn-outline-default btn-edit" data-id="'.$rec->id.'">
                <i class="icon-fa icon-fa-edit"></i>
            </button>
            <button class="btn btn-icon btn-outline-default btn-delete" data-confirmation="notie" data-id="'.$rec->id.'">
                <i class="icon-fa icon-fa-trash"></i>
            </button>
            ';
            return $str;
        })
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->toJson();
    }
    public function contact_us_lists(){
        $model = \Laraspace\Models\FrontContact::select();
        return  \DataTables::eloquent($model)
        ->addColumn('action',function($rec){
            $str = '
            <button class="btn btn-icon btn-outline-default btn-edit" data-id="'.$rec->id.'">
                <i class="icon-fa icon-fa-edit"></i>
            </button>
            <button class="btn btn-icon btn-outline-default btn-delete" data-confirmation="notie" data-id="'.$rec->id.'">
                <i class="icon-fa icon-fa-trash"></i>
            </button>
            ';
            return $str;
        })
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->toJson();
    }
    public function content_lists(){
        $model = \Laraspace\Models\FrontContent::leftjoin('front_categories', 'front_categories.id', 'front_contents.category_id')->select('front_contents.*', 'front_categories.name');
        return  \DataTables::eloquent($model)
        ->addColumn('action',function($rec){
            $str = '
            <button class="btn btn-icon btn-outline-default btn-edit" data-id="'.$rec->id.'">
                <i class="icon-fa icon-fa-edit"></i>
            </button>
            <button class="btn btn-icon btn-outline-default btn-delete" data-confirmation="notie" data-id="'.$rec->id.'">
                <i class="icon-fa icon-fa-trash"></i>
            </button>
            ';
            return $str;
        })
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->toJson();
    }
    public function category_lists(){
        $model = \Laraspace\Models\FrontCategory::select();
        return  \DataTables::eloquent($model)
        ->addColumn('action',function($rec){
            $str = '
            <button class="btn btn-icon btn-outline-default btn-edit" data-id="'.$rec->id.'">
                <i class="icon-fa icon-fa-edit"></i>
            </button>
            <button class="btn btn-icon btn-outline-default btn-delete" data-confirmation="notie" data-id="'.$rec->id.'">
                <i class="icon-fa icon-fa-trash"></i>
            </button>
            ';
            return $str;
        })
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->toJson();
    }
    public function customer_lists(){
        $model = \Laraspace\Models\CustomerCompany::select();
        return  \DataTables::eloquent($model)
        ->addColumn('action',function($rec){
            $str = '
            <button class="btn btn-icon btn-outline-default btn-edit" data-id="'.$rec->id.'">
                <i class="icon-fa icon-fa-edit"></i>
            </button>
            <button class="btn btn-icon btn-outline-default btn-delete" data-confirmation="notie" data-id="'.$rec->id.'">
                <i class="icon-fa icon-fa-trash"></i>
            </button>
            ';
            return $str;
        })
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->toJson();
    }
}