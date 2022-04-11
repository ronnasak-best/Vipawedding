
<div class="flex-center position-ref full-height col-12">
  <!-- Right Side Of Navbar -->
  <ul class="top-right links">
       <!-- Authentication Links -->
       @if(Auth::check() && Auth::user()->is_admin == 1)
       <a href="{{ route('admin.home') }}" >admin panel
       </a>
       @endif

       <a href="{{ route('cart.index') }}" >Cart
         @if (Cart::instance('default')->count() > 0)
         <span class="cart-count"><span>({{ Cart::instance('default')->count() }})</span></span>
         @endif
       </a>


       @guest
           <a href="{{ route('login') }}">{{ __('Login') }}</a>
       @if (Route::has('register'))
           <a href="{{ route('register') }}">{{ __('Register') }}</a>
       @endif
       @else
           <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
               {{ Auth::user()->name }} <span class="caret"></span>
           </a>
            <div class="dropdown-menu links " aria-labelledby="navbarDropdown">

                <a id="a1" class="dropdown-item likns " href="{{route('myaccount.index')}}">my account</a>
                <a id="a1" class="dropdown-item likns" href="{{ route('orders.index') }}">my orders</a>
                <div class="dropdown-divider"></div>
                <a id="a1"class="dropdown-item likns" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                       {{ __('Logout') }}
               </a>
               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                 @csrf
               </form>
          </div>

               @endguest
  </ul>
  <?php
    $categories =DB::table('categories')->where([['status',1],['parent_id',0]])->get();

  ?>
  <div class="content ">
      <div class="title m-b-mb-5">
          <img src="{{ asset('/images/4132.jpg') }}"width="500" height="200">
      </div>
      <nav class="navbar  navbar-expand-lg navbar-light navbar-hover links">
        <div class="collapse navbar-collapse " id="navbarHover">
          <ul class="navbar-nav mr-auto ">
              <li class="nav-item pr-5  links">
              <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
              </li>


            <li class="nav-item pr-5 dropdown links">
              <a class="nav-link dropdown-toggle" href="{{route('product')}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Collection
              </a>
              <ul class="dropdown-menu links ">
                @foreach($categories as $category)
                <?php
                $sub_categories=DB::table('categories')->select('id','name')->where([['parent_id',$category->id],['status',1]])->get();
                $i=1;
                ?>
                @if(count($sub_categories)>0)
            	  <li><a class="dropdown-item links" href="{{ route('cats',[ $category->id,1]) }}"> {{$category->name}} &#9656; </a>
                @else
                <li><a class="dropdown-item links" href="{{ route('cats',[$category->id,0]) }}"> {{$category->name}} </a>
                @endif
                   @if(count($sub_categories)>0)
                   <ul class="submenu dropdown-menu links">
                     @foreach($sub_categories as $sub_category)
              		    <li><a class="dropdown-item links" href="{{ route('cats',[$sub_category->id,0]) }}"> {{$sub_category->name}} </a></li>
              		    @endforeach
              		 </ul>
                   @endif
            	  </li>
                @endforeach
              </ul>
            </li>

            <li class="nav-item pr-5 links">
              <a class="nav-link " href="{{ url('/howitwork') }}" tabindex="-1" aria-disabled="true">How it Works</a>
            </li>
            <li class="nav-item  links">
              <a class="nav-link " href="{{ url('/about') }}" tabindex="-1" aria-disabled="true">about</a>
            </li>

          </ul>
      </nav>
      <hr style="border-top: 2px solid #eee;">
</div>
</div>
