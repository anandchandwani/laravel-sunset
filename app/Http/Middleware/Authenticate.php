<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
//        $user = isset($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : null;
//        $pass = isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : null;
//        if ($user !== 'Adam123' || $pass !== 'Adam123#') {
//            header('WWW-Authenticate: Basic realm="Protected zone"');
//            header('HTTP/1.0 401 Unauthorized');
//            echo 'Access denied';
//            exit;
//        }




        $realm = 'Запретная зона';

//user => password
        $users = array('admin' => 'mypass', 'guest' => 'guest');


        if (empty($_SERVER['PHP_AUTH_DIGEST'])) {
            header('HTTP/1.1 401 Unauthorized');
            header('WWW-Authenticate: Digest realm="'.$realm.
                '",qop="auth",nonce="'.uniqid().'",opaque="'.md5($realm).'"');

            die('Текст, отправляемый в том случае, если пользователь нажал кнопку Cancel');
        }


// анализируем переменную PHP_AUTH_DIGEST
        if (!($data = http_digest_parse($_SERVER['PHP_AUTH_DIGEST'])) ||
            !isset($users[$data['username']]))
            die('Неправильные данные!');


// генерируем корректный ответ
        $A1 = md5($data['username'] . ':' . $realm . ':' . $users[$data['username']]);
        $A2 = md5($_SERVER['REQUEST_METHOD'].':'.$data['uri']);
        $valid_response = md5($A1.':'.$data['nonce'].':'.$data['nc'].':'.$data['cnonce'].':'.$data['qop'].':'.$A2);

        if ($data['response'] != $valid_response)
            die('Неправильные данные!');


// функция разбора заголовка http auth
        function http_digest_parse($txt)
        {
            // защита от отсутствующих данных
            $needed_parts = array('nonce'=>1, 'nc'=>1, 'cnonce'=>1, 'qop'=>1, 'username'=>1, 'uri'=>1, 'response'=>1);
            $data = array();
            $keys = implode('|', array_keys($needed_parts));

            preg_match_all('@(' . $keys . ')=(?:([\'"])([^\2]+?)\2|([^\s,]+))@', $txt, $matches, PREG_SET_ORDER);

            foreach ($matches as $m) {
                $data[$m[1]] = $m[3] ? $m[3] : $m[4];
                unset($needed_parts[$m[1]]);
            }

            return $needed_parts ? false : $data;
        }

        return $next($request);
    }
}
