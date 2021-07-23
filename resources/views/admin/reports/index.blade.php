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
        ajax: '{{route("reports.get")}}',
        columns: [
            {data: 'check', name: 'id', orderable:false, searchable:false, width:'2%'},
            {data: 'id', name: 'id'},
            {data: 'video', name: 'video_title'},
            {data: 'user', name: 'report_user_id', orderable:false},
            {data: 'reason', name: 'reason', orderable:false},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable:false, searchable:false}
        ]
    });

$("#check_all").on('click',function(){
    if($('#check_all').is(':checked')){
      $('.check').prop('checked',true);
    }
    else{
      $('.check').prop('checked',false);
    }
});


$('.del_selected').on('click',function(){
  var url = "{{url('admin/reported-videos/delete-selected')}}";
  var data = { 'ids[]' : []};
  $(".check:checked").each(function() {
      data['ids[]'].push($(this).val());
    });
  $.ajax({
    url: url,
    type: 'POST',
    data : data,
  })
  .done(function(data) {
    if(data == 'success'){
      $("#response").html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Reports successfully deleted.</div>');
     /* setTimeout(function(){ 
          window.location.reload();
      }, 2000);*/
      table.ajax.reload();
      $('#check_all').prop('checked',false);
    }
    else{
      $("#response").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>No reports selected.</div>');
    }
  });
});

$('.del_selected_videos').on('click',function(){
  var url = "{{url('admin/videos/delete-selected')}}";
  var data = { 'ids[]' : []};
  $(".check:checked").each(function() {
      data['ids[]'].push($(this).data('videoid'));
    });
  $.ajax({
    url: url,
    type: 'POST',
    data : data,
  })
  .done(function(data) {
    if(data == 'success'){
      $("#response").html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Videos successfully deleted.</div>');
     /* setTimeout(function(){ 
          window.location.reload();
      }, 2000);*/
      table.ajax.reload();
      $('#check_all').prop('checked',false);
    }
    else{
      $("#response").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>No videos selected.</div>');
    }
  });
});


});
</script> 
@stop

@section('content') 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Videos </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{url('admin/dashboard')}}">Admin</a></li>
      <li class="active">Reported Videos</li>
    </ol>
  </section>
  
  <!-- Main content -->
  <section class="content">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">{{$page_title}}</h3>
        <div class="btn-group pull-right">
          <button type="button" class="btn dropdown-toggle btn-primary" data-toggle="dropdown" aria-expanded="false"> Action <span class="caret"></span> </button>
          <ul class="dropdown-menu">
            <li><a href="#" class="del_selected"> <i class="fa fa-trash"></i> Delete Selected Reports</a></li>
            <li><a href="#" class="del_selected_videos"> <i class="fa fa-trash"></i> Delete Selected Videos</a></li>
          </ul>
        </div>
      </div>
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
              <th><input type="checkbox" id="check_all" class="check_all"></th>
              <th>ID</th>
              <th>Video</th>
              <th>User</th>
              <th>Reason</th>
              <th>Created at</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
          <tfoot>
            <tr>
              <th>#</th>
              <th>ID</th>
              <th>Video</th>
              <th>User</th>
              <th>Reason</th>
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