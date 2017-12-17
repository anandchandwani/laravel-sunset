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
        parent::__construct();
    }

    public function patchEditable(Request $request){
        $id = $request->input('pk');
        $name = $request->input('name');
        $value = $request->input('value');

        return app('db')->update("update requests set ".$name." = '".$value."' where id = ".$id);
    }

    public function all(Request $request){
        $sqlClause = '';
        // Handle pagination params
        $offset = $request->input('offset', null);
        $limit = $request->input('limit', null);
        if ($limit) {
            $sqlClause .= ' LIMIT ' . intval($limit);
        }
        if ($offset) {
            $sqlClause .= ' OFFSET ' . intval($offset);
        }


        die($sqlClause);
        $count = app('db')->select("SELECT COUNT(*) AS total FROM " . $this->table . $sqlClause);
        $rows = app('db')->select("SELECT * FROM " . $this->table . $sqlClause);

        return [
            'total' => $count[0]->total,
            'rows' => $rows
        ];
    }
}
