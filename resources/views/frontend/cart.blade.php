@extends('frontend.layouts.master')
@section('title','List Categories')
@section('content')
@if (Cart::count() > 0)
<table class="table table-bordered tablecart">
    <thead class="thead-primary">
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th style="text-align: center; vertical-align: middle;">Product</th>
            <th style="text-align: center; vertical-align: middle; ">Price</th>
            <th style="text-align: center; vertical-align: middle;">Qty</th>
            <th style="text-align: center; vertical-align: middle;">Subtotal</th>
        </tr>
    </thead>

    <tbody>
        @foreach(Cart::content() as $row)
        <tr>
            <td>
                <a href="{{ route('cart.destroy', $row->rowId) }}" class="btn btn-inverse-info btn-sm">x</a>
            </td>
            <td style="width:100px;">
                <img src="{{url('/')}}/products/{{$row->options->image}}" style="width: 150px; height:180px"
                    class="rounded">
            </td>
            <td>
                <div class="product-detail" style="text-align: left;">
                    <spam>{{$row->name}}</spam><br>
                    <a>SIZE : {{$row->options->size}}</a><br>               
                </div>

            </td>
            <td style="text-align: center; vertical-align: middle; ">{{$row->price}}</td>
            <td style="text-align: center; vertical-align: middle;">{{$row->qty}}</td>
            <td style="text-align: center; vertical-align: middle;">{{$row->subtotal}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<a type="button" class="btn float-sm-right btn-s" href="{{route('check-out.index')}}" name="button">Continue to
    Checkout</a>
<br><br><br><br>
@else
<div style=" text-align: center; vertical-align: middle;" class="">
    <h3>No items in Cart!</h3>
    <div class="spacer"></div>
    <a href="{{ url('/') }}" class="btn  btn-s">Continue Shopping</a>
    <div class="spacer"></div>
</div>

@endif
@endsection