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

    public function createApp(Request $request){

        if ($request->input('app') === "create"){
            app('db')->table('apps')->insert([
                'name' => '',
                'default_redirect_url' => "",
                'default_blacklist' => true,
                'redirect_override' => 'disabled'
            ]);

            return ['created' => true];
        }
        return ['error' => true, 'message' => 'Input was not properly set.'];
        
    }

    public function delete(Request $request){
        $ids = $request->input('ids');
        return app('db')->table('apps')->whereIn('id', $ids)->delete();
    }
}
