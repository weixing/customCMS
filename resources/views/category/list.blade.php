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
                  <th>类别名称</th>
                  <th>类别别名</th>
                  <th colspan=2>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($categoryList as $category)
                <tr>
                  <td><span class="glyphicon @if ($category->status == 0) glyphicon-remove text-red @else glyphicon-ok text-green @endif" id="categoryStatusIcon_{{$category->cid}}"></span></td>
                  <td>{{$category->name}}</td>
                  <td>{{$category->alias}}</td>
                  <td>
                    <a type="button" class="btn btn-block btn-info btn-xs" href="/category/edit/{{$category->cid}}">编辑</a>
                  </td>
                  <td>
                    @if ($category->status == 1)
                    <button type="button" class="btn btn-block btn-danger btn-xs" id="editCategoryStatus_{{$category->cid}}">删除</button>
                    @else
                    <button type="button" class="btn btn-block btn-success btn-xs" id="editCategoryStatus_{{$category->cid}}">恢复</button>
                    @endif
                  </td>
                </tr>

                @foreach ($category->childList as $childCategory)
                <tr>
                  <td><span class="glyphicon @if ($childCategory->status == 0) glyphicon-remove text-red @else glyphicon-ok text-green @endif" id="categoryStatusIcon_{{$childCategory->cid}}"></span></td>
                  <td><span style="padding:0 20px;">┗ </span>{{$childCategory->name}}</td>
                  <td>{{$childCategory->alias}}</td>
                  <td>
                    <a type="button" class="btn btn-block btn-info btn-xs" href="/category/edit/{{$childCategory->cid}}">编辑</a>
                  </td>
                  <td>
                    @if ($childCategory->status == 1)
                    <button type="button" class="btn btn-block btn-danger btn-xs" id="editCategoryStatus_{{$childCategory->cid}}">删除</button>
                    @else
                    <button type="button" class="btn btn-block btn-success btn-xs" id="editCategoryStatus_{{$childCategory->cid}}">恢复</button>
                    @endif
                  </td>
                </tr>
                @endforeach
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th></th>
                  <th>类别名称</th>
                  <th>类别别名</th>
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
