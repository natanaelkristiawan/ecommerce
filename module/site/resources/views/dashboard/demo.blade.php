@extends('theme.public.layouts.blank')

@section('content')
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">{!! Meta::get('title') !!}</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
          {{ Breadcrumbs::render('demo') }}
          </nav>
        </div>
        <div class="col-lg-6 text-lg-right">
          <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-filter">  Tutorial Buy & Checkout  </button>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid mt--6">
  <!-- Table -->
  <div class="row">
    <div class="col-lg-3">
      <div class="card">
        <div class="card-header">
          <h3 class="mb-0">Demo Playlist</h3>
        </div>
        <div class="card-body">
          <div class="row" style="max-height: 65vh; overflow-y: auto;">
            @foreach($data as $list)
            <div class="col-12 mb-3">
              <button data-youtube="{{ $list->youtube }}" class="play-youtube btn btn-sm btn-default btn-block">{{ $list->name }}</button>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>


    <div class="col-lg-9">
      <div class="card">
        <!-- Card body -->
        <div class="card-header">
          <h3 class="mb-0">Video</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div id="player" style="min-height: 65vh"></div>
            </div>
          </div>
        </div>
      </div>
    </div>



  <!-- Footer -->
  </div>
  @include('theme.admin.partials.copyright')
</div>
@stop


@section('script')
@parent
<div class="modal fade" id="modal-filter" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modal-filter" aria-hidden="true">
  <div id="dialog-privacy" class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header pb-0">
        <h3>Tutorial Buy & Checkout</h3>
      </div>
      <div class="modal-body pt-0" id="modal-data">
        <p>➤ Pilih product yang ingin dibeli</p> 
        <p>➤ Check apakah sudah benar productnya</p> 
        <p>➤ Click checkout dan Transfer sesuai data payment methods tersebut</p>
        <p>➤ Jika sudah Transfer click ke Pending Order dan lakukan upload Screenshot Transfer</p>
        <p>➤ Tunggu admin mengkonfirmasi pembayaran anda</p>
        <br><strong>Regards RG43S Admin ❤</strong></br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript" src="https://www.youtube.com/iframe_api"></script>


<script type="text/javascript">
var player;



function renderFirst(videoID) {
  player = new YT.Player('player', {
    height: '100%',
    width: '100%',
    videoId : videoID,
    events: {
      'onReady': onPlayerReady,
    },
    playerVars: {rel: 0},
  });
}


function onPlayerReady(event) {
  event.target.playVideo();
}

function playerLoadById(videoID) {

  if (typeof player == 'undefined') {
    renderFirst(videoID);
    return;
  }

  player.loadVideoById(videoID);
}

$(document).on('click', '.play-youtube', function(){
  var videoID = $(this).data('youtube');
  playerLoadById(videoID);
});

</script>
@stop