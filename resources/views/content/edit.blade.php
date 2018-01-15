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
              <form role="form" action="/content/editRun/" method="post" enctype="multipart/form-data">
                <!-- text input -->
                <div class="form-group">
                  <label>文章标题</label>
                  <input type="text" class="form-control" value="{{$content->title}}" name="title">
                </div>
                <div class="form-group">
                  <label>文章子标题</label>
                  <input type="text" class="form-control" value="{{$content->sub_title}}" name="sub_title">
                </div>
                <div class="form-group">
                  <label>所属分类</label>
                  <select class="form-control" name="category_id">
                    <option value="0">请选择</option>
                    @foreach ($categoryList as $oneCategory)
                    <option value="{{$oneCategory->cid}}" @if ($oneCategory->cid == $content->category_id) selected @endif>{{$oneCategory->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>文章焦点图</label>
                    <input type="file" id="exampleInputFile" name="thumb">
                    <img src="http://{{config('constants.webSite')}}{{$content->thumb}}">
                    <p class="help-block">请上传文章的焦点图</p>
                </div>
                <div class="form-group">
                  <label>文章内容</label>
                  {{--<textarea class="form-control" rows="10" placeholder="请输入文章内容..." name="text">{{$content->text}}</textarea>--}}
                  @include('vendor.ueditor.assets')
                  <!-- 实例化UEditor编辑器 -->
                  <script type="text/javascript">
                      var ue = UE.getEditor('container', {
                                    //initialFrameWidth :800,//设置编辑器宽度
                                    initialFrameHeight:300,//设置编辑器高度
                                    scaleEnabled:true
						 		});
                      ue.ready(function() {
                          ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                      });
                  </script>

                <!-- 编辑器容器 -->
                <script id="container" name="text" type="text/plain">{!!$content->text!!}</script>
                </div>
                <div class="box-footer">
                  <input type="hidden" name="cid" value="{{$content->cid}}">
                  <?php echo method_field('PUT'); ?>
                  <?php echo csrf_field(); ?>
                  <button type="submit" class="btn btn-primary">提交修改</button>
                </div>
              </form>
            </div>
            <!-- /.box-body -->
            <div>
              <div class="box-footer">
                <a type="submit" class="btn btn-success" href="/content/validate?cid={{$content->cid}}&status=1">通过审核</a>
                <a type="submit" class="btn btn-danger" href="/content/validate?cid={{$content->cid}}&status=3">不通过审核</a>
              </div>
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
