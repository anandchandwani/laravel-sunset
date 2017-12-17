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
        $filterSql = '';
        $paginationSql = '';

        // Handle search
        $search = $request->input('search', null);
        if ($search) {
            $filterSql .= " WHERE ";
            $clauses = [];
            foreach(['redirected_to', 'created_at'] as $searchableField) {
                $clauses[] = " $searchableField LIKE ':search%' ";
            }
            $params['search'] = $search;
            $filterSql .= implode(' OR ', $clauses);
        }

        // Handle pagination params
        $offset = $request->input('offset', null);
        $limit = $request->input('limit', null);
        if ($limit) {
            $paginationSql .= ' LIMIT ' . intval($limit);
        }
        if ($offset) {
            $paginationSql .= ' OFFSET ' . intval($offset);
        }

        $count = app('db')->select("SELECT COUNT(*) AS total FROM " . $this->table . $filterSql);
        $rows = app('db')->select("SELECT * FROM " . $this->table . $filterSql . $paginationSql);

        return [
            'total' => $count[0]->total,
            'rows' => $rows
        ];
    }
}
