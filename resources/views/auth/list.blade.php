@extends('global')

@section('content')
  <!-- Main content -->
    <section class="content">
      <div class="row">
        @foreach ($authList as $auth)
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{$auth->name}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th></th>
                  <th>权限组名称</th>
                  <th>权限名称</th>
                  <th>排序</th>
                  <th>权限路径</th>
                  <th>控制器(Controller)</th>
                  <th>执行方法(Action)</th>
                  <th colspan=2>操作</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td><span class="glyphicon @if ($auth->status == 0) glyphicon-remove text-red @else glyphicon-ok text-green @endif" id="authStatusIcon_{{$auth->aid}}"></span></td>
                  <td>{{$auth->name}}</td>
                  <td>{{$auth->order}}</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>
                    <a type="button" class="btn btn-block btn-info btn-xs" href="/auth/edit/{{$auth->aid}}">编辑</a>
                  </td>
                  <td>
                    @if ($auth->status == 1)
                    <button type="button" class="btn btn-block btn-danger btn-xs" id="editAuthStatus_{{$auth->aid}}">删除</button>
                    @else
                    <button type="button" class="btn btn-block btn-success btn-xs" id="editAuthStatus_{{$auth->aid}}">恢复</button>
                    @endif
                  </td>
                </tr>
                @foreach ($subAuthList[$auth->aid] as $subAuth)
                <tr>
                  <td><span class="glyphicon @if ($subAuth->status == 0) glyphicon-remove text-red @else glyphicon-ok text-green @endif" id="authStatusIcon_{{$subAuth->aid}}"></span></td>
                  <td></td>
                  <td>{{$subAuth->name}}</td>
                  <td>{{$subAuth->order}}</td>
                  <td>{{$subAuth->url}}</td>
                  <td>{{$subAuth->controller}}</td>
                  <td>{{$subAuth->action}}</td>
                  <td>
                    <a type="button" class="btn btn-block btn-info btn-xs" href="/auth/edit/{{$subAuth->aid}}">编辑</a>
                  </td>
                  <td>
                    @if ($subAuth->status == 1)
                    <button type="button" class="btn btn-block btn-danger btn-xs" id="editAuthStatus_{{$subAuth->aid}}">删除</button>
                    @else
                    <button type="button" class="btn btn-block btn-success btn-xs" id="editAuthStatus_{{$subAuth->aid}}">恢复</button>
                    @endif
                  </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th></th>
                  <th>权限组名称</th>
                  <th>权限名称</th>
                  <th>排序</th>
                  <th>权限路径</th>
                  <th>控制器(Controller)</th>
                  <th>执行方法(Action)</th>
                  <th colspan=2>操作</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        @endforeach
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

@endsection
