@extends('admin.layout.master')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Resource Creation</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item active">Resource Create</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <!-- Main content -->
    <section class="content">
      @extends('admin.layout.notify')
      <div class="card card-default">
          <form action="{{route('agenda.store')}}" method="POST">
            
          @csrf
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Agenda Topic</label>
                  <input type="text" name="topic" class="form-control" value="{{ old('topic', isset($agenda) ? $agenda->topic : '') }}" placeholder="Enter Agenda Topics" required>
                  @if ($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                  @endif
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <div class="form-group">
                  <label>links</label>
                  <input type="link" name="link" value="{{ old('link', isset($agenda) ? $agenda->link : '') }}" autocomplete="off" class="form-control" placeholder="Enter link of agenda" required>
                  @if ($errors->has('agenda'))
                        <span class="text-danger">{{ $errors->first('agenda') }}</span>
                  @endif
                </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Start Time (24h)</label>
                  <div class="">
                    
                    <input type="text" class="form-control" id="time24" name="start_time" data-inputmask-alias="datetime" value="{{ old('start_time', isset($agenda) ? $agenda->start_time : '') }}"  data-inputmask-inputformat="HH:MM" data-inputmask-placeholder="hh:mm">
                  </div>
                </div>

              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Stop Time (24h)</label>
                  <div class="">
                    
                    <input type="text" class="form-control" id="time24" name="stop_time" data-inputmask-alias="datetime" value="{{ old('stop_time', isset($agenda) ? $agenda->stop_time : '') }}"  data-inputmask-inputformat="HH:MM" data-inputmask-placeholder="hh:mm">
                  </div>
                </div>
                
              </div>
              
            </div>
            
            <div class="">
                <div class="form-group " style="text-align: right;">
                  <button type="submit" class="btn btn-success pull-right">  Save new Agenda</button>
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