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
                  <th>页面名称</th>
                  <th>发布点</th>
                  <th>URL</th>
                  <th colspan=2>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($webpageList as $webpage)
                <tr>
                  <td><span class="glyphicon @if ($webpage->status == 0) glyphicon-remove @else glyphicon-ok @endif" id="webpageStatusIcon_{{$webpage->wpid}}"></span></td>
                  <td>{{$webpage->name}}</td>
                  <td>@if (isset($siteList[$webpage->sid])){{$siteList[$webpage->sid]->name}}@endif</td>
                  <td>@if (isset($siteList[$webpage->sid]))<a href="http://{{$siteList[$webpage->sid]->domain}}{{$webpage->url}}" target="blank">{{$webpage->url}}</a>@endif</td>
                  <td>
                    <a type="button" class="btn btn-block btn-info btn-xs" href="/webpage/edit/{{$webpage->wpid}}">编辑</a>
                  </td>
                  <td>
                    @if ($webpage->status == 1)
                    <button type="button" class="btn btn-block btn-danger btn-xs" id="editWebpageStatus_{{$webpage->wpid}}">删除</button>
                    @else
                    <button type="button" class="btn btn-block btn-success btn-xs" id="editWebpageStatus_{{$webpage->wpid}}">恢复</button>
                    @endif
                  </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th></th>
                  <th>页面名称</th>
                  <th>发布点</th>
                  <th>URL</th>
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
