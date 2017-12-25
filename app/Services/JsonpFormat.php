<?PHP
/**
 * Short description for JsonpFormat.php
 *
 * @package JsonpFormat
 * @author jujian <jujian@diandong.com>
 * @version 0.1
 * @copyright (C) 2015 jujian <jujian@diandong.com>
 * @license MIT
 */
namespace App\Services;

class JsonpFormat {

    protected $err_code = [
        0 => [
            'en' => 'succ',
            'cn' => '成功',
        ],
        1001 => [
            'en' => 'login fail',
            'cn' => '登陆失败'
        ],
        1002 => [
            'en' => 'illegal request',
            'cn' => '非法请求',
        ],
        1003 => [
            'en' => 'illegal param',
            'cn' => '参数错误',
        ],
        1004 => [
            'en' => 'query failed',
            'cn' => '外部请求失败，请稍后重试',
        ],
        1005 => [
            'en' => 'frequently request',
            'cn' => '请勿频繁请求，稍后重试',
        ],
        1006 => [
            'en' => 'invalid captcha',
            'cn' => '图片验证码错误',
        ],
        2001 => [
            'en' => 'wrong password',
            'cn' => '原始密码错误',
        ],
        3001 => [
            'en' => 'validate failed',
            'cn' => '表单验证失败',
        ],
    ];

    /*
     * 格式化jsonp输出
     * */
    public function jsonpSucc($value) {
        $data = [
            'code' => 0,
            'message' => $this->err_code[0]['en'],
            'description' => $this->err_code[0]['cn'],
            'data' => $value,
            'state' => [
                'err' => false,
                'err_message' => $this->err_code[0]['en'],
            ],
        ];

        return $data;
    }

    /*
     * 错误输出提示
     * @param $err_message = ['en'=>'xx', 'cn'=>'yy'];
     *
     * */
    public function jsonpFail($value, $err_code, $err_message=NULL) {
        if ($err_code > 0 && isset($this->err_code[$err_code])) {
            $en_message = $this->err_code[$err_code]['en'];
            $cn_message = $this->err_code[$err_code]['cn'];
            isset($err_message['en']) && $en_message = $err_message['en'];
            isset($err_message['cn']) && $en_message = $err_message['cn'];

            $data = [
                'code' => $err_code,
                'message' => $en_message,
                'description' => $cn_message,
                'data' => $value,
                'state' => [
                    'err' => true,
                    'err_message' => $en_message,
                ]
            ];

            return $data;
        }

        return $value;
    }
}

