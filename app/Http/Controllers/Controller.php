<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    //

    protected $table = "";
    protected $index = "id";

    public function all(){
        return app('db')->select("SELECT * FROM " . $this->table);
    }

    public function find($id){
        return app('db')->select("SELECT * FROM ".$this->table." WHERE ".$this->index." = :index", ['index' => $id]);
    }
}
