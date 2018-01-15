<?PHP
namespace App\Services;

use Illuminate\Http\UploadedFile;
use Config;

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

    /**
     * Format the storage path.
     *
     * @param UploadedFile $file
     *
     * @return mixed
     */
    public static function formatPath(UploadedFile $file)
    {
        $ext = '.'.$file->getClientOriginalExtension();

        $filename = md5($file->getFilename()).$ext;
        $path = Config::get('constants.imagePathFormat');
        $replacement = array_merge(explode('-', date('Y-y-m-d-H-i-s')), [$filename, time()]);
        $placeholders = ['{yyyy}', '{yy}', '{mm}', '{dd}', '{hh}', '{ii}', '{ss}', '{filename}', '{time}'];
        $path = str_replace($placeholders, $replacement, $path);

        //替换随机字符串
        if (preg_match('/\{rand\:([\d]*)\}/i', $path, $matches)) {
            $length = min($matches[1], strlen(PHP_INT_MAX));
            $path = preg_replace('/\{rand\:[\d]*\}/i', str_pad(mt_rand(0, pow(10, $length) - 1), $length, '0', STR_PAD_LEFT), $path);
        }

        if (!str_contains($path, $filename)) {
            $path = str_finish($path, '/').$filename;
        }

        return $path;
    }
}
