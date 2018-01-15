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
                  <th>文章标题</th>
                  <th>类别</th>
                  <th>创建人</th>
                  <th>创建时间</th>
                  <th>审核人</th>
                  <th>发布时间</th>
                  <th>状态</th>
                  <th>审核</th>
                  <th colspan=2>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($contentList as $content)
                <tr>
                  <td><span class="glyphicon @if ($content->status == 0) glyphicon-remove text-red @else glyphicon-ok text-green @endif" id="contentStatusIcon_{{$content->cid}}"></span></td>
                  <td>{{$content->title}}</td>
                  <td>@if (isset($categoryList[$content->category_id])){{$categoryList[$content->category_id]->name}} @endif</td>
                  <td>{{$content->create_user}}</td>
                  <td>{{$content->createtime}}</td>
                  <td>{{$content->validate_user}}</td>
                  <td>{{$content->validate_time}}</td>
                  <td id="contentValidate_{{$content->cid}}">@if (isset($validateList[$content->status])){{$validateList[$content->status]}} @endif</td>
                  <td>
                    <a type="button" class="btn btn-block btn-primary btn-xs" href="/content/edit/{{$content->cid}}">审核</a>
                  </td>
                  <td>
                    <a type="button" class="btn btn-block btn-info btn-xs" href="/content/edit/{{$content->cid}}">编辑</a>
                  </td>
                  <td>
                    @if ($content->status == 2)
                    <button type="button" class="btn btn-block btn-danger btn-xs" id="editContentStatus_{{$content->cid}}">删除</button>
                    @endif
                    @if ($content->status == 0)
                    <button type="button" class="btn btn-block btn-success btn-xs" id="editContentStatus_{{$content->cid}}">恢复</button>
                    @endif
                  </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th></th>
                  <th>文章标题</th>
                  <th>类别</th>
                  <th>创建人</th>
                  <th>创建时间</th>
                  <th>审核人</th>
                  <th>发布时间</th>
                  <th>状态</th>
                  <th>审核</th>
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
