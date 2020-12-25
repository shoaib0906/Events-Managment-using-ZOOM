@include('admin.layout.header')
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  @include('admin.layout.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item active">User List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <!-- Main content -->
    <section class="content">
      
      
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card">
              <div class="card-header">
                
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h3 class="card-title">User List (Admin+Visitor)</h3>
                  </div>
                  <div class="col-sm-6 " style="text-align: right;">
                    <a href="{{route('users.create')}}" class="btn btn-sm btn-success"> Add New User  <i class="fa fa-plus"></i></a>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Type</th>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Organisation</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Last Login</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($user as $usr)
                  <tr>
                    <td>
                      @if($usr->user_type==0)
                      Admin
                      @else
                      User
                      @endif
                    </td>
                    <td>{{$usr->name}}</td>
                    <td>{{$usr->email}}
                    </td>
                    <td>{{$usr->organisation}}</td>
                    <td>{{$usr->created_at}}</td>
                    <td> {{$usr->updated_at}}</td>
                    <td>
                      {{$usr->last_login}}
                    </td>
                    <td>
                      
                       <!--  <a class="btn btn-xs btn-primary" href="{{route('users.show',$usr->id)}}">
                             <i class="fa fa-eye"></i>
                        </a> -->
                   
                        <a class="btn btn-xs  btn-info" href="{{route('users.edit',$usr->id)}}">
                             <i class="fa fa-edit"></i>
                        </a>
                       
                        <a href="#mymodal{{$usr->id}}" role="button" class="btn mr-0 mb-0 btn-outline-primary btn-xs" data-toggle="modal"><i class="fa fa-trash"></i></a>
                        <!-- <a href="#mymodal" role="button" class="btn" data-toggle="modal">Launch demo modal</a>
                        <form action="" method="POST" onsubmit="return confirm('Are You Sure To permanently Delete?');" style="display: inline-block;">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-xs btn-danger"  value="Delete"> 
                        </form> -->
                    
                    </td>
                  </tr>
                <div class="modal fade" id="mymodal{{$usr->id}}">
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
                        <form action="{{ route('users.destroy', $usr->id) }}" method="POST">
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
                    <th>Type</th>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Organisation</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Last Login</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
      
        <!-- /.card -->

        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  
  <!-- /.content-wrapper -->
  @include('admin.layout.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>

<!-- ./wrapper -->
@include('admin.layout.scripts')
@section('scripts')

@endsection
</body>
</html>
