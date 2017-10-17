<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppsController extends Controller
{

    public $table = "apps";
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }



    public function post(Request $request){
        $id = $request->input('pk');
        $name = $request->input('name');
        $value = $request->input('value');

        return app('db')->update("update apps set ".$name." = '".$value."' where id = ".$id);
    }

    public function patchEditable(Request $request){
        $id = $request->input('pk');
        $name = $request->input('name');
        $value = $request->input('value');

        return app('db')->update("update requests set ".$name." = '".$value."' where id = ".$id);
    }
}
