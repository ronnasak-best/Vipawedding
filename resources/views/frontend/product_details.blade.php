@extends('frontend.layouts.master')
@section('title','List Categories')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-6 ">
            <div class="container text-center justify-content-center">
                <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                    <a href="{{url('/')}}/products/{{$detail_product['image']}}">
                        <img src="{{url('/')}}/products/{{$detail_product['image']}}" alt="" width="300" height="450" />
                    </a>
                </div>

                <ul class="thumbnails" style="margin-left: -10px; list-style-type: none;">
                    <li>
                        @foreach($imagesGalleries as $imagesGallery)
                        <a href="{{url('/')}}/products/{{$imagesGallery['image']}}"
                            data-standard="{{url('/')}}/products/{{$imagesGallery['image']}}">
                            <img src="{{url('/')}}/products/{{$imagesGallery['image']}}" alt="" width="75"
                                style="padding: 8px;" />
                        </a>
                        @endforeach
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-6 product-details pl-md-5 ftco-animate">
            <form action="{{ route('cart.store') }}" method="post" role="form">
                {{csrf_field()}}


                <input type="hidden" name="product_id" value="{{$detail_product['id']}}">
                <input type="hidden" name="product_name" value="{{$detail_product['p_name']}}">
                <input type="hidden" name="product_code" value="{{$detail_product['p_code']}}">
                <input type="hidden" name="product_color" value="{{$detail_product['p_color']}}">
                <input type="hidden" name="price" value="{{$detail_product['price']}}">
                <input type="hidden" name="product_image" value="{{$detail_product['image']}}">
                <div class="product-information">
                    <!--/product-information-->
                    <h2>{{$detail_product['p_name']}}</h2>
                    <p>Code ID: {{$detail_product['p_code']}}</p>
                    <h3>{{$detail_product['price']}} ฿</h3>
                    <br>

                    <div class="from-group labels row">
                        <label class="col-sm-3 col-form-label">Size :</label>
                        <select class="custom-select col-sm-6 pl-0" name="size" id="idSize">
                            <option value="">Select Size</option>
                            @foreach($detail_product->attributes as $attrs)
                            <option value="{{$detail_product['id']}}-{{$attrs['size']}}">{{$attrs['size']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Button trigger modal -->
                    <div class="size float-right col-sm-5">
                        <a2 data-toggle="modal" data-target="#exampleModal">
                            - size -
                        </a2>

                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img src="{{ asset('/images/img_size.jpg') }}" style="width: 100%; height:100%"
                                        alt="">
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- END Modal -->
                    <br>
                    <br>


                    <input class="btn" type="submit" name="" value="Add to cart">
                    <br>
                    <div class="mt-4">
                        <p>ABOUT: </p>
                        {!!$detail_product['description']!!}
                    </div>


            </form>
        </div>
    </div>
</div>
@endsection
