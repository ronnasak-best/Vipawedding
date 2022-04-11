@extends('frontend.layouts.master')
@section('title','PRODUCT')
@section('content')
<section class="ftco-section">
        @foreach ($products->chunk(3) as $chunk)
    		<div class="row">
          @foreach($chunk as $product)
    			<div class="col-sm-4 ">
    				<div class="product">
    					<a href="{{url('/product-detail',$product->id)}}" class="img-prod"><img class="img-fluid" src="{{url('/')}}/products/{{$product->image}}" alt="Colorlib Template"></a>
    					<div class="text py-3 px-3">
                	<hr>
    						<h3>{{$product->p_name}}</h3>
    						<div class="d-flex">
    							<div class="pricing">
		    						<p class="price"><span>฿ {{$product->price}}</span></p>
		    					</div>
	    					</div>
    					</div>
    				</div>
    			</div>
          @endforeach
    		</div>
        @endforeach
        <div class="pagination justify-content-center">
        {{ $products->links() }}
      </div>

<section>


@endsection
