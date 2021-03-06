@extends('theme.public.layouts.dashboard')

@section('content')
<div class="container-fluid mt--6">
  <div class="row card-wrapper">
      @foreach($products as $product)
    <div class="col-lg-3">

      <!-- Pricing card -->
      <div class="card card-pricing border-0 text-center mb-4">
        <div class="card-header bg-transparent">
          <h4 class="text-uppercase ls-1 text-primary py-3 mb-0">{{ $product->name }}</h4>
        </div>
        <div class="card-body nambah-padding">
          <div class="display-3">${{ number_format($product->price_dollar) }}</div>
          <span class=" text-muted">{{ number_format($product->price_idr) }} IDR</span>
          {!! $product->detail !!}

          @if(in_array($product->id, $productOrder))
             <button style="background-color: grey; border-color: grey" class="btn btn-primary mb-3" disabled="">Buy</button>
          @else
          <button 
            data-unique="{{ mt_rand(0, 1000) }}" 
            data-product="{{ $product->id }}" 
            data-product_name="{{ $product->name }}" 
            data-description='{!! $product->detail !!}' 
            data-price_idr="{{ number_format($product->price_idr) }}" 
            data-price_dollar="{{ number_format($product->price_dollar) }}" 
            data-price_idr-nonformat="{{ $product->price_idr }}"
            data-price_dollar-nonformat="{{ $product->price_dollar }}"
            type="button" 
            class="btn btn-primary mb-3 btn-buy">
            Buy
          </button>
          
          @endif
        </div>
      </div>
    </div>
      @endforeach
  </div>
  <!-- Footer -->
  @include('theme.admin.partials.copyright')
</div>

@stop


@section('script')
@parent
<link href="//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.css" type="text/css" rel="stylesheet" />
<script src="//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>


<script type="text/javascript" src="{{ asset('js') }}/jquery.number.min.js"></script>

<div data-backdrop="static" data-keyboard="false" class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
  <div style="min-height: calc(80vh)" class="modal-dialog modal-lg modal-" role="document">
    <div class="modal-content">
      <div class="modal-header pb-0">
        <h6 class="modal-title" id="modal-title-default">Confirmation Buy Product</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="confirmation">
      </div>

    </div>
  </div>
</div>

<div data-backdrop="static" data-keyboard="false" class="modal fade" id="modal-success" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
  <div style="min-height: calc(50vh)" class="modal-dialog modal-lg modal-" role="document">
    <div class="modal-content">
      <div class="modal-header pb-0">
        <h6 class="modal-title" id="modal-title-default">Notification</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">

      </div>

    </div>
  </div>
</div>

<div class="modal fade show" id="modal-notification" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-modal="true">
  <div  class="modal-dialog modal-danger modal-lg" role="document">
    <div class="modal-content bg-gradient-danger">
      <div class="modal-header">
        <h6 class="modal-title" id="modal-title-notification">Notification</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="py-3 text-center">
          <i class="ni ni-bell-55 ni-3x"></i>
          <h4 class="heading mt-4">Success!</h4>
          {!! Settings::find('notif_ordersuccess') !!}

          <div class="row justify-content-md-center">
          @foreach($accounts as $account)
            <div class="col-lg-3 mt-3">
              <a data-featherlight="image" href="{{url('image/original/'.$account['image'])}}" class="btn btn-primary btn-default btn-block">{{$account['bank']}}</a>
            </div> 
          @endforeach
          </div> 
        </div>
      </div>
      <div class="modal-footer">
        <a href="{{ route('public.orderPending') }}" class="btn btn-white">Pending Order</a>
        <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script type="x-tmpl-mustache" id="template">
  <div class="shopping-cart">
    <div class="column-labels">
      <label class="product-details">Product</label>
      <label class="product-price">Price</label>
      <label class="product-line-price">Total</label>
    </div>
   
    <form action="" id="create-order" method="POST">
      @csrf
      <input type="hidden" name="product_id" value="@{{product}}" />
      <input type="hidden" name="unique_code" value="@{{unique}}" />
      <input type="hidden" name="total" value="@{{total_price_nonformat}}" />
      <div class="product">
        <div class="product-details">
          <div class="product-title">@{{ product_name }}</div>
          <p class="product-description">@{{{ description }}}</p>
        </div>
        <div class="product-price">@{{ price_idr }}</div>
        <div class="product-line-price">@{{ price_idr }}</div>
      </div>
     
      <div class="totals">
        <div class="totals-item totals-item-total">
          <label>Code</label>
          <div class="totals-value" id="cart-total">@{{ unique }}</div>
        </div>
        <div class="totals-item totals-item-total">
          <label>Grand Total</label>
          <div class="totals-value" id="cart-total">@{{ total_price }}</div>
        </div>
      </div>  
      <button type="submit" class="btn btn-primary pull-right btn-checkout checkout">Checkout</button>
    </form>
  </div>
</script>

<script type="text/javascript">

  $(document).on('click', '.btn-checkout', function(e){
    e.preventDefault();
    var data = $('#create-order').serialize();
    $.ajax({
      url: "{{ route('public.orderCreate') }}",
      type: 'POST',
      dataType: 'json',
      data : data,
      beforeSend: function(){
        $('#modal-default').modal('hide');
      },
      success: function(result){
        console.log(result);
        if (result.status == true) {
          $('#modal-notification').modal('show');

        }
      }
    });
  });



  $(document).ready(function() {
    $('.btn-buy').on('click', function(){
      var template = $('#template').html();

      var product = $(this).data('product');
      var product_name = $(this).data('product_name');
      var description = $(this).data('description');
      var price_dollar = $(this).data('price_dollar');
      var price_idr = $(this).data('price_idr');
      var unique = $(this).data('unique');
      var price_idr_nonformat = $(this).data('price_idr-nonformat');
      var price_dollar_nonformat = $(this).data('price_dollar-nonformat');
      var total_price = parseInt(price_idr_nonformat) + parseInt(unique);

      var data = {
        product : product,
        product_name : product_name,
        description : description,
        price_dollar : price_dollar,
        price_idr : price_idr,
        unique : unique,
        price_idr_nonformat: price_idr_nonformat,
        price_dollar_nonformat: price_dollar_nonformat,
        total_price: $.number(total_price),
        total_price_nonformat: total_price,
      };

      htmlBody = Mustache.render(template, data);

      $('#confirmation').html(htmlBody);

      $('#modal-default').modal('show');
    });
  });
</script>
@stop