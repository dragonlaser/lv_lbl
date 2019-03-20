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
                    </div>
                    <input type="hidden" name="'.$rec->Field.'[field]" value="'.$rec->Field.'">'
                    ;
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
        $result[] = $this->createview($request);

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
            $editfield = '';
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

    public function createview(Request $request){
        // return $request->all();

        $table = $request->table;
        $classname = str_replace("_",'',ucfirst($table));
        $lowerclassname = str_replace("_",'',strtolower($table));
        if(!file_exists(resource_path("views/admin/js/$lowerclassname.blade.js"))){
            //read examplemodel file
            // $content = Storage::disk('install')->get('example_js.txt');
            // $content = str_replace("#strlower#",$lowerclassname,$content);
            // $content = str_replace("#classname#",$classname,$content);
            //write new model file
            
            $str = '';
            $editfield = '';
            foreach ($request->all() as $key => $value) {
                if(!empty($value['use'])){
                    $check = $this->createform(array(
                        'field' => !empty($value['field']) ? $value['field'] : null
                        ,'id' => !empty($value['id']) ? $value['id'] : null
                        ,'name' => !empty($value['name']) ? $value['name'] : null
                        ,'type' => !empty($value['inputtype']) ? $value['inputtype'] : null
                        ,'source'=> !empty($value['source']) ? $value['source'] : null
                    ));
                }
            }
            // $content = str_replace("#showfield#",$str,$content);
            // Storage::disk('js')->put("$lowerclassname.js",$content);
        }

        return $check;
    }

    public function createform($value){
        
        $id = $value['id'];
        $name = $value['name'];
        $type = $value['type'];
        $source = $value['source'];
        $field = $value['field'];
        // return \DB::table($source)->get();

        switch ($type) {
            case 'text':
            return 
            '<div class="form-group row">
                <label for="'.$name.'" class="col-sm-2 col-form-label">'.$name.'</label>
                <div class="col-sm-10">
                    <input type="'.$type.'" name="'.$name.'" placeholder="'.$name.'" class="form-control">
                </div>
            </div>';
            break;

            case 'email':
            return
            '<div class="form-group row">
                <label for="'.$name.'" class="col-sm-2 col-form-label">'.$name.'</label>
                <div class="col-sm-10">
                    <input type="'.$type.'" name="'.$name.'" placeholder="'.$name.'" class="form-control">
                </div>
            </div>';
            break;

            case 'password':
            return
            '<div class="form-group row">
                <label for="'.$name.'" class="col-sm-2 col-form-label">'.$name.'</label>
                <div class="col-sm-10">
                    <input type="'.$type.'" name="'.$name.'" placeholder="'.$name.'" class="form-control">
                </div>
            </div>';
            break;
            
            case 'textarea':
            return
            '<div class="form-group">
                <label for="'.$name.'">'.$name.'</label>
                <textarea id="'.$name.'" name="'.$name.'" rows="3" class="form-control"></textarea>
            </div>';
            break;

            case 'date':
            return
            '<div class="form-group row">
                <label for="'.$name.'" class="col-sm-2 col-form-label">'.$name.'</label>
                <div class="col-sm-10">
                    <input type="'.$type.'" name="'.$name.'" placeholder="'.$name.'" class="form-control">
                </div>
            </div>';
            break;

            case 'dropdown':
            $str  = '<div class="form-group row">'."\n";
            $str .= '<label for="'.$name.'" class="col-sm-2 col-form-label">'.$name.'</label>'."\n";
            $str .= '<select name="'.$field.'" class="ls-select2">'."\n";
            $str .= '<option value="">== '.$name.' ==</option>'."\n";
            if(!empty($value['source']) && !empty($value['id']) && !empty($value['name'])){
                $items = \DB::table($source)->get();
                foreach ($items as $key => $item) {
                        $str .= '<option value="'.$item->{$value['id']}.'">== '.$item->{$value['name']}.' ==</option>'."\n"; 
                }
            }
            $str .= '</select>'."\n";
            $str .= '</div>'."\n";
            return $str;
            break;

            case 'checkbox':
            $str = '';
            if(!empty($value['source']) && !empty($value['id']) && !empty($value['name'])){
                $items = \DB::table($source)->get();
                foreach ($items as $key => $item) {
                        $str .= '<div class="custom-control custom-checkbox mb-3">'."\n";
                        $str .=     '<input type="checkbox" value="'.$item->{$value['id']}.'" name="'.$field.'[]" class="custom-control-input">'."\n";
                        $str .=     '<label for="'.$name.'" class="custom-control-label">'.$name.'</label>'."\n";
                        $str .= '</div>';
                }
            }
            return $str;
            break;

            case 'radio':
            # code...
            break;
        }
    }

}