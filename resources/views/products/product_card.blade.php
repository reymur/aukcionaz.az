

<div class="col-12">
    <!-- PRODUCT TITLE -->
    <div class="col-12 py-2 mb-2 bg-white border_bottom_opacity-10">
        <div class="col-11 d-flex m-auto">
            <div class="col-6 text-start fw-bold">VIP ELANLAR</div>
            <div class="col-6 text-end">
                <a href="" class="fw-bold">Bütün VIP elanlar</a>
            </div>
        </div>
    </div>

    <!-- PRODUCTS -->
    @if( isset($products) && $products )
        <div class="col-sm-11 col-md-11 col-lg-10 m-auto py-2">
            <div class="row row-cols-2 row-cols-sm-2 row-cols-md-4 row-cols-lg-5 rows-cols-xl-6 g-2">
                @foreach( $products as $product )
                    @if( $product->productable && $product->productable->id )
{{--                        {{ dd( $product->productable->image ) }}--}}
                        <div class="col product-card" id="product-{{ $product->productable->id }}">
                            <div class="card h-100 product__card">
                                <a href="{{ route('product',['id' => $product->productable->id]) }}" class="text-decoration-none">

                                    {{-- ON AUKCION ICON --}}
                                    <div class="product__on_auktion_icon active-aukcion">
                                        @include('products.crumbs.on_aukcion_icon')
                                    </div>

                                    <div class="product__image_div">
                                        @if( $product->productable->image )
                                            <img src="{{ asset('/storage/images/products/'.$product->productable->image->image) }}" class="card-img-top product__image_style" alt="{{ $product->productable->image->image }}">
                                        @endif
                                    </div>

                                    <div class="card-body card__body_style">
                                        <div class="card-title product__price">
                                            {{ $product->productable->price }}
                                        </div>
                                        <h5 class="card-title product__title">
                                            {{ $product->productable->title }}
                                        </h5>
                                   </div>
                                    <div class="card-footer card__footer_style">
                                        @if( $product->productable->city )
                                            <small class="text-muted"> {{ $product->productable->city }}, </small>
                                        @endif

                                        @if( $product->productable->updated_at )
                                            <small class="text-muted me-1"> {{ $product->productable->updated_at->diffForHumans() }}, </small>
                                            <small class="text-muted"> {{ $product->productable->updated_at->format("H:m") }} </small>
                                        @endif
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endif
</div>
