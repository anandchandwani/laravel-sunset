<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;


class Controller extends BaseController
{
    //

    protected $table = "";
    protected $index = "id";

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['get']]);
    }

    public function all(Request $request){
        return app('db')->select("SELECT * FROM " . $this->table);
    }

    public function find($id){
        return app('db')->select("SELECT * FROM ".$this->table." WHERE ".$this->index." = :index", ['index' => $id]);
    }


    public function patch(Request $request){
        $id = $request->input('pk');
        $name = $request->input('name');
        $value = $request->input('value');

        // return "update ".$this->table." set ".$name." = '".$value."' where ".$this->index." = ".$id;
        return app('db')->update("update ".$this->table." set ".$name." = '".$value."' where ".$this->index." = ".$id);
    }
}
