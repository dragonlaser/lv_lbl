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
                        <input type="checkbox" class="form-check-input" name="'.$rec->Field.'[use]">
                        <label class="form-check-label"></label>
                    </div>';
        })
        ->addColumn('inputtype',function($rec){
        $str = 
        '<select class="inputtype" name="'.$rec->Field.'[inputtype]">
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
        //
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

    public function createmvc(Request $request){
        // return $request;
        $allinput = $request->all();
        foreach ($request->all() as $key => $value) {
            if(!empty($value['source'])){
                $this->createmodel($value['source']);
            }
        }
        $result[] = $this->createmodel($request->table);
        $result[] = $this->createcontroller($request);
        $result[] = $this->createjs($request);

        return $result;
    }

    public function createmodel($table){
        $classname = str_replace("_",'',ucfirst($table));
        if(!file_exists(app_path("Models/$classname.php"))){
            //read examplemodel file
            $content = Storage::disk('install')->get('example_model.txt');
            $content = str_replace("#modelclass#",$classname,$content);
            $modeltable = 'protected $table = \''.$table.'\';';
            $content = str_replace("#modeltable#",$modeltable,$content);

            //write new model file
            Storage::disk('app')->put("Models/$classname.php",$content);
        }
        return 'model success';
    }

    public function createcontroller(Request $request){
        $table = $request->table;
        $classname = str_replace("_",'',ucfirst($table));
        if(!file_exists(app_path("Http/Admin/".$classname."Controller.php"))){
            $content = Storage::disk('install')->get('example_controller.txt');

            #controllerclass#
            $content = str_replace("#controllerclass#",$classname.'Controller',$content);

            #usemainmodel#
            $usemainmodel = 'use Laraspace\Models\\'.$classname.';';
            $content = str_replace("#usemainmodel#",$usemainmodel,$content);

            #usechildmodel#
            #childdata#
            $usechildmodel = ''; $childdata = '';
            foreach ($request->all() as $key => $value) {
                if(!empty($value['source'])){
                    $usechildmodel .= "use Laraspace\Models\\".str_replace("_",'',ucfirst($value['source'])).";\r\n";
                    $childdata .= "\t\t".'$data[\''.str_replace("_",'',strtolower($value['source'])).'\'] = '.str_replace("_",'',ucfirst($value['source'])).'::get();'."\n";
                }
            }
            $content = str_replace("#usechildmodel#",$usechildmodel,$content);
            $content = str_replace("#childdata#",$childdata,$content);

            #mainmodel#
            $content = str_replace("#mainmodel#",$classname,$content);

            #mainmodelstrtolower#
            $content = str_replace("#mainmodelstrtolower#",$request->table,$content);

            Storage::disk('app')->put("Http/Controllers/Admin/".$classname ."Controller.php",$content);
        }
        return 'controller success';
    }

    public function createjs(Request $request){
        $table = $request->table;
        $classname = str_replace("_",'',ucfirst($table));
        $lowerclassname = str_replace("_",'',strtolower($table));
        if(!file_exists(public_path("assets/admin/js/admin/$lowerclassname.js"))){
            //read examplemodel file
            $content = Storage::disk('install')->get('example_js.txt');
            $content = str_replace("#strlower#",$lowerclassname,$content);
            $content = str_replace("#classname#",$classname,$content);
            //write new model file
            
            $str = '';
            foreach ($request->all() as $key => $value) {
                if(!empty($value['use'])){
                    if(!empty($value['use'])){
                        $str.="\t\t\t\t\t{\"data\":\"$key\",\"name\":\"$lowerclassname."."$key.\"},\n";
                    }
                }
            }
            $content = str_replace("#showfield#",$str,$content);
            Storage::disk('js')->put("$lowerclassname.js",$content);
        }

        return 'js success';
    }

}