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
              <form role="form" action="/category/editRun/" method="post">
                <!-- text input -->
                <div class="form-group">
                  <label>分类名称</label>
                  <input type="text" class="form-control" value="{{$category->name}}" name="name">
                </div>
                <div class="form-group">
                  <label>上级分类</label>
                  <select class="form-control" name="rid">
                    @foreach ($roleList as $oneRole)
                    <option value="{{$oneRole->rid}}" @if ($oneRole->rid == $user->rid) selected @endif>{{$oneRole->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>别名</label>
                  <input type="text" class="form-control" value="{{$category->alias}}" name="domain">
                </div>
                <div class="form-group">
                  <label>
                    <input type="checkbox" value=1 name="status" @if ($category->status) checked @endif>
                    启用
                  </label>
                </div>
                <div class="box-footer">
                  <input type="hidden" name="sid" value="{{$category->sid}}">
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
