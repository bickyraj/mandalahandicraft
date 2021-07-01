@extends('admin.layouts.app')

@section('title', 'Home')

@section('content')

  <div class="row">
   <!--  <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-header"
             data-background-color="orange">
          <i class="material-icons">person</i>
        </div>
        <div class="card-content">
          <p class="category">Vendors</p>
          <h3 class="card-title">0</h3>
        </div>
        <div class="card-footer">
          <div class="stats">
            <i class="material-icons">date_range</i>
            From the beginning
          </div>
        </div>
      </div>
    </div> -->
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-header"
             data-background-color="rose">
         <!--  <i class="material-icons">nfc</i> -->
         Total Products
        </div>
        <div class="card-content">
          <p class="category"></p>
          <h3 class="card-title">{{number_format($total_products)}}</h3>
        </div>
        <div class="card-footer">
          <div class="stats">
            <i class="material-icons">local_offer</i> Till now
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-header"
             data-background-color="orange">
          <!-- <i class="material-icons">shopping_cart</i> -->
          Pending Products
        </div>
        <div class="card-content">
         <!--  <p class="category">Pending Products</p> -->
          <h3 class="card-title">{{number_format($pending_products)}}</h3>
        </div>
        <div class="card-footer">
          <div class="stats">
            <i class="material-icons">date_range</i> Last 24 Hours
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-header"
             data-background-color="blue">
       <!--    <i class="material-icons">shopping_cart</i> -->
       Processing Products
        </div>
        <div class="card-content">
          <!-- <p class="category">Processing Products</p> -->
          <h3 class="card-title">{{number_format($processing_products)}}</h3>
        </div>
        <div class="card-footer">
          <div class="stats">
            <i class="material-icons">date_range</i> Last 24 Hours
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-header"
             data-background-color="green">
          <!-- <i class="material-icons">shopping_cart</i> -->
          Delivered Products
        </div>
        <div class="card-content">
         <!--  <p class="category">Delivered Products</p> -->
          <h3 class="card-title">{{number_format($delivered_products)}}</h3>
        </div>
        <div class="card-footer">
          <div class="stats">
            <i class="material-icons">date_range</i> Last 24 Hours
          </div>
        </div>
      </div>
    </div>
    <!-- <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-header"
             data-background-color="blue">
          <i class="material-icons">people_outline</i>
        </div>
        <div class="card-content">
          <p class="category">Delivered Orders</p>
          <h3 class="card-title">0</h3>
        </div>
        <div class="card-footer">
          <div class="stats">
            <i class="material-icons">update</i> Just Updated
          </div>
        </div>
      </div>
    </div> -->
  </div>


  @if(auth()->user()->hasRole('admin'))

 <!--  <div class="card">
    <form class="card-content"
          id="change-conversion-rate">
      <label for="conversion-rate">Conversion Rate</label>
      <div class="form-group">
        $1 = NRs.
        <input type="text"
               class=""
               id="conversion-rate"
               name="conversion_rate"
               value="{{ $company->conversion_rate }}"/>
        <button class="btn btn-xs btn-success"
                type="submit">Save
        </button>
      </div>
    </form>
  </div> -->
  @endif

@endsection

@push('script')
  <script>
    $(document).ready(function () {
      $('#change-conversion-rate').on('submit', function (event) {
        event.preventDefault();

        $.ajax({
          url: '{{ route('change-rate') }}',
          data: $(this).serialize(),
          success: function () {
            showSuccessMessage('Rate changed to ' + $('#conversion-rate').val());
          }
        })
      })
    })
  </script>
@endpush