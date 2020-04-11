<!-- Core -->
<script src="{{ asset('template/argon') }}/assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="{{ asset('template/argon') }}/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('template/argon') }}/assets/vendor/js-cookie/js.cookie.js"></script>
<script src="{{ asset('template/argon') }}/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="{{ asset('template/argon') }}/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<!-- Optional JS -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/3.0.1/mustache.min.js"></script>
<script src="{{ asset('template/argon') }}/additionals/chosen/chosen.js"></script>
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
<script src="{{ asset('template/argon') }}/additionals/switchery/switchery.js"></script>
<script src="{{ asset('template/argon') }}/additionals/sortable/Sortable.min.js"></script>
<script src="{{ asset('template/argon') }}/additionals/sortable/jquery-sortable.js"></script>
<script src="{{ asset('template/argon') }}/additionals/dropzone/dropzone.min.js"></script>
<script src="{{ asset('template/argon') }}/additionals/toastr/toastr.min.js"></script>
<script src="{{ asset('template/argon') }}/additionals/summernote/summernote-bs4.js"></script>

<script src="{{ asset('template/argon') }}/additionals/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
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
  $(window).on('load', function(){

    $('.chosen-select').chosen({width: "100%"}).change(function(event, info) {


      if (info.selected) {
        var allSelected = this.querySelectorAll('option[selected]');
        var lastSelected = allSelected[allSelected.length - 1];
        var selected = this.querySelector(`option[value="${info.selected}"]`);
        selected.setAttribute('selected', '');

        if (typeof lastSelected !== "undefined") {
          lastSelected.insertAdjacentElement('afterEnd', selected);
        }
      } else { // info.deselected
        var removed = this.querySelector(`option[value="${info.deselected}"]`);
        removed.setAttribute('selected', false); // this step is required for Edge
        removed.removeAttribute('selected');
      }
      $(this).trigger("chosen:updated");
    });
    $('.tagsinput').tagsinput({
      tagClass: 'btn btn-sm pr-4 mb-2 btn-primary'
    });


    $('.bootstrap-tagsinput input').keydown(function( event ) {
      if ( event.which == 13 ) {
          $(this).blur();
          $(this).focus();
          return false;
      }
    });
  });


@if(session()->has('status'))
  toastr.success("{{session()->get('status')}}");
@endif


@if(session()->has('status_error'))
  toastr.error("{{session()->get('status_error')}}");
@endif
</script>

@section('script')
@show