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
        if ($campaign_id = $request->input('app_id')) {
            $params['app_id'] = $campaign_id;
        }
        if ($is_blacklisted = $request->input('is_blacklisted')) {
            $params['is_blacklisted'] = $is_blacklisted;
        }
        if ($params) {
            $sql .= " WHERE ";
            $clauses = [];
            foreach ($params as $field => $value) {
                $clauses[] = " $field = :$field ";
            }
            $sql .= implode(' AND ', $clauses);

            return app('db')->select($sql, $params);
        }

        return app('db')->select($sql);
    }

    /**
     * Processes manual adding ip (or diapason) to blacklist
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\View\View|\Laravel\Lumen\Http\Redirector
     */
    public function toBlackList(Request $request)
    {
        if ($request->isMethod('post') && ($ip = $request->input('ip')) && ($appId = $request->input('app_id'))) {
            $existingIp = app('db')->select(
                "SELECT id FROM " . $this->table . " WHERE ip = "
                . intval($ip) . (($appId = intval($appId) ? " AND app_id = " . $appId : ""))
            );
            if (isset($existingIp[0])) {
                $sql = "UPDATE " . $this->table . " SET is_blacklisted = 1 WHERE id = $existingIp[0]['id']";
                $status = app('db')->statement($sql)
                    ? 'success'
                    : 'fail';

            } else {
                $status = app('db')->table($this->table)->insert([
                    'ip' => $ip,
                    'app_id' => $appId,
                    'is_blacklisted' => 1,
                    'redirect_url' => ''
                ]) ? 'success' : 'fail';
            }

            return $request->ajax()
                ? response()->json(['status' => $status])
                : view('add-to-blacklist', ['status' => $status]);
        }

        return view('add-to-blacklist');
    }
}
