<div class="row justify-content-center">
@foreach($products as $product)
    <div class="col-6 col-md-4 col-lg-4 col-xl-3">
        <div class="product product-7 text-center">
            <figure class="product-media">
                <span class="product-label label-new">New</span>
                <a>
                    <img src="{{asset('product/'.$product->image)}}" alt="Product image" class="product-image">
                </a>

                <div class="product-action">
                    <a href="{{route('pharmacy.front.product.detail',$product->id)}}" class="btn-product btn-cart"><span>View Product</span></a>
                </div><!-- End .product-action -->
            </figure><!-- End .product-media -->

            <div class="product-body">
                <h3 class="product-title" id="title"><a>{{$product->product_name}}</a></h3><!-- End .product-title -->
                <div class="product-price">
                    Rs.{{$product->mrp}}
                </div><!-- End .product-price -->
            </div><!-- End .product-body -->
        </div><!-- End .product -->
    </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->
@endforeach
</div>