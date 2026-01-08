@extends('nav');
@section('product_detail_by_category')

  <section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          All {{ $category}}
        </h2>
      </div>
      <div class="row">

        @foreach ($products as $item)
             <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
            <a href="{{ route("productDetail" , $item->id) }}">
              <div class="img-box">
                {{-- <img src="frontend/images/p1.png" alt=""> --}}
                <img src="{{asset('storage/productimage/'.$item->image)}}" alt="">
              </div>
              <div class="detail-box">
                <h6>
                 {{$item->name }}
                </h6>
                <h6>
                  Price
                  <span>
                  {{ $item->price }}
                  </span>
                </h6>
              </div>
              {{-- <div class="new">
                <span>
                  New
                </span>
              </div> --}}
            </a>
          </div>
        </div>
        @endforeach


      </div>
      <div class="btn-box">
        <a href="{{ route('index') }}">
          View latest Products
        </a>
      </div>
    </div>
  </section>

  <!-- end shop section -->


@endsection
