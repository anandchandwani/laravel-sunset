<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IPController extends Controller
{

    public $table = "ips";
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function delete(Request $request){
        $ids = $request->input('ids');
        app('db')->statement('SET FOREIGN_KEY_CHECKS=0');
        app('db')->table('ips')->whereIn('id', $ids)->delete();
        app('db')->statement('SET FOREIGN_KEY_CHECKS=1');
        return;
    }

    public function all(Request $request){
        $sql = "SELECT * FROM " . $this->table;
        $params = [];
        if ($campaign_id = $request->input('campaign_id')) {
            $params['campaign_id'] = $campaign_id;
        }
        if ($is_blacklisted = $request->input('is_blacklisted')) {
            $params['is_blacklisted'] = $is_blacklisted;
        }
//        if ($params) {
//            $sql .= " WHERE ";
//            $clauses = [];
//            foreach ($params as $field => $value) {
//                $clauses[] = " $field = :$field ";
//            }
//            $sql .= implode(' AND ', $clauses);
//
//            return app('db')->select($sql, $params);
//        }

        return app('db')->select($sql);
    }
}
