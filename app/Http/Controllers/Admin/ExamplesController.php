<?php

namespace Laraspace\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Laraspace\Http\Controllers\Controller;

use Laraspace\Models\Examples;
use Laraspace\Models\Bank;



class ExamplesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$data['bank'] = Bank::get();

        $data['menu'] = 'Examples';
        return view('admin.lbl.examples')->with($data);
    }

    public function list(){
        $model = Examples::query();
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
        if(!empty($request->id)){
            $this->update($request,$request->id);
        }else{
            Examples::insert($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!empty($id)){
            return Examples::find($id);
        }else{
            return false;
        }
        
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
        Examples::where('id',$id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $example = Examples::findOrFail($id);
        if($example->delete()){
            return $result['status'] = "success";
        }else{
            return $result['status'] = "error";
        }
    }
}