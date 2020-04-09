<!-- Core -->
<script src="{{ asset('template/argon') }}/assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="{{ asset('template/argon') }}/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('template/argon') }}/assets/vendor/js-cookie/js.cookie.js"></script>
<script src="{{ asset('template/argon') }}/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="{{ asset('template/argon') }}/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<!-- Optional JS -->
<script src="{{ asset('template/argon') }}/assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('template/argon') }}/assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('template/argon') }}/assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('template/argon') }}/assets/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('template/argon') }}/assets/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('template/argon') }}/assets/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="{{ asset('template/argon') }}/assets/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('template/argon') }}/assets/vendor/datatables.net-select/js/dataTables.select.min.js"></script>
  <script src="{{ asset('template/argon') }}/assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
  <script src="{{ asset('template/argon') }}/assets/vendor/bootstrap-notify/bootstrap-notify.min.js"></script>
<!-- Argon JS -->
<script src="{{ asset('template/argon') }}/assets/js/argon.js?v=1.1.0"></script>

<script type="text/javascript">
    function sendFile(file, editor, uploadUrl) {
      
      data = new FormData();
      data.append("file", file);
      data.append("_token", $('meta[name="csrf-token"]').attr('content'));
      $.ajax({
          data: data,
          type: "POST",
          url: uploadUrl,
          cache: false,
          beforeSend: function() {
            ajax_start();
          },
          dataType: 'json',
          contentType: false,
          processData: false,
          success: function(url) {
            var image = $('<img>').attr('src',url.url);
            editor.summernote("insertNode", image[0]);
          },
          complete: function(){
            ajax_stop();
          }
      });
    }


    ajax_running = false;
    function ajax_start() {
      ajax_running = true;
    }
    function ajax_stop() {
      ajax_running = false;
    }
    function slugify(text)
    {
      return text.toString().toLowerCase()
        .replace(/\s+/g, '-')           // Replace spaces with -
        .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
        .replace(/\-\-+/g, '-')         // Replace multiple - with single -
        .replace(/^-+/, '')             // Trim - from start of text
        .replace(/-+$/, '');            // Trim - from end of text
    }
</script>

@section('script')
@show