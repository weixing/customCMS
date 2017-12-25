<?PHP
namespace App\Services;

class Helper {

    /**
     * 整理","隔开的数组，去除重复项目
     * @param Str $str 字符串
     * @return array 整理后的数组
     */
    public static function FormatIntArrayStr($str) {
        $array = explode(',', $str);
        $final_array = [];
        foreach ($array as $value) {
            $final_array[] = intval($value);
        }
        return array_unique($final_array);
    }

    /**
     * 根据用户名和密码，生成密码加密信息
     * @param Str $account 登录名
     * @param Str $password 密码原文
     * @return Str 加密后的密码
     */
    public static function BuildPWDHash($account, $password)
    {
        return md5($password.$account.'MMTS');
    }

    /**
     * 显示信息
     * @param $message 需要显示的信息
     * @return void
     */
    public static function showMessage($message, $url = '')
    {
        return view('ShowMessage')
            ->with('message', $message)
            ->with('url', $url);
    }
}
