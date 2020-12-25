@extends('client.layout.client')
@section('content')
<video autoplay muted loop>
    <source src="{{asset('assets/bg.mp4')}}" type="video/mp4">
  </video>
  

          @include('client.layout.menu')
          
      
@endsection