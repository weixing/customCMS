<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
use View;
use Route;

use App\Services\Helper;
use App\Models\Auth;
use App\Models\Role;

class CheckLogin
{
    protected $redirect = '/login/';
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $admin = Session::get('admin');
        if (!$admin || !$admin->uid) {
            return redirect($this->redirect);
        }
        View::share('admin', $admin);

        if (!$this->checkAuth()) {
            //return response('您无权进行此项操作', 403);
            abort(401, '您无权进行此项操作');
        }

        return $next($request);
    }

    private function checkAuth()
    {
        $adminAuth = $this->getAuth();
        $currentAuth = $this->getCurrentAuth();

        //将当前页面的权限id推送到试图，用于构建左侧菜单
        View::share('currentAuthId', $currentAuth->aid);
        View::share('parentAuthId', $currentAuth->pid);

        if (in_array($currentAuth->aid, $adminAuth)) {
            return true;
        } else {
            return false;
        }
    }

    private function getAuth()
    {
        if (!$adminAuth = Session::get('adminAuth')) {
            $admin = Session::get('admin');
            $role = Role::find(Session::get('admin')->rid);
            $adminAuth = Helper::FormatIntArrayStr($role->aids);
            Session::put('adminAuth', $adminAuth);
        }
        return $adminAuth;
    }

    private function getCurrentAuth()
    {
        $routeInfo = $this->getRouteInfo();
        $currentAuth = Auth::where('controller', '=', $routeInfo['controller'])
            ->where('action', '=', $routeInfo['action'])
            ->first();
        return $currentAuth;
    }

    private function getRouteInfo()
    {
        $routeInfo = Route::currentRouteAction();

        // $controller now is "App\Http\Controllers\FooBarController"
        list($controller, $action) = explode('@', $routeInfo);

        // $controller now is "FooBarController"
        $controller = preg_replace('/.*\\\/', '', $controller);
        $controller = strtolower(str_replace('Controller', '', $controller));
        
        return ['controller' => $controller, 'action' => $action];
    }
}
