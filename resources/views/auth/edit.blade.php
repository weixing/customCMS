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
              <form role="form" action="/auth/editRun/" method="post">
                <!-- text input -->
                <div class="form-group">
                  <label>权限名称</label>
                  <input type="text" class="form-control" value="{{$auth->name}}" name="name">
                </div>
                <div class="form-group">
                  <label>父级权限</label>
                  <select class="form-control" name="pid">
                    <option value=0>设置为父级权限</option>
                    @foreach ($authList as $oneAuth)
                    <option value="{{$oneAuth->aid}}" @if ($oneAuth->aid == $auth->pid) selected @endif>{{$oneAuth->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>模块名称</label>
                  <input type="text" class="form-control" value="{{$auth->controller}}" name="controller">
                </div>
                <div class="form-group">
                  <label>方法名称</label>
                  <input type="text" class="form-control" value="{{$auth->action}}" name="action">
                </div>
                <div class="form-group">
                  <label>入口路由</label>
                  <input type="text" class="form-control" value="{{$auth->url}}" name="url">
                </div>
                <div class="form-group">
                  <label>显示顺序</label>
                  <input type="text" class="form-control" value="{{$auth->order}}" name="order">
                </div>
                <div class="form-group">
                  <label>显示Icon</label>
                  <input type="text" class="form-control" value="{{$auth->icon}}" name="icon">
                </div>
                <div class="form-group">
                  <label>
                    <input type="checkbox" value=1 name="is_menu" @if ($auth->is_menu) checked @endif>
                    显示在菜单列表
                  </label>
                </div>
                <div class="form-group">
                  <label>
                    <input type="checkbox" value=1 name="status" @if ($auth->status) checked @endif>
                    启用
                  </label>
                </div>
                <div class="box-footer">
                  <input type="hidden" name="aid" value="{{$auth->aid}}">
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
