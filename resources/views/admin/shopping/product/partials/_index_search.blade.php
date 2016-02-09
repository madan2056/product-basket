<table class="table table-striped table-bordered table-hover hidden-mob" id="product_index_search" width="100%" style="{!! (!request()->has('product-status'))?"display: none;":'' !!}" >
    <thead>
    <tr class="col-md-12">
        <th data-class="expand" class="col-md-2 custom-col">
            <label for="product_id_from" class="col-md-3 custom-col topgap">{{ trans($trans_path.'general.columns.from') }} </label>
            <input type="text" name="product_id_from" id="product_id_from" value="{{ request('product-id-from') }}" placeholder="{{ trans($trans_path.'general.columns.product_id') }} "
                   class="custom-form col-md-9 topgap"/>
            <label for="product_id_to" class="col-md-3 custom-col topgap">{{ trans($trans_path.'general.columns.to') }} </label>
            <input type="text" name="product_id_to" id="product_id_to" value="{{ request('product-id-to') }}" placeholder="{{ trans($trans_path.'general.columns.product_id') }} "
                   class="custom-form col-md-9 topgap"/>
        </th>
        <th class="col-md-3 custom-col">
            <label for="product_name" class="col-md-2 custom-col topgap">{{ trans($trans_path.'general.columns.name') }} </label>
            <input type="text" name="product_name" id="product_name" value="{{ request('product-name') }}" placeholder="{{ trans($trans_path.'general.columns.product-name') }} "
                   class="custom-form col-md-10 topgap">
            <label for="product_status" class="col-md-2 custom-col topgap">{{ trans($trans_path.'general.columns.status') }} </label>
            <select name="product_status" id="product_status" class="custom-form col-md-10 topgap">
                <option value="1">Active</option>
                <option value="0">In-Active</option>
            </select>
        </th>
        <th data-class="expand" class="col-md-2 custom-col">
            <label for="product_price_from" class="col-md-3 custom-col topgap">{{ trans($trans_path.'general.columns.from') }} </label>
            <input type="text" name="product_price_from" id="product_price_from" value="{{ request('product-price-from') }}" placeholder="{{ trans($trans_path.'general.columns.price') }}"
                   class="custom-form col-md-9 topgap"/>
            <label for="product_price_to" class="col-md-3 custom-col topgap">{{ trans($trans_path.'general.columns.to') }} </label>
            <input type="text" name="product_price_to" id="product_price_to" value="{{ request('product-price-to') }}" placeholder="{{ trans($trans_path.'general.columns.price') }}"
                   class="custom-form col-md-9 topgap"/>
        </th>
        <th data-class="expand" class="col-md-2 custom-col">
            <label for="product_quantity_from" class="col-md-3 custom-col topgap">{{ trans($trans_path.'general.columns.from') }} </label>
            <input type="text" name="product_quantity_from" id="product_quantity_from" value="{{ request('product-quantity-from') }}" placeholder="{{ trans($trans_path.'general.columns.quantity') }}"
                   class="custom-form col-md-9 topgap"/>
            <label for="product_quantity_to" class="col-md-3 custom-col topgap">{{ trans($trans_path.'general.columns.to') }} </label>
            <input type="text" name="product_quantity_to" id="product_quantity_to" value="{{ request('product-quantity-to') }}" placeholder="{{ trans($trans_path.'general.columns.quantity') }}"
                   class="custom-form col-md-9 topgap"/>
        </th>
        <th data-class="expand" class="col-md-2 custom-col">
            <label for="product_date_from" class="col-md-3 custom-col topgap">{{ trans($trans_path.'general.columns.from') }} </label>
            <input type="text" name="product_date_from" id="product_date_from" value="{{ request('product-date-from') }}" placeholder="{{ trans($trans_path.'general.columns.created_date') }}"
                   class="custom-form col-md-9 topgap"/>
            <label for="product_date_to" class="col-md-3 custom-col topgap">{{ trans($trans_path.'general.columns.to') }} </label>
            <input type="text" name="product_date_to" id="product_date_to" value="{{ request('product-date-to') }}" placeholder="{{ trans($trans_path.'general.columns.created_date') }}"
                   class="custom-form col-md-9 topgap"/>
        </th>
        <th class="col-md-1 custom-col">
            <a class="btn btn-default btn-custom topgap" href="#" id="search-button" role="button" data-toggle="tooltip" title="{{ trans($trans_path . 'general.action.search') }}"><i
                        class="fa fa-fw fa-search"></i></a>
            <a class="btn btn-default btn-custom topgap" href="#" id="reset-button" role="button" data-toggle="tooltip" title="{{ trans($trans_path . 'general.action.reset') }}"><i
                        class="fa fa-fw fa-refresh"></i></a>
        </th>
    </tr>
    </thead>
