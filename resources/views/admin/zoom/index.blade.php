@extends('admin.layout.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Zoom Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item active">Meeting List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <div class="modal fade" id="mymodal">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Delete Confirmation</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>Are you Sure to Delete ? &hellip;</p>
                        </div>
                        <form action="{{ route('zoom.user.create') }}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="text" name="first_name">
                            <input type="text" name="last_name">
                            <input type="email" name="email">
                            <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Create New User</button>
                            </div>
                        </form>
                      </div>
                      
                    </div>
                    
                  </div>
    <!-- Main content -->
    <section class="content">
      <div class="card">
              <div class="card-header">
                
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h3 class="card-title">Meeting List </h3>
                  </div>
                  <div class="col-sm-6 " style="text-align: right;">
                    <a href="{{route('meeting.create')}}" class="btn btn-sm btn-success"> Add New Meeting  <i class="fa fa-plus"></i></a>
                    <!-- <a href="#mymodal" role="button" class="btn mr-0 mb-0 btn-warning btn-sm" data-toggle="modal"><i class="fa fa-user"></i> Add Zoom User</a> -->
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Start url</th>
                    <th>Topic</th>
                    
                    <th>Duration(Minutes)</th>
                  
                    <th>Joining url</th>                    
                    <th>Start Time</th>
                    <th>Created At</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($meetings as $meetings)
                     <tr> 
                      <td><a href="{{url('admin/meetings/'.$meetings->id)}}"  class="btn btn-xs btn-warning">{{$meetings->id}}</a></td>
                      <td><a href="{{url('admin/start_meeting/'.$meetings->id)}}" target="_blank" class="btn btn-xs btn-warning">Start Meeting</a>
                        
                        
                      </td>
                      <td>{{$meetings->topic}}</td>
                      <td>{{$meetings->duration}} </td>
                      <td><a href="{{$meetings->join_url}}" target="_blank" class="btn btn-xs btn-warning"> Join Now</a> </td>
                      
                      <td>{{$meetings->start_time}}</td>
                      <td>{{$meetings->created_at}}</td>
                      <td>
                        <a class="btn btn-xs  btn-info" href="{{url('admin/meetings/'.$meetings->id)}}">
                             <i class="fa fa-edit"></i>
                        </a>
                       
                        <a href="#mymodal{{$meetings->id}}" role="button" class="btn mr-0 mb-0 btn-outline-primary btn-xs" data-toggle="modal"><i class="fa fa-trash"></i></a>
                      </td>
                      </tr>
                      <div class="modal fade" id="mymodal{{$meetings->id}}">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Delete Meeting Confirmation</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>Are you Sure to Delete Meeting? </p>
                        </div>
                        <form action="{{ route('meetings.destroy', $meetings->id) }}" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        
                            <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Confirmation</button>
                            </div>
                        </form>
                      </div>
                      
                    </div>
                    
                  </div>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                   <th>ID</th>
                   <th>Joining url</th>
                   <th>Topic</th>
                    <th>Duration(Minutes)</th>
                  
                    <th>Joining url</th>                    
                    <th>Start Time</th>
                    <th>Created At</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
    </section>
    <!-- /.content -->
  </div>

@endsection