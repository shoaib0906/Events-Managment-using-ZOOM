@extends('client.layout.client')
@section('content')
<style type="text/css">
iframe{
  width: 100vw
  height: calc(100vw/1.77);
}
</style>

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
      
      <center>
          
          {!! isset($auditorium) ? $auditorium->link : ''  !!}
        </center>
      <!-- <div class="container">
        <div class="row justify-content-center">
          <div class="col-auto">
            <a class="resource-link" href="#">Pre-read 1</a>
          </div>
          <div class="col-auto">
            <a class="resource-link" href="#">Pre-read 2</a>
          </div>
        </div>
        <div class="row  justify-content-center">
          <div class="col-auto">
            <a class="resource-link" href="#">On-demand Lectures 1</a>
          </div>
          <div class="col-auto">
            <a class="resource-link" href="#">On-demand Lectures 2</a>
          </div>
        </div>
      </div> -->
    </main>
  </div>      
          
  
@endsection
@section('scripts')
 <script>
      // 2. This code loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/".env('IFRAME_API');
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
          height: '590',
          width: '840',
          videoId: 'M7lc1UVf-VE',
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });
      }

      // 4. The API will call this function when the video player is ready.
      function onPlayerReady(event) {
        event.target.playVideo();
      }

      // 5. The API calls this function when the player's state changes.
      //    The function indicates that when playing a video (state=1),
      //    the player should play for six seconds and then stop.
      var done = false;
      function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
          setTimeout(stopVideo, 6000);
          done = true;
        }
      }
      function stopVideo() {
        player.stopVideo();
      }
    </script>

<script>
      $('tr[data-href]').on("click", function() {
          document.location = $(this).data('href');
      });
    </script>

@endsection