@extends('admin.layout.master')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Meeting Creation</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item active">Meeting Create</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <!-- Main content -->
    <section class="content">

      <div class="card card-default">

          <form action="{{route('meeting.store')}}" method="POST">
            
          @csrf
          <!-- /.card-header -->
          <div class="card-body">

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Meeting Topic</label>
                  <input type="text" name="topics" class="form-control" value="{{ old('topics', isset($meeting) ? $meeting->topics : '') }}" placeholder="Enter Meeting Topics" required>
                  @if ($errors->has('topics'))
                        <span class="text-danger">{{ $errors->first('topics') }}</span>
                  @endif
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Agenda</label>
                  <input type="text" name="agenda" class="form-control" value="{{ old('agenda', isset($meeting) ? $meeting->agenda : '') }}" placeholder="Enter Meeting agenda" required>
                  @if ($errors->has('agenda'))
                        <span class="text-danger">{{ $errors->first('agenda') }}</span>
                  @endif
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
               <div class="form-group">
              <label>Start Date-time</label>
              <input type="datetime-local" class="form-control" id="meeting-time"
               name="start_time" value="{{date('Y-m-d\Th:i',time())}}"
               min="2020-06-07T00:00" max="2022-06-14T00:00">
              </div>
              </div>
              <div class="col-md-6">
               <div class="form-group">
              <label>Duration (in Minutes)</label>
              <input type="number" class="form-control" 
               name="duration" value="{{ old('duration', isset($meeting) ? $meeting->duration : '') }}" placeholder="Enter Meeting duration(minutes)" required>
               
              </div>
              </div>
            </div>
            
            <div class="">
                <div class="form-group " style="text-align: right;">
                  <button type="submit" class="btn btn-success pull-right">  Save New Meeting</button>
                </div>
              </div>
           
            </div>
          </div>
          </form>
        </div>
        
    </section>
    <!-- /.content -->
  </div>
@endsection
@section('scripts')
<script type="text/javascript">
  $('input').inputmask();
</script>
@endsection