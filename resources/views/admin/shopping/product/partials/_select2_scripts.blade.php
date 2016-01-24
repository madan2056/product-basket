<!-- Select2 4.0.0 -->
<script src="{{ asset (config('neptrox.asset_path.bower')."admin-lte/select2/js/select2.min.js") }}" type="text/javascript"></script>
<script type="text/javascript">
    $('#product_search').select2({
        theme: "bootstrap",
        placeholder: 'Search products...',
        minimumInputLength: 3,
        ajax: {
            delay: 250,
            url: '{{ route($base_route.'.product-search') }}',
            dataType: 'json',
            data: function (params) {
                var queryParameters = {
                    query: params.term,
                    loaded: $('#selected_products').val()
                };

                return queryParameters;
            },
            processResults: function (data) {
                return {
                    results: data
                };
            }
        },
    });

    $("#btn-add-product").on("click", function () {

        var productName, imageName, imagePath, roleStatus, idCell, nameCel, imageCel, perishableCol, specialCol, featuredCol, actionCel;
        // Get ID.
        var productID = $('#product_search').val();
        // Capture CSRF token from meta header.
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        // Parse table values based on selected text.
        $.ajax({
            url: '{!! route($base_route.'.get-product-info') !!}',
            type: 'POST',
            data: {
                _token: CSRF_TOKEN,
                id: productID,
            },
            dataType: 'JSON',
            success: function (data) {

                productName = data['name'];
                imageName = data['image'];
                if (imageName)
                    imagePath = '{{ asset($image_path) }}'.concat('/' + imageName);
                else
                    imagePath = '{{ asset(config('neptrox.asset_path.admin.smart').'img/default.jpg') }}';

                if (data['is_perishable'])
                    perishableCol = '<a href="#" class="fa fa-check-square-o" data-toggle="tooltip" title="Perishable Product"> &nbsp; </a>';
                else
                    perishableCol = '<a href="#" class="fa fa-square-o" data-toggle="tooltip" title="Normal Product"> &nbsp; </a>';

                if (data['is_special'])
                    specialCol = '<a href="#" class="fa fa-check-square-o" data-toggle="tooltip" title="Special Product"> &nbsp; </a>';
                else
                    specialCol = '<a href="#" class="fa fa-square-o" data-toggle="tooltip" title="Normal Product"> &nbsp; </a>';

                if (data['is_featured'])
                    featuredCol = '<a href="#" class="fa fa-check-square-o" data-toggle="tooltip" title="Featured Product"> &nbsp; </a>';
                else
                    featuredCol = '<a href="#" class="fa fa-square-o" data-toggle="tooltip" title="Normal Product"> &nbsp; </a>';

                // Build table cells.
                idCell = '<td class="hidden" rowname="pk">' + productID + '</td>';
                nameCel = '<td>' + productName + '</td>';
                imageCel = '<td><img src="' + imagePath + '" width="50" class="img-responsive" alt="' + productName + '"></td>';
                perishableCol = '<td>' + perishableCol + '</td>';
                specialCol = '<td>' + specialCol + '</td>';
                featuredCol = '<td>' + featuredCol + '</td>';
                actionCel = '<td style="text-align: center"><a class="btn-remove-product" href="#" title="{{ trans('general.button.remove-role') }}"><i class="fa fa-trash-o deletable"></i></a></td>';

                // Add selected item only if not already in list.
                if ($('#tbl-products tr > td[rowname="pk"]:contains(' + productID + ')').length == 0) {

                    if ($('#tbl-products > tbody :first-child').attr('id') == 'empty-product-tr') {
                        $('#tbl-products > tbody :first-child').remove();
                    }

                    $('#tbl-products > tbody:last-child').append('<tr>' + idCell + nameCel + imageCel + perishableCol + specialCol + featuredCol + actionCel + '</tr>');
                }

                updateProductCollectionList();

            }
        });
    });

    $('body').on('click', 'a.btn-remove-product', function () {
        $(this).parent().parent().remove();
        updateProductCollectionList();
        if ($('#tbl-products > tbody').find('tr').length == 0)
            $('#tbl-products > tbody').append('<tr id="empty-product-tr"><td colspan="6">No Products Added.</td></tr>');
    });


    function updateProductCollectionList()
    {
        var product = [], id;
        // Collect all IDs from first column.
        $('#tbl-products tr').each(function () {
            id = $(this).find("td:first").html();
            if (id) {
                product.push(id);
            }
        });
        // Join all users from array to hidden field separated by a comma.
        $('#selected_products').val(product.join(','));
    }


</script>