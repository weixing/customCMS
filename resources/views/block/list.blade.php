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
                  <th>区块名称</th>
                  <th>别名</th>
                  <th>区块类别</th>
                  <th>编辑内容</th>
                  <th colspan=2>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($blockList as $block)
                <tr>
                  <td><span class="glyphicon @if ($block->status == 0) glyphicon-remove text-red @else glyphicon-ok text-green @endif" id="blockStatusIcon_{{$block->bid}}"></span></td>
                  <td>{{$block->name}}</td>
                  <td>template_{{$block->bid}}</td>
                  <td>@if (isset($blockType[$block->type])) {{$blockType[$block->type]}} @endif</td>
                  <td>
                    @if (2 == $block->type)
                    <a type="button" class="btn btn-block btn-primary btn-xs" href="/block/editContent/{{$block->bid}}">编辑内容</a>
                    @endif
                  </td>
                  <td>
                    <a type="button" class="btn btn-block btn-info btn-xs" href="/block/edit/{{$block->bid}}">编辑</a>
                  </td>
                  <td>
                    @if ($block->status == 1)
                    <button type="button" class="btn btn-block btn-danger btn-xs" id="editBlockStatus_{{$block->bid}}">删除</button>
                    @else
                    <button type="button" class="btn btn-block btn-success btn-xs" id="editBlockStatus_{{$block->bid}}">恢复</button>
                    @endif
                  </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th></th>
                  <th>区块名称</th>
                  <th>别名</th>
                  <th>区块类别</th>
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
