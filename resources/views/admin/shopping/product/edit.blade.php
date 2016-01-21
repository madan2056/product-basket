@extends('layouts.master')


@section('head_extra')
    <link rel="stylesheet" href="{{asset(config('neptrox.asset_path.admin.css').'redactor/redactor.css')}}"/>

    <!-- Select2 4.0.0 -->
    <link href="{{ asset(config('neptrox.asset_path.bower')."admin-lte/select2/css/select2.min.css") }}" rel="stylesheet" type="text/css"/>
    <!-- Select2-bootstrap-theme 0.1.0-beta.4 -->
    <link href="{{ asset(config('neptrox.asset_path.bower')."admin-lte/select2/css/select2-bootstrap.min.css") }}" rel="stylesheet" type="text/css">


@endsection

@section('content')
    <div class='row'>
        <article class='col-md-12 col-sm-5 col-md-5 col-lg-12'>
            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false"
                 data-widget-custombutton="false">
                <header>
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                    <h2>{{ trans($trans_path . 'general.action.edit') }} </h2>
                </header>

                <!-- widget div-->
                <div>
                    <!-- widget content -->
                    <div class="widget-body no-padding">

                        {!! Form::open(['route' => [$base_route . '.update', $data['primary_key']], 'method' => 'PATCH', 'id' => 'product-category-form', 'class' => 'smart-form', 'enctype ' => 'multipart/form-data'] ) !!}
                        @include($view_path.'.partials._form')

                        <footer>
                            {!! Form::button( trans('general.button.save-edit'), ['class' => 'btn btn-primary custom-btn', 'name' => 'save-edit', 'value' => 'save-edit', 'id' => 'btn-submit-edit', 'type' => 'submit'] ) !!}
                            {!! Form::button( trans('general.button.save-list'), ['class' => 'btn btn-primary custom-btn', 'name' => 'save-list', 'value' => 'save-list', 'id' => 'btn-submit-edit', 'type' => 'submit'] ) !!}
                            <a href="{!! route($base_route) !!}" title="{{ trans('general.button.cancel') }}" class='btn btn-default custom-btn'>{{ trans('general.button.cancel') }}</a>
                        </footer>
                        {!! Form::close() !!}

                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->
        </article>
        <!-- /.col -->

    </div><!-- /.row -->
@endsection

@section('extra_script')
    <script src="{{ asset(config('neptrox.asset_path.admin.js').'redactor/redactor.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $('.description').redactor({
                minHeight: 200
            });
        });
    </script>

    @include($view_path.'.partials._select2_scripts')

    <!-- Form Validation -->
    <script>
        $(document).ready(function () {

            $("form[id=product-category-form]").validate();
            $("form[id=product-category-form]").on('submit', function () {
                var isValid = $(this).valid();
                if (this.hasChildNodes('.nav.nav-tabs')) {
                    var validator = $(this).validate();
                    $(this).find("input").each(function () {
                        if (!validator.element(this)) {
                            isValid = false;
                            $('a[href=#' + $(this).closest('.tab-pane:not(.active)').attr('id') + ']').tab('show');
                            return false;
                        }
                    });
                }
                if (isValid) {
                    //console.log('valid');
                }
            });


        });
    </script>

@endsection

