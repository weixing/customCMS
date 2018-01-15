@extends('global')

@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <!-- general form elements disabled -->
          <div class="box box-warning">
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" action="/user/editRun/" method="post">
                <!-- text input -->
                <div class="form-group">
                  <label>登录名</label>
                  <input type="text" class="form-control" value="{{$user->account}}" name="account">
                </div>
                <div class="form-group">
                  <label>角色</label>
                  <select class="form-control" name="rid">
                    @foreach ($roleList as $oneRole)
                    <option value="{{$oneRole->rid}}" @if ($oneRole->rid == $user->rid) selected @endif>{{$oneRole->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>姓名</label>
                  <input type="text" class="form-control" value="{{$user->name}}" name="name">
                </div>
                <div class="form-group">
                  <label>密码</label>
                  <input type="password" class="form-control" placeholder="如需重置密码，请输入新密码" name="password">
                </div>
                <div class="form-group">
                  <label>确认密码</label>
                  <input type="password" class="form-control" placeholder="请确认密码" name="password_confirmation">
                </div>
                <div class="form-group">
                  <label>
                    <input type="checkbox" value=1 name="status" @if ($user->status) checked @endif>
                    启用
                  </label>
                </div>
                <div class="box-footer">
                  <input type="hidden" name="uid" value="{{$user->uid}}">
                  <?php echo method_field('PUT'); ?>
                  <?php echo csrf_field(); ?>
                  <button type="submit" class="btn btn-primary">提交修改</button>
                </div>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection
