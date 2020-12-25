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
              <li class="breadcrumb-item active">User Creation</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
          <form action="{{ route("users.update", [$user->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
          @csrf
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>User Type</label>
                  <select name="type" class="form-control select2" style="width: 100%;">
                    <option {!! '0' == $user->user_type ? "selected='selected'" : "" !!} value="0">Admin</option>
                    <option {!! '1' == $user->user_type ? "selected='selected'" : "" !!} value="1"> User</option>
                  </select>
                  @if ($errors->has('type'))
                      <span class="text-danger">{{ $errors->first('type') }}</span>
                  @endif
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Full Name</label>
                  <input type="text" name="name" value="{{ old('name', isset($user) ? $user->name : '') }}" class="form-control" placeholder="Enter Full Name" required>
                  @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                  @endif
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" value="{{ old('email', isset($user) ? $user->email : '') }}" autocomplete="off" class="form-control" placeholder="Enter E-mail Address" readonly>
                  @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                  @endif
                </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Organisation Name</label>
                  <input type="text" name="organisation"  value="{{ old('organisation', isset($user) ? $user->organisation : '') }}" class="form-control" placeholder="Enter Organisation Name" required>
                  @if ($errors->has('organisation'))
                        <span class="text-danger">{{ $errors->first('organisation') }}</span>
                  @endif
                </div>
              </div>
            </div>
            
            <div class="">
                <div class="form-group " style="text-align: right;">
                  <button type="submit" class="btn btn-success pull-right">  Save new user</button>
                </div>
              </div>
           
            </div>
            </form>
          </div>
          
        </div>
        
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
<script>
  $('#deleteUserForm').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  $('#deleteUserForm').attr('action', '/user/' + button.data('user-id'));
});
</script>
@endsection
</body>
</html>
