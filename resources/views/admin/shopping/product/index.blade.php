@extends('layouts.master')

@section('content')
    <div class='row'>
        <article class='col-md-12 col-sm-12 col-lg-12'>
            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="true" data-widget-custombutton="false">
                <header class="clearfix">
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>

                    <h2>{{ trans($trans_path . 'general.page.index.table-title') }} </h2>

                    <span class="pull-right">
                        <a href="{{ route($base_route.'.create') }}" title="{{ trans('general.button.add') }}" class="btn-xs-fixed pull-left btn-sm btn btn-labeled btn-primary"> <span
                                    class="btn-label"><i class="fa fa-plus"></i></span>{{ trans('general.button.add') }}</a>
                        <span class="btn-xs-fixed pull-right btn-sm btn btn-labeled btn-success" onclick="$('#product_index_search').toggle();">
                            <i class="fa fa-search" style="padding: 5px;"></i>
                        </span>
                    </span>

                </header>

                <!-- widget div-->
                <div>
                    <!-- widget content -->
                    <div class="widget-body no-padding">

                        @include($view_path.'.partials._index_search')

                        <table id="datatable" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>
                            <tr>
                                <th style="text-align: center">
                                    <a href="#" onclick="toggleCheckbox(); return false;" title="{{ trans('general.button.toggle-select') }}">
                                        <i class="fa fa-check-square-o"></i>
                                    </a>
                                </th>
                                <th><i class="fa fa-fw fa-key text-muted hidden-md hidden-sm hidden-xs"></i> {{ trans($trans_path . 'general.columns.id') }} </th>
                                <th><i class="fa fa-fw fa-th-list text-muted hidden-md hidden-sm hidden-xs"></i> {{ trans($trans_path . 'general.columns.name') }} </th>
                                <th><i class="fa fa-fw fa-th-list text-muted hidden-md hidden-sm hidden-xs"></i> {{ trans($trans_path . 'general.columns.primary-image') }} </th>
                                <th><i class="fa fa-fw fa-th-list text-muted hidden-md hidden-sm hidden-xs"></i> {{ trans($trans_path . 'general.columns.price') }} </th>
                                <th><i class="fa fa-fw fa-th-list text-muted hidden-md hidden-sm hidden-xs"></i> {{ trans($trans_path . 'general.columns.quantity') }} </th>
                                <th><i class="fa fa-fw fa-list txt-color-blue hidden-md hidden-sm hidden-xs"></i> {{ trans($trans_path . 'general.columns.is-perishable') }} </th>
                                <th><i class="fa fa-fw fa-list txt-color-blue hidden-md hidden-sm hidden-xs"></i> {{ trans($trans_path . 'general.columns.is_special') }} </th>
                                <th><i class="fa fa-fw fa-list txt-color-blue hidden-md hidden-sm hidden-xs"></i> {{ trans($trans_path . 'general.columns.is_featured') }} </th>
                                <th><i class="fa fa-fw fa-list txt-color-blue hidden-md hidden-sm hidden-xs"></i> {{ trans($trans_path . 'general.columns.created_date') }} </th>
                                <th><i class="fa fa-fw fa-list txt-color-blue hidden-md hidden-sm hidden-xs"></i> {{ trans($trans_path . 'general.columns.status') }} </th>
                                <th><i class="fa fa-fw fa-edit txt-color-blue hidden-md hidden-sm hidden-xs"></i> {{ trans('general.tabs.action') }} </th>
                            </tr>
                            </thead>
                            @if($data->count() > 0)
                                <tbody>
                                @foreach($data as $row)
                                    <tr>
                                        <td align="center">{!! Form::checkbox('chkRoute[]', $row->primary_key) !!}</td>
                                        <td>{{ $row->primary_key }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>
                                            @if(isset($row->image))
                                                <img src="{{ asset(ViewHelper::getProductThumbImagePath($row->image, 'main-image', 'basket')) }}" width="50" class="img-responsive" alt="img">
                                            @else
                                                <img src="{{ asset(config('neptrox.asset_path.admin.smart').'img/default.jpg') }}" width="50" class="img-responsive" alt="img">
                                            @endif
                                        </td>
                                        <td>{{ AppHelper::getPriceByCurrency($row->price) }}</td>
                                        <td style="text-align: center;">{{ $row->quantity }}</td>
                                        <td style="text-align: center;">
                                            @if($row->is_perishable == 1)
                                                <a href="{{route($base_route. '.set-perishable',['id'=>$row->primary_key])}}" class="fa fa-check-square-o" data-toggle="tooltip" title="Make Normal">
                                                    &nbsp; </a>
                                            @else
                                                <a href="{{route($base_route. '.set-perishable',['id'=>$row->primary_key])}}" class="fa fa-square-o" data-toggle="tooltip" title="Make Perishable">
                                                    &nbsp; </a>
                                            @endif
                                        </td>
                                        <td style="text-align: center;">
                                            @if($row->is_special == 1)
                                                <a href="{{route($base_route. '.set-special',['id'=>$row->primary_key])}}" class="fa fa-check-square-o" data-toggle="tooltip" title="Make Normal">
                                                    &nbsp; </a>
                                            @else
                                                <a href="{{route($base_route. '.set-special',['id'=>$row->primary_key])}}" class="fa fa-square-o" data-toggle="tooltip" title="Make Special">
                                                    &nbsp; </a>
                                            @endif
                                        </td>
                                        <td style="text-align: center;">
                                            @if($row->is_featured == 1)
                                                <a href="{{route($base_route. '.set-featured',['id'=>$row->primary_key])}}" class="fa fa-check-square-o" data-toggle="tooltip" title="Make Normal">
                                                    &nbsp; </a>
                                            @else
                                                <a href="{{route($base_route. '.set-featured',['id'=>$row->primary_key])}}" class="fa fa-square-o" data-toggle="tooltip" title="Make Featured">
                                                    &nbsp; </a>
                                            @endif
                                        </td>
                                        <td>{{ date('Y-m-d', strtotime($row->created_at)) }}</td>
                                        <td>{!! ($row->status)?'Active':'<i>In-Active</i>' !!}</td>
                                        <td><a href="{!! route($base_route.'.edit', $row->primary_key) !!}" class="fa fa-edit" data-toggle="tooltip" title="Edit"> &nbsp; </a>
                                            | &nbsp;
                                            <a href="{!! route($base_route.'.confirm-delete', $row->primary_key) !!}" data-toggle="modal" data-target="#modal_dialog"
                                               title="{{ trans('general.button.delete') }}"><i class="fa fa-trash-o deletable"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td align="right" colspan="8">{!! $data->appends($search_query)->render() !!}</td>
                                </tr>
                                </tfoot>
                            @endif

                            <tfoot>
                            <tr>
                                <th style="text-align: center">
                                    <a href="#" onclick="toggleCheckbox(); return false;" title="{{ trans('general.button.toggle-select') }}">
                                        <i class="fa fa-check-square-o"></i>
                                    </a>
                                </th>
                                <th><i class="fa fa-fw fa-key text-muted hidden-md hidden-sm hidden-xs"></i> {{ trans($trans_path . 'general.columns.id') }} </th>
                                <th><i class="fa fa-fw fa-th-list text-muted hidden-md hidden-sm hidden-xs"></i> {{ trans($trans_path . 'general.columns.name') }} </th>
                                <th><i class="fa fa-fw fa-th-list text-muted hidden-md hidden-sm hidden-xs"></i> {{ trans($trans_path . 'general.columns.primary-image') }} </th>
                                <th><i class="fa fa-fw fa-th-list text-muted hidden-md hidden-sm hidden-xs"></i> {{ trans($trans_path . 'general.columns.price') }} </th>
                                <th><i class="fa fa-fw fa-th-list text-muted hidden-md hidden-sm hidden-xs"></i> {{ trans($trans_path . 'general.columns.quantity') }} </th>
                                <th><i class="fa fa-fw fa-list txt-color-blue hidden-md hidden-sm hidden-xs"></i> {{ trans($trans_path . 'general.columns.is-perishable') }} </th>
                                <th><i class="fa fa-fw fa-list txt-color-blue hidden-md hidden-sm hidden-xs"></i> {{ trans($trans_path . 'general.columns.is_special') }} </th>
                                <th><i class="fa fa-fw fa-list txt-color-blue hidden-md hidden-sm hidden-xs"></i> {{ trans($trans_path . 'general.columns.is_featured') }} </th>
                                <th><i class="fa fa-fw fa-list txt-color-blue hidden-md hidden-sm hidden-xs"></i> {{ trans($trans_path . 'general.columns.created_date') }} </th>
                                <th><i class="fa fa-fw fa-list txt-color-blue hidden-md hidden-sm hidden-xs"></i> {{ trans($trans_path . 'general.columns.status') }} </th>
                                <th><i class="fa fa-fw fa-edit txt-color-blue hidden-md hidden-sm hidden-xs"></i> {{ trans('general.tabs.action') }} </th>
                            </tr>
                            </tfoot>
                        </table>

                    </div>
                    <!-- end widget content -->
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

    @include('partials._datatable_libs')

    <script type="text/javascript">

        // DO NOT REMOVE : GLOBAL FUNCTIONS!

        $(document).ready(function () {
            /* BASIC */

            $('#datatable').dataTable({
                "autoWidth": true,
                "searching": false,
                "paging": false,
                "order": [[2, "asc"]],
                columnDefs: [
                    {
                        orderable: false,
                        targets: [0]
                    },
                    {
                        orderable: false,
                        targets: [4]
                    }
                ]
            });

            /* END BASIC */
            // Tooltip initialize
            $('[data-toggle="tooltip"]').tooltip();
        })

    </script>

    <script language="JavaScript">
        function toggleCheckbox() {
            checkboxes = document.getElementsByName('chkRoute[]');
            for (var i = 0, n = checkboxes.length; i < n; i++) {
                checkboxes[i].checked = !checkboxes[i].checked;
            }
        }
    </script>


@endsection
