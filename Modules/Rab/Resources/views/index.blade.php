<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard</title>
  @include("master/header")
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar_project")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Proyek {{ $project->name }}</h1>

    </section>

    <!-- Main content -->
    <section class="content">
      {{ csrf_field() }}
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data RAB dari WO <strong>{{ $workorder->no }}</strong> </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <a href="{{ url('/')}}/rab/add?id={{ $workorder->id }}" class="btn-lg btn-primary"><i class="glyphicon glyphicon-plus-sign"></i>Tambah Data RAB</a>
              <table id="example2" class="table table-bordered table-hover">
                <thead class="head_table">
                <tr>
                  <th>No. Workorder </th>
                  <th>No. Rab</th>
                  <th>Pekerjaan</th>
                  <th>Nilai</th>
                  <th>Dibuat oleh</th>
                  <th>Tanggal Dibuat</th>
                  <th>Detail</th>
                  <th>Status Approval</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ( $workorder->rabs as $key => $value )
                  @if ( $value->parent_id != "" )
                  <tr>
                    <td>{{ $workorder->no }}</td>
                    <td>{{ $value->no }}</td>
                    <td>{{ \Modules\Pekerjaan\Entities\Itempekerjaan::find($value->parent_id)->code }} - {{ \Modules\Pekerjaan\Entities\Itempekerjaan::find($value->parent_id)->name }}</td>
                    <td>{{ number_format($value->nilai) }}</td>
                    <td>{{ \App\User::find($value->created_by)->user_name }}</td>
                    <td>{{ $value->created_at }}</td>
                    <td><a href="{{ url('/')}}/rab/detail?id={{ $value->id }}" class="btn btn-warning">Detail</td>
                    <td>
                      @if ( $value->approval == "" )
                      <button onclick="apprioval('{{ $value->id}}')" class="btn btn-primary">Request Approval</button>
                      @else
                      @php
                        $array = array (
                          "6" => array("label" => "Disetujui", "class" => "label label-success"),
                          "7" => array("label" => "Ditolak", "class" => "label label-danger"),
                          "1" => array("label" => "Dalam Proses", "class" => "label label-warning"),
                          "" => array("label" => "","class" => "")
                        )
                      @endphp
                      <span class="{{ $array[$value->approval->approval_action_id]['class'] }}">{{ $array[$value->approval->approval_action_id]['label'] }}</span>
                      @endif               
                    </td>
                  </tr>
                  @endif
                  @endforeach
                </tbody>
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
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@include("master/footer_table")
@include("rab::app")
</body>
</html>
