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
          <button data-product="{{ $product->name }}" data-description='{!! $product->detail !!}' data-price_idr="{{ number_format($product->price_idr) }}" data-price_dollar="{{ number_format($product->price_dollar) }}" type="button" class="btn btn-primary mb-3 btn-buy">Buy</button>
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


<script type="x-tmpl-mustache" id="template">
  <div class="shopping-cart">
    <div class="column-labels">
      <label class="product-details">Product</label>
      <label class="product-price">Price</label>
      <label class="product-line-price">Total</label>
    </div>
   
    <div class="product">
      <div class="product-details">
        <div class="product-title">@{{ product }}</div>
        <p class="product-description">@{{{ description }}}</p>
      </div>
      <div class="product-price">@{{ price_dollar }} / Rp.@{{ price_idr }}</div>
      <div class="product-line-price">@{{ price_dollar }}  / Rp.@{{ price_idr }}</div>
    </div>
   
    <div class="totals">
      <div class="totals-item totals-item-total">
        <label>Grand Total</label>
        <div class="totals-value" id="cart-total">@{{ price_dollar }}  / Rp.@{{ price_idr }}</div>
      </div>
    </div>  
    <button class="btn btn-primary pull-right checkout">Checkout</button>
    <div class="mt-3">
      <div class="text-muted" style="font-size: 1em">BCA - 0123456789 (Lorem Ipsum)</div>
      <div class="text-muted" style="font-size: 1em">BCA - 0123456789 (Lorem Ipsum)</div>
      <div class="text-muted" style="font-size: 1em">BCA - 0123456789 (Lorem Ipsum)</div>
    </div>
  </div>
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('.btn-buy').on('click', function(){
      var template = $('#template').html();

      var product = $(this).data('product');
      var description = $(this).data('description');
      var price_dollar = $(this).data('price_dollar');
      var price_idr = $(this).data('price_idr');

      var data = {
        product : product,
        description : description,
        price_dollar : price_dollar,
        price_idr : price_idr,
      };

      htmlBody = Mustache.render(template, data);

      $('#confirmation').html(htmlBody);

      $('#modal-default').modal('show');
    });
  });
</script>
@stop