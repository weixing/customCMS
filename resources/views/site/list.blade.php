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
                  <th>发布点名称</th>
                  <th>发布点域名</th>
                  <th>发布点路径</th>
                  <th colspan=2>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($siteList as $site)
                <tr>
                  <td><span class="glyphicon @if ($site->status == 0) glyphicon-remove @else glyphicon-ok @endif" id="siteStatusIcon_{{$site->sid}}"></span></td>
                  <td>{{$site->name}}</td>
                  <td>{{$site->domain}}</td>
                  <td>{{$site->path}}</td>
                  <td>
                    <a type="button" class="btn btn-block btn-info btn-xs" href="/site/edit/{{$site->sid}}">编辑</a>
                  </td>
                  <td>
                    @if ($site->status == 1)
                    <button type="button" class="btn btn-block btn-danger btn-xs" id="editSiteStatus_{{$site->sid}}">删除</button>
                    @else
                    <button type="button" class="btn btn-block btn-success btn-xs" id="editSiteStatus_{{$site->sid}}">恢复</button>
                    @endif
                  </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th></th>
                  <th>发布点名称</th>
                  <th>发布点域名</th>
                  <th>发布点路径</th>
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