</table>
<script>
    $(document).ready(function () {

        $('#search-button').click(function (e) {

            e.preventDefault();

            var url = '{{ route('admin.product') }}';
            var product_id_from = $('#product_id_from').val();
            var product_id_to = $('#product_id_to').val();
            var product_name = $('#product_name').val();
            var product_status = $('#product_status').val();
            var product_price_from = $('#product_price_from').val();
            var product_price_to = $('#product_price_to').val();
            var product_quantity_from = $('#product_quantity_from').val();
            var product_quantity_to = $('#product_quantity_to').val();
            var product_date_from = $('#product_date_from').val();
            var product_date_to = $('#product_date_to').val();

            // determines if ? is used in url, false means ? not used
            var flag = false;

            if (product_id_from != '') {
                url = url + '?product-id-from=' + product_id_from;
                flag = true;
            }
            if (product_id_to != '') {

                if (flag == false) {
                    url = url + '?product-id-to=' + product_id_to;
                    flag = true;
                }
                else
                    url = url + '&product-id-to=' + product_id_to;

            }
            if (product_name != '') {

                if (flag == false) {
                    url = url + '?product-name=' + product_name;
                    flag = true;
                }
                else
                    url = url + '&product-name=' + product_name;

            }
            if (product_status != '') {

                if (flag == false) {
                    url = url + '?product-status=' + product_status;
                    flag = true;
                }
                else
                    url = url + '&product-status=' + product_status;

            }
            if (product_price_from != '') {

                if (flag == false) {
                    url = url + '?product-price-from=' + product_price_from;
                    flag = true;
                }
                else
                    url = url + '&product-price-from=' + product_price_from;

            }
            if (product_price_to != '') {

                if (flag == false) {
                    url = url + '?product-price-to=' + product_price_to;
                    flag = true;
                }
                else
                    url = url + '&product-price-to=' + product_price_to;

            }
            if (product_quantity_from != '') {

                if (flag == false) {
                    url = url + '?product-quantity-from=' + product_quantity_from;
                    flag = true;
                }
                else
                    url = url + '&product-quantity-from=' + product_quantity_from;

            }
            if (product_quantity_to != '') {

                if (flag == false) {
                    url = url + '?product-quantity-to=' + product_quantity_to;
                    flag = true;
                }
                else
                    url = url + '&product-quantity-to=' + product_quantity_to;

            }
            if (product_date_from != '') {

                if (flag == false) {
                    url = url + '?product-date-from=' + product_date_from;
                    flag = true;
                }
                else
                    url = url + '&product-date-from=' + product_date_from;

            }
            if (product_date_to != '') {

                if (flag == false) {
                    url = url + '?product-date-to=' + product_date_to;
                    flag = true;
                }
                else
                    url = url + '&product-date-to=' + product_date_to;

            }

            location.href = url;

        });

        $('#reset-button').click(function (e) {
            $('#product_id_from').val('');
            $('#product_id_to').val('');
            $('#product_name').val('');
            $('#product_price_from').val('');
            $('#product_price_to').val('');
            $('#product_quantity_from').val('');
            $('#product_quantity_to').val('');
            $('#product_date_from').val('');
            $('#product_date_to').val('');
        });

    });
</script>