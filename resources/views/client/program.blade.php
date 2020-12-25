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
    <main role="main" class="inner container h-100 position-relative">
      <div class="program-table d-flex justify-content-center align-items-center">
        <table class="table table-hover">
          <thead class="thead-light">
            <tr>
              
              <th scope="col">Time (Hours)</th>
              <th scope="col">Topic</th>

            </tr>
          </thead>
          <tbody>
            @foreach($agenda as $agnda)
            <tr data-href="{{$agnda->link}}" target="_blank">
              <td>{{$agnda->start_time}} - {{$agnda->stop_time}}</td>
              <td><a href="{{$agnda->link}}" target="_blank" style="color: black; ">{{$agnda->topic}}</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </main>
  </div>      
          
  
@endsection

@section('scripts')
 
<script>
      $('tr[data-href]').on("click", function() {
          document.location = $(this).data('href');
      });
    </script>

@endsection