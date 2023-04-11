@extends('layout.frontend')
@section('content')
        <main class="main">
        	<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        		<div class="container">
        			<h1 class="page-title">Brand</h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a>Home</a></li>
                        <li class="breadcrumb-item"><a>Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Brand</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
                <div class="container">
                	<div class="row">
                		<div class="col-lg-9">
                            <div class="products mb-3">
								<div id="products-container"></div>
                            </div><!-- End .products -->

                		</div><!-- End .col-lg-9 -->
                		<aside class="col-lg-3 order-lg-first">
                			<div class="sidebar sidebar-shop">
                		    	<div class="widget widget-collapsible">
    								<h3 class="widget-title">
									    <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
									        Brand
									    </a>
									</h3><!-- End .widget-title -->

									<div class="collapse show" id="widget-1">
										<div class="widget-body">
											<div class="filter-items filter-items-count">
												@foreach($brands as $brand)
												<div class="filter-item">
													<div class="custom-control">
                                                        <input class="form-check-input" type="radio" name="brand" id="flexRadioDefault1" style="margin-top: 6px;" value="{{$brand->id}}">
                                                        <label style="margin-left: 5px;" class="form-check-label" for="flexRadioDefault1">{{$brand->name}}</label>
													</div><!-- End .custom-checkbox -->
												</div><!-- End .filter-item -->
												@endforeach
											</div><!-- End .filter-items -->
										</div><!-- End .widget-body -->
									</div><!-- End .collapse -->
        						</div><!-- End .widget -->
                			</div><!-- End .sidebar sidebar-shop -->
                		</aside><!-- End .col-lg-3 -->
                	</div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->
		@section('script')
		<script>
			$('input[name="brand"]').change(function() {
  				var brand_id = $(this).val();
  				
				  $.ajax({
                	url: "{{URL::route('pharmacy.front.shop.filterbyBrand')}}",
                	method: "GET",
					data: { 
						brand: brand_id
					},
					success: function(data) {
						$('#products-container').html(data);
					}
            	});
			});
		</script>
		@endsection
@endsection