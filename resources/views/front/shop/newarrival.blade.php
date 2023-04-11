@extends('layout.frontend')
@section('content')
        <main class="main">
        	<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        		<div class="container">
        			<h1 class="page-title"><span>Shop</span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a>Home</a></li>
                        <li class="breadcrumb-item"><a>Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">New Arrival</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
                <div class="container">
                	<div class="row">
                		<div class="col-lg-12">
                            <div class="products mb-3">
                                <div class="row justify-content-center">
                                    @foreach($products as $product)
                                    <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                                        <div class="product product-7 text-center">
                                            <figure class="product-media">
                                                @if($product->is_topselling == "yes")
                                                <span class="product-label label-new">New</span>
                                                @endif
                                                <a>
                                                    <img src="{{asset('product/'.$product->image)}}" alt="Product image" class="product-image">
                                                </a>

                                                <div class="product-action">
                                                    <a href="{{route('pharmacy.front.product.detail',$product->id)}}" class="btn-product btn-cart"><span>View Product</span></a>
                                                </div><!-- End .product-action -->
                                            </figure><!-- End .product-media -->

                                            <div class="product-body">
                                                <h3 class="product-title"><a>{{$product->product_name}}</a></h3><!-- End .product-title -->
                                                <div class="product-price">
                                                    Rs.{{$product->mrp}}
                                                </div><!-- End .product-price -->
                                            </div><!-- End .product-body -->
                                        </div><!-- End .product -->
                                    </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->
                                    @endforeach
                                </div><!-- End .row -->
                            </div><!-- End .products -->
                		</div><!-- End .col-lg-9 -->
                	</div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->
@endsection