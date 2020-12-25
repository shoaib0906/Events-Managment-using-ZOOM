@extends('admin.layout.master')
@section('content')
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
              <li class="breadcrumb-item active">Resource Edit</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
          <form action="{{ route("resource.update", [$rsr->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
          @csrf
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Resouce Title</label>
                  <input type="text" name="name" class="form-control" value="{{ old('name', isset($rsr) ? $rsr->name : '') }}" placeholder="Enter Resource title" required>
                  @if ($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                  @endif
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Resource Type</label>
                  <input type="text" name="type" class="form-control" value="{{ old('type', isset($rsr) ? $rsr->type : '') }}" placeholder="Enter Resource Type" required>
                  @if ($errors->has('type'))
                        <span class="text-danger">{{ $errors->first('type') }}</span>
                  @endif
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <div class="form-group">
                  <label>links</label>
                  <input type="link" name="link" value="{{ old('link', isset($rsr) ? $rsr->link : '') }}" autocomplete="off" class="form-control" placeholder="Enter link of resource" required>
                  @if ($errors->has('link'))
                        <span class="text-danger">{{ $errors->first('link') }}</span>
                  @endif
                </div>
                </div>
              </div>
              
            </div>            
            <div class="">
                <div class="form-group " style="text-align: right;">
                  <button type="submit" class="btn btn-success pull-right">  Update Resource</button>
                </div>
              </div>
           
            </div>
            </form>
          </div>
          
        </div>
        
    </section>
    <!-- /.content -->
  </div>
@endsection