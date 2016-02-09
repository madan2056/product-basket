@extends('frontend.frontend-master')

@section('body')


    <div class="main-main-  main-main-home-df">

        @include($product_view_path.'.partials._breadcrumb')

        <div class="category-pd product-detail-page">
            <div class="container">

                @include($product_view_path.'.partials._flash_message')

                <div class="row product-content">

                    <column id="column-left" class="col-sm-3 hidden-xs">

                        <!-- List of Categories -->
                        @include('frontend.shopping.partials._left_sidebar_category_list')


                    </column>

                    <div id="content" class="col-sm-9">

                        <div class="row">

                            @include($product_view_path.'.partials._image_gallery')

                            <div class="col-sm-6" id="product_details_wrapper">

                                @include($product_view_path.'.partials._product_details')

                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-12">

                                <div class="review-container">

                                    @include($view_path. '.partials._tab_content')

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection


@section('page_specific_scripts')

    @include($product_view_path.'.partials._page_scripts')

@endsection