@extends('nav');
@section('category')

  <section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          All Catagories Available
        </h2>
      </div>
      <div class="row">

        @foreach ($products as $item)
             <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
            <a href="{{ route("productsbycategory" , $item->id) }}">
              <div class="img-box">
                {{-- <img src="frontend/images/p1.png" alt=""> --}}
                <img src="{{asset('storage/categoryimage/'.$item->image)}}" alt="">
              </div>
              <div class="detail-box">
                <h6>
                 {{$item->name }}
                </h6>
                {{-- <h6>
                  Price
                  <span>
                  {{ $item->price }}
                  </span>
                </h6> --}}
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
  </section>

  <!-- end shop section -->
@endsection



