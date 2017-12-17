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
        $filterClause = '';
        $params = [];

        // Handle filter params
        if ($campaign_id = $request->input('app_id')) {
            $params['app_id'] = $campaign_id;
        }
        $is_blacklisted = $request->input('is_blacklisted', null);
        if (!is_null($is_blacklisted)) { // Check on null, because can be boolean false or true
            $params['is_blacklisted'] = $is_blacklisted;
        }
        if ($params) {
            $filterClause .= " WHERE ";
            $clauses = [];
            foreach ($params as $field => $value) {
                $clauses[] = " $field = :$field ";
            }
            $filterClause .= implode(' AND ', $clauses);
        }

        // Handle pagination params
        $paginationClause = '';
        $offset = $request->input('offset', null);
        $limit = $request->input('limit', null);
        if ($limit) {
            $paginationClause .= ' LIMIT ' . intval($limit);
        }
        if ($offset) {
            $paginationClause .= ' OFFSET ' . intval($offset);
        }

        $count = app('db')->select("SELECT COUNT(*) AS total FROM " . $this->table . $filterClause, $params);
        $rows = app('db')->select("SELECT * FROM " . $this->table . $filterClause . $paginationClause, $params);

        return [
            'total' => $count[0]->total,
            'rows' => $rows
        ];
    }

    /**
     * Processes manual adding ip (or diapason) to blacklist
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\View\View|\Laravel\Lumen\Http\Redirector
     */
    public function toBlackList(Request $request)
    {
        $apps = app('db')->select("SELECT * FROM apps");
        if ($request->isMethod('post') && ($ip = $request->input('ip'))) {
            try {
                $status = app('db')->table($this->table)->insert([
                    'ip' => $ip,
                    'app_id' => 1,
                    'is_blacklisted' => 1,
                    'redirect_url' => ''
                ]);
            } catch (\Exception $e) {
                $status = false;
            }
            $status = $status || app('db')
                    ->update("UPDATE " . $this->table . " SET is_blacklisted = 1 WHERE ip = :ip", ['ip' => $ip]);

            return $request->ajax()
                ? response()->json(['status' => $status])
                : view('add-to-blacklist', [
                    'apps' => $apps,
                    'ip' => $ip,
                    'status' => $status ? 'success' : 'fail'
                ]);
        }

        return view('add-to-blacklist', ['apps' => $apps]);
    }
}
