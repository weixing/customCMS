<?php namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class AuthException extends Exception
{
    protected $_body = [
        'code' => 0,
        'message' => 'succ',
        'description' => '成功',
        'state' => [
            'err' => false,
            'err_message' => '成功',
        ],
    ];

    public function __construct($msg=[])
    {
        $this->_body['code'] = -1;
        $this->_body['message'] = $msg['en'];
        $this->_body['description'] = $msg['cn'];
        $this->_body['state']['err'] = true;
        $this->_body['state']['err_message'] = '发生错误';
    }

    public function errorJson($request)
    {
        if ($request->input('iframeCross')) {
            return $this->iframeCross($this->_body, $request->input('callback'));
        }
        return response()->json($this->_body)->setCallback($request->input('callback'));
    }

    private function iframeCross($data, $callback) 
    {
        $res = '<script>document.domain="diandong.com";parent.'.$callback.'('.json_encode($data).');</script>';
        return response($res)->header('Content-Type', 'text/html');
    }
}


