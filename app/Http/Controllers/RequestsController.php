<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestsController extends Controller
{

    public $table = "requests";
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

//    Removable?
    //Works but deprecating for patchEditable below
    // public function patch(Request $request, $id){
    //     return app('db')->update("update requests set redirected_to = :redirected_to, updated_at = :updated_at where id = :id", [
    //         'id' => $id,
    //         'redirected_to' => $request->input('redirected_to'),
    //     ]);
    // }

    public function patchEditable(Request $request){
        $id = $request->input('pk');
        $name = $request->input('name');
        $value = $request->input('value');

        return app('db')->update("update requests set ".$name." = '".$value."' where id = ".$id);
    }
}
