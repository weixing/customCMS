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
              <form role="form" action="/block/editRun/" method="post">
                <!-- text input -->
                <div class="form-group">
                  <label>区块名称</label>
                  <input type="text" class="form-control" value="{{$block->name}}" name="name">
                </div>
                <div class="form-group">
                  <label>区块类别</label>
                  <select class="form-control" name="type">
                    @foreach ($blockType as $typeKey => $typeName)
                    <option value="{{$typeKey}}" @if ($typeKey == $block->type) selected @endif>{{$typeName}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>模板</label>
                  <textarea class="form-control" rows="10" placeholder="请输入模板内容..." name="template">{{$block->template}}</textarea>
                </div>
                <div class="form-group">
                  <label>
                    <input type="checkbox" value=1 name="status" @if ($block->status) checked @endif>
                    启用
                  </label>
                </div>
              </div>
            </div>

            <!-- 字段设置，用于保存动态区块的推荐字段 -->
            <div class="box box-info">
              <div class="box-header">
                <h3 class="box-title">字段设置</h3>
                <button type="button" class="btn btn-success pull-right">添加</button>
              </div>
              <div class="box-body">
                <!-- Color Picker -->
                <div class="row">
                  <div class="col-xs-3">
                    <input type="text" class="form-control" placeholder="顶端的">
                  </div>
                  <div class="col-xs-4">
                    <input type="text" class="form-control" placeholder="别别别">
                  </div>
                  <div class="col-xs-3">
                    <button type="button" class="btn btn-danger">删除</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- 提交按钮 -->
            <div class="box box-success">
              <div class="form-group">
                <div class="box-footer">
                  <input type="hidden" name="bid" value="{{$block->bid}}">
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
