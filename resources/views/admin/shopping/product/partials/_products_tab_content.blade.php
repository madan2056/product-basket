<fieldset style="border: 1px solid #ddd;">
    <section>
        <div class="form-group">
            {!! Form::hidden('selected_products', isset($data['basket_detail']) && array_key_exists('selected_products', $data['basket_detail'])?$data['basket_detail']['selected_products']:'', [ 'id' => 'selected_products']) !!}
            <div class="input-group select2-bootstrap-append">
                {!! Form::select('product_search', [], null, ['class' => 'form-control', 'id' => 'product_search',  'style' => "width: 100%"]) !!}
                <span class="input-group-btn">
                        <button class="btn btn-default" id="btn-add-product" type="button">
                            <span class="fa fa-plus-square"></span>
                        </button>
                    </span>
            </div>
        </div>
    </section>
    <section>
        <!-- widget div-->
        <div>
            <table id="tbl-products" class="table table-striped table-bordered table-hover" width="100%">
                <thead>
                <tr>
                    <th><i class="fa fa-fw fa-th-list text-muted hidden-md hidden-sm hidden-xs"></i> {{ trans($trans_path . 'general.columns.name') }} </th>
                    <th><i class="fa fa-fw fa-th-list text-muted hidden-md hidden-sm hidden-xs"></i> {{ trans($trans_path . 'general.columns.image') }} </th>
                    <th><i class="fa fa-fw fa-list txt-color-blue hidden-md hidden-sm hidden-xs"></i> {{ trans($trans_path . 'general.columns.is-perishable') }} </th>
                    <th><i class="fa fa-fw fa-list txt-color-blue hidden-md hidden-sm hidden-xs"></i> {{ trans($trans_path . 'general.columns.is_special') }} </th>
                    <th><i class="fa fa-fw fa-list txt-color-blue hidden-md hidden-sm hidden-xs"></i> {{ trans($trans_path . 'general.columns.is_featured') }} </th>
                    <th><i class="fa fa-fw fa-edit txt-color-blue hidden-md hidden-sm hidden-xs"></i> {{ trans('general.tabs.action') }} </th>
                </tr>
                </thead>
                <tbody>

                @if (!isset($data['basket_detail']))
                    <tr id="empty-product-tr">
                        <td colspan="6">No Products Added.</td>
                    </tr>
                @else
                    @if (array_key_exists('products_on_basket', $data['basket_detail']) && $data['basket_detail']['products_on_basket']->count() > 0)

                        @foreach($data['basket_detail']['products_on_basket'] as $row)
                            <tr>
                                <td class="hidden" rowname="pk">{{ $row->primary_key }}</td>
                                <td> {{ $row->name }}</td>
                                <td>
                                    @if(isset($row->image))
                                        <img src="{{ asset($image_path .$row->image) }}" width="50" class="img-responsive" alt="img">
                                    @else
                                        <img src="{{ asset(config('neptrox.asset_path.admin.smart').'img/default.jpg') }}" width="50" class="img-responsive" alt="img">
                                    @endif
                                </td>
                                <td>
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
                                        <a href="{{route($base_route. '.set-special',['id'=>$row->primary_key])}}" class="fa fa-square-o" data-toggle="tooltip" title="Make Special"> &nbsp; </a>
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    @if($row->is_featured == 1)
                                        <a href="{{route($base_route. '.set-featured',['id'=>$row->primary_key])}}" class="fa fa-check-square-o" data-toggle="tooltip" title="Make Normal">
                                            &nbsp; </a>
                                    @else
                                        <a href="{{route($base_route. '.set-featured',['id'=>$row->primary_key])}}" class="fa fa-square-o" data-toggle="tooltip" title="Make Featured"> &nbsp; </a>
                                    @endif
                                </td>
                                <td style="text-align: center"><a class="btn-remove-product" href="#" title="Remove role"><i class="fa fa-trash-o deletable"></i></a></td>
                            </tr>
                        @endforeach

                    @else

                        <tr id="empty-product-tr">
                            <td colspan="6">No Products Added.</td>
                        </tr>

                    @endif
                @endif

                </tbody>
            </table>
        </div>
        <!-- end widget div -->
    </section>
</fieldset>