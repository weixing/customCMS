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
              <form role="form" action="/webpage/editRun/" method="post">
                <!-- text input -->
                <div class="form-group">
                  <label>页面名称</label>
                  <input type="text" class="form-control" value="{{$webpage->name}}" name="name">
                </div>
                <div class="form-group">
                  <label>页面访问路径</label>
                  <input type="text" class="form-control" value="{{$webpage->url}}" name="url">
                </div>
                <div class="form-group">
                  <label>对应发布点</label>
                  <select class="form-control" name="sid">
                    @foreach ($siteList as $oneSite)
                    <option value="{{$oneSite->sid}}" @if ($oneSite->sid == $webpage->sid) selected @endif>{{$oneSite->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>模板</label>
                  <textarea class="form-control" rows="10" placeholder="请输入模板内容..." name="template">{{$webpage->template}}</textarea>
                </div>
                <div class="form-group">
                  <label>
                    <input type="checkbox" value=1 name="status" @if ($webpage->status) checked @endif>
                    启用
                  </label>
                </div>
                <div class="box-footer">
                  <input type="hidden" name="wpid" value="{{$webpage->wpid}}">
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
