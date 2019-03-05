<?php

namespace Laraspace\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InstallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['menu'] = 'Install';
        return view('install.index')->with($data);
    }

    public function list(){
        return \DataTables::of(\DB::select('SHOW TABLES'))
        ->addIndexColumn()
        ->toJson();
    }

    public function column(Request $request){
        return \DataTables::of(\DB::select('SHOW COLUMNS FROM '.$request->table))
        ->addIndexColumn()
        ->addColumn('checkall',function($rec){
        return      '<div class="form-check">
                        <input type="checkbox" class="form-check-input" name="'.$rec->Field.'[\'use\']">
                        <label class="form-check-label"></label>
                    </div>';
        })
        ->addColumn('inputtype',function($rec){
        $str = 
        '<select class="inputtype" name="'.$rec->Field.'[\'inputtype\']">
            <option value="">== select input type ==</option>
            <option value="text">text</option>
            <option value="textarea">textarea</option>
            <option value="dropdown">dropdown</option>
            <option value="datetime">datetime</option>
            <option value="date">date</option>
            <option value="time">time</option>
            <option value="checkbox">checkbox</option>
        </select>';
        return $str;
        })
        ->addColumn('validate',function($rec){
            return '<input name="'.$rec->Field.'[\'validate\']" type="checkbox">';
        })
        ->addColumn('null',function($rec){
            return null;
        })
        ->rawColumns(['checkall','inputtype','validate'])
        ->make(true);
    }

    public function detailvalue(Request $request){
        if(count($request->all())==0){
            return \DB::select('SHOW TABLES');
        }else if(isset($request->table)){
            return \DB::select('SHOW COLUMNS FROM '.$request->table);
        }else{
            return false;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Storage::get('example.txt');
        // return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function form($variable){
        switch ($variable) {
            case 'text':
                return '';
                break;
            
            case 'dropdown':
                return '';
                break;
            
            case 'checkbox':
                return '';
                break;

            case 'switch':
                return '';
                break;
            
            case 'date':
                return '';
                break;

            case 'time':
                return '';
                break;
        }
    }

}