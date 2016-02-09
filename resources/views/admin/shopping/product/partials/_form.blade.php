<div class="widget-body" style="padding: 10px;">

    <div class="tabs-left">
        <ul class="nav nav-tabs tabs-left" id="demo-pill-nav">
            <li class="active">
                <a href="#tab-general" data-toggle="tab">{{ trans($trans_path . 'general.columns.general') }} </a>
            </li>
            <li class="">
                <a href="#tab-data" data-toggle="tab">{{ trans($trans_path . 'general.columns.data') }} </a>
            </li>
            <li class="">
                <a href="#tab-product" data-toggle="tab">{{ trans($trans_path . 'general.columns.product') }} </a>
            </li>
            <li class="">
                <a href="#tab-attribute" data-toggle="tab">{{ trans($trans_path . 'general.columns.attribute') }} </a>
            </li>
            <li class="">
                <a href="#tab-multiple-images" data-toggle="tab">{{ trans($trans_path . 'general.columns.multiple-images') }} </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
                @include($view_path.'partials._general_tab_content')
            </div>
            <div class="tab-pane" id="tab-data">
                @include($view_path.'partials._data_tab_content')
            </div>
            <div class="tab-pane" id="tab-product">
                @include($view_path.'partials._products_tab_content')
            </div>
            <div class="tab-pane" id="tab-attribute">
                @include($view_path.'partials._attribute_tab_content')
            </div>
            <div class="tab-pane" id="tab-multiple-images">
                @include($view_path.'partials._multiple_image_tab_content')
            </div>
        </div>
    </div>

</div>