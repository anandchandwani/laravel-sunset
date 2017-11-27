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

//    public function all(Request $request){
//        $sql = app('db')->table($this->table);
//        $clauses = [];
//        if ($ip = $request->input('ip')) {
//            $clauses[] = ['ip', 'like', $ip . '%'];
//        }
//        if ($os = $request->input('os')) {
//            $clauses[] = ['os', 'like', $os . '%'];
//        }
////        $country = $request->input('country');
////        $campaign_id = $request->input('campaign_id');
////        $is_blacklisted = $request->input('is_blacklisted');
////        $redirect_url = $request->input('redirect_url');
//
//
//
//        return $sql->where($clauses)->get();
//    }
}
