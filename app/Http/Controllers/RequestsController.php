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


    public function patch(Request $request, $id){

        return app('db')->update("update requests set redirected_to = :redirected_to, updated_at = :updated_at where id = :id", [
            'id' => $id,
            'redirected_to' => $request->input('redirected_to'),
        ]);
    }
}
