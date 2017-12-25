@extends('global')

@section('content')
  <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th></th>
                  <th>登陆名</th>
                  <th>姓名</th>
                  <th>角色</th>
                  <th colspan=2>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($userList as $user)
                <tr>
                  <td><span class="glyphicon @if ($user->status == 0) glyphicon-remove @else glyphicon-ok @endif" id="userStatusIcon_{{$user->uid}}"></span></td>
                  <td>{{$user->account}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$roleList[$user->rid]->name}}</td>
                  <td>
                    <a type="button" class="btn btn-block btn-info btn-xs" href="/user/edit/{{$user->uid}}">编辑</a>
                  </td>
                  <td>
                    @if ($user->status == 1)
                    <button type="button" class="btn btn-block btn-danger btn-xs" id="editUserStatus_{{$user->uid}}">删除</button>
                    @else
                    <button type="button" class="btn btn-block btn-success btn-xs" id="editUserStatus_{{$user->uid}}">恢复</button>
                    @endif
                  </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th></th>
                  <th>登陆名</th>
                  <th>姓名</th>
                  <th>角色</th>
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
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

@endsection
