<div class="tab-content tab-content-description">

    <ul id="tabs">
        <li class="active"><a href="#tab-products" data-toggle="tab">Products</a></li>
        <li><a href="#tab-description" data-toggle="tab">Description</a></li>
        @if(isset($attribute_values) && !empty($attribute_values))
            <li><a href="#spec" data-toggle="tab">Specification</a></li>
        @endif
        <li><a href="#tab-review" data-toggle="tab">{{ ucfirst(str_plural('review', $productData->rating_count)) }} ({{$productData->rating_count}})</a></li>
    </ul>

    <div class="tab-pane active" id="tab-products">
        @include($view_path.'.partials.product_list')
    </div>
    <div class="tab-pane" id="tab-description">{!! $product->description !!}</div>
    @if(isset($attribute_values) && !empty($attribute_values))
        <div id="spec" class="tab-pane">
            <ul class="spec m-t-45">
                @foreach($attribute_values as $attribute_group => $attribute_value)
                    <li class="spec-list bg-dark-grey">
                        <div class="col-md-2">
                            <h4>{{ $attribute_group }}</h4>
                        </div>
                        <div class="col-md-10 bg-grey">
                            @foreach($attribute_value as $attribute => $value)
                                <div class="row">
                                    <div class="col-md-3">
                                        <strong>{{ $attribute }}</strong>
                                    </div>
                                    <div class="col-md-9">
                                        <label>{{ $value }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="tab-pane" id="tab-review">

        <!-- Here comes Review Form by Ajax Request -->

        <h4>Important information</h4>

        <p>
            Your review will only be published here, and helps us to improve the quality of items we
            offer.
            You must not use the review function to publish content that is commercial, political,
            pornographic, obscene, criminal, libelous or that is otherwise illegal in
            nature. Copying opinions that have already been published elsewhere is forbidden by law. We
            reserve the right not to publish reviews. You are entitled to view
            and correct the data collected about you and to object to it being processed.
        </p>


        <!-- Here comes product reviews by Ajax Request -->


    </div>

</div>