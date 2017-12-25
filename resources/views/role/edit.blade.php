@extends('global')

@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- right column -->
        <div class="col-md-6">
          <!-- Horizontal Form -->
          <!-- general form elements disabled -->
          <div class="box box-warning">
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" action="/role/editRun/" method="post">
                <!-- text input -->
                <div class="form-group">
                  <label>角色名称</label>
                  <input type="text" class="form-control" value="{{$role->name}}" name="name">
                </div>
                <div class="form-group">
                  <label>
                    <input type="checkbox" value=1 name="status" @if ($role->status) checked @endif>
                    启用
                  </label>
                </div>
                <div class="form-group">
                  <label>权限列表</label>

                  <div class="box box-warning">
                    <div class="box-body">
                      @foreach ($authList as $auth)
                      <div class="form-group">
                        <label><p class="text-red">{{$auth->name}}</p></label>
                      </div>
                      <div class="form-group">
                        @foreach ($subAuthList[$auth->aid] as $subAuth)
                        <label style="padding-left:30px;">
                          <input type="checkbox" value="{{$subAuth->aid}}" name="aids[]" @if (in_array($subAuth->aid, $roleAuth)) checked @endif>
                          {{$subAuth->name}}
                        </label>
                        @endforeach
                      </div>
                      @endforeach
                      <!-- /input-group -->
                    </div>
                    <!-- /.box-body -->
                  </div>

                </div>
                <div class="box-footer">
                  <input type="hidden" name="rid" value="{{$role->rid}}">
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
