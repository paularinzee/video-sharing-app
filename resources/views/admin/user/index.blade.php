@extends('admin.layouts.default')

@section('after_styles') 
<!-- DataTables -->
<link rel="stylesheet" href="{{url('vendor/plugins/datatables/dataTables.bootstrap.css')}}">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/css/lightbox.min.css" />
<style type="text/css">
.view_img{
  cursor: pointer;
}
</style>
@stop

@section('after_scripts') 
<!-- DataTables --> 
<script src="{{url('vendor/plugins/datatables/jquery.dataTables.min.js')}}"></script> 
<script src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script> 
<script src="{{url('vendor/plugins/datatables/dataTables.bootstrap.min.js')}}"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/js/lightbox.min.js"></script> 
<script>
$(function () {
 $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


   var table =  $('#example1').DataTable({
      /*  order: [[ 0, 'desc' ]],*/
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: '{{route("users.get")}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'role', name: 'role',orderable:false},
            {data: 'status', name: 'active',orderable:false},
            {data: 'created_at', name: 'created_at'},
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
    <h1> Images </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{url('admin/dashboard')}}">Admin</a></li>
      <li class="active">Images</li>
    </ol>
  </section>
  
  <!-- Main content -->
  <section class="content">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">{{$page_title}}</h3>
        <a href="{{url('admin/users/create')}}" class="btn btn-primary pull-right">Create User</a> </div>
      <!-- /.box-header -->
      <div class="box-body"> @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          {!! implode('', $errors->all('
          <li>:message</li>
          ')) !!} </div>
        @endif
        
        @if(session('success'))
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          {{session('success')}} </div>
        @endif
        <div id="response"></div>
       
        <table id="example1" class="table table-bordered table-striped responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Status</th>
              <th>Created at</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
          <tfoot>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Status</th>
              <th>Created at</th>
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