@extends('admin.layout.master')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Live Streaming</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item active">Auditorium</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <div class="modal fade" id="mymodal">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Alter Iframe Code(Embedded Code)</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="">
                            <form action="{{route('auditorium.store')}}" method="POST">
                              
                            @csrf
                            <!-- /.card-header -->
                            <div class="card-body">
                              
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <div class="form-group">
                                    
                                    <textarea type="link" name="link" autocomplete="off" class="form-control" placeholder="" rows="8" cols="5" required>{{ isset($auditorium) ? $auditorium->link : '' }}</textarea>
                                    @if ($errors->has('link'))
                                          <span class="text-danger">{{ $errors->first('link') }}</span>
                                    @endif
                                  </div>
                                  </div>
                                </div>
                                
                              </div>
                              
                              <div class="">
                                  <div class="form-group " style="text-align: right;">
                                    <button type="submit" class="btn btn-success pull-right">  Set New Auditorium</button>
                                    
                          </button>
                                  </div>
                                </div>
                             
                              </div>
                              </form>
                            </div>
                        </div>
                        
                      </div>
                      
                    </div>
                    
                  </div>
    <!-- Main content -->
    <section class="content">
        @extends('admin.layout.notify')
      

        <center>
          <a href="#mymodal" role="button" class="btn btn-success btn-xs" data-toggle="modal"><i class="fa fa-plus"></i> Set New Auditorium</a><br><br>
          
          {!! isset($auditorium) ? $auditorium->link : ''  !!}
        </center>
        </div>
        
    </section>

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
   
    <!-- /.content -->
  </div>
@endsection