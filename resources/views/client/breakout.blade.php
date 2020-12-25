@extends('client.layout.client')
@section('content')


   <div class="cover-container d-flex w-100 h-100 p-0 mx-auto flex-column">
    <header class="masthead mb-auto bg-dark">
      
        <div class="inner">
        <nav class="navbar navbar-expand-lg navbar-dark">
          <div class="home-link">
            <a href="{{url('/')}}" class="btn btn-outline-light">
              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M6.5 10.995V14.5a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5h-4a.5.5 0 0 1-.5-.5V11c0-.25-.25-.5-.5-.5H7c-.25 0-.5.25-.5.495z"/>
                <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
              </svg>
            </a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
            aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          @include('client.layout.nav')
        </nav>
    </header>

    <main role="main" class="inner container h-100 position-relative d-flex justify-content-center align-items-center">
      
      <div class="row justify-content-center bg-dark" style="padding:20px">
        
          @foreach($meetings as $meetings)
          <div class="col-auto col-md-4" >
            <a class="" href="{{$meetings->join_url}}"  target="_blank">
              </a>
              <p style="text-align: left">
                <b style="text-align: left">Meeting ID: {{$meetings->id}}</b><br>
                Topic : {{strtoupper($meetings->topic)}}<br>
                Start Time : {{date('d/m/Y h:i:s',strtotime($meetings->start_time))}}<br>
                Duration : {{$meetings->duration}} Minutes {{$meetings->timezone}}<br>
              </p>
              
            
              <a href="{{$meetings->join_url}}" target="_blank" class="btn btn-xs btn-warning"> Join Now</a>
              <hr>
          </div>
          <br>
          @endforeach
        </div>
          
           
                  

        </div>
    </main>
  </div>      
          
  
@endsection
