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
                  <th>角色名成</th>
                  <th colspan=2>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($roleList as $role)
                <tr>
                  <td><span class="glyphicon @if ($role->status == 0) glyphicon-remove @else glyphicon-ok @endif" id="roleStatusIcon_{{$role->rid}}"></span></td>
                  <td>{{$role->name}}</td>
                  <td>
                    <a type="button" class="btn btn-block btn-info btn-xs" href="/role/edit/{{$role->rid}}">编辑</a>
                  </td>
                  <td>
                    @if ($role->status == 1)
                    <button type="button" class="btn btn-block btn-danger btn-xs" id="editRoleStatus_{{$role->rid}}">删除</button>
                    @else
                    <button type="button" class="btn btn-block btn-success btn-xs" id="editRoleStatus_{{$role->rid}}">恢复</button>
                    @endif
                  </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th></th>
                  <th>角色名成</th>
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
