<div class="responsivegrid-table">
    <div class="rgt-header">
        <div class="rgt-row row row-8">
            <div class="col-sm-2 text-center">
                <strong>Image</strong>
            </div>
            <div class="col-sm-3">
                <strong>Product Name</strong>
            </div>
            <div class="col-sm-2 text-right">
                <strong>Price</strong>
            </div>
        </div>
    </div>
    <div class="rgt-content" id="cart-list-wrapper">

        @if(count($productList) > 0)
            @foreach($productList as $item)
                <div class="rgt-row row row-8">
                    <div class="col-sm-2">
                        <figure class="text-center">
                            <a href="{{ ViewHelper::getProductDetailUrl($item->product_type, $item->slug) }}" target="_blank">
                                <img src="{{ asset(ViewHelper::getProductThumbImagePath($item->image, 'main-image', 'basket')) }}"
                                     alt="{{ $item->name }}" title="{{ $item->name }}" class="img-responsive">
                            </a>
                        </figure>
                    </div>
                    <div class="col-sm-3">
                        <div class="clearfix ct-item">
                            <div class="cl-left">
                                <strong>Product Name</strong>
                            </div>
                            <div class="cl-right">
                                <a href="{{ ViewHelper::getProductDetailUrl($item->product_type, $item->slug) }}">{{ $item->name }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 text-right">
                        <div class="clearfix ct-item">
                            <div class="cl-left">
                                <strong>Total</strong>
                            </div>
                            <div class="cl-right">
                                <strong class="price-text">{{ AppHelper::getPriceByCurrency($item->price) }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="rgt-row row row-8">
                <div class="col-sm-3">
                    <div class="clearfix ct-item">
                        <div class="cl-right">
                            <p>No data found.</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif


    </div>
</div>