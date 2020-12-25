@extends('admin.layout.master')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Announcement Creation</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item active">Announcement Create</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <!-- Main content -->
    <section class="content">
      @extends('admin.layout.notify')
      <div class="card card-default">
          <form action="{{route('announce.store')}}" method="POST">
            
          @csrf
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Short Title</label>
                  <input type="text" name="title" class="form-control" value="{{ old('title', isset($announce) ? $announce->title : '') }}" placeholder="Enter short title of Announcement" required>
                  @if ($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                  @endif
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <div class="form-group">
                  <label>Description</label>
                  <input type="text" name="desc" value="{{ old('desc', isset($announce) ? $announce->desc : '') }}" autocomplete="off" class="form-control" placeholder="Enter description of Announcement" required>
                  @if ($errors->has('desc'))
                        <span class="text-danger">{{ $errors->first('desc') }}</span>
                  @endif
                </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Date:</label>
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="text" name="date"  value="{{ old('date', isset($agenda) ? $agenda->date : '') }}" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Time (24h)</label>
                  <div class="">
                    
                    <input type="text" class="form-control" id="time24" name="start_time" data-inputmask-alias="datetime" value="{{ old('start_time', isset($agenda) ? $agenda->start_time : '') }}"  data-inputmask-inputformat="HH:MM" data-inputmask-placeholder="hh:mm">
                  </div>
                </div>
                
              </div>
              
            </div>
            
            <div class="">
                <div class="form-group " style="text-align: right;">
                  <button type="submit" class="btn btn-success pull-right">  Save new Announcement</button>
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