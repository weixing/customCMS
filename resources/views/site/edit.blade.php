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
              <form role="form" action="/site/editRun/" method="post">
                <!-- text input -->
                <div class="form-group">
                  <label>发布点名称</label>
                  <input type="text" class="form-control" value="{{$site->name}}" name="name">
                </div>
                <div class="form-group">
                  <label>发布点域名</label>
                  <input type="text" class="form-control" value="{{$site->domain}}" name="domain">
                </div>
                <div class="form-group">
                  <label>发布点根目录路径</label>
                  <input type="text" class="form-control" value="{{$site->path}}" name="path">
                </div>
                <div class="form-group">
                  <label>
                    <input type="checkbox" value=1 name="status" @if ($site->status) checked @endif>
                    启用
                  </label>
                </div>
                <div class="box-footer">
                  <input type="hidden" name="sid" value="{{$site->sid}}">
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
