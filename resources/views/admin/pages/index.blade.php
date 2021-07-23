@extends('admin.layouts.default')

@section('after_styles') 
<!-- DataTables -->
<link rel="stylesheet" href="{{url('vendor/plugins/datatables/dataTables.bootstrap.css')}}">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css">
@stop

@section('after_scripts') 
<!-- DataTables --> 
<script src="{{url('vendor/plugins/datatables/jquery.dataTables.min.js')}}"></script> 
<script src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script> 
<script src="{{url('vendor/plugins/datatables/dataTables.bootstrap.min.js')}}"></script> 
<script>
$(function () {
 
   var table =  $('#example1').DataTable({
      /*  order: [[ 0, 'desc' ]],*/
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: '{{route("pages.get")}}',
        columns: [
            {data: 'title', name: 'title'},
            {data: 'slug', name: 'slug'},
            {data: 'active', name: 'active'},
            {data: 'action', name: 'action', orderable:false, searchable:false}
        ]
    });

});
</script> 
@stop

@section('content') 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Pages </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{url('admin/dashboard')}}">Admin</a></li>
      <li class="active">Pages</li>
    </ol>
  </section>
  
  <!-- Main content -->
  <section class="content">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">{{$page_title}}</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>Title</th>
              <th>Slug</th>
              <th>Active</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Title</th>
              <th>Slug</th>
              <th>Active</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.box-body --> 
    </div>
  </section>
  <!-- /.content --> 
</div>
<!-- /.content-wrapper --> 

@stop