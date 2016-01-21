<table class="table table-striped table-bordered" width="100%">
    <thead>
    <tr>
        <th><i class="fa fa-fw fa-list text-muted hidden-md hidden-sm hidden-xs"></i> {{ trans($trans_path.'general.columns.image') }} </th>
        <th><i class="fa fa-fw fa-list text-muted hidden-md hidden-sm hidden-xs"></i> {{ trans($trans_path.'general.columns.alt-tag') }} </th>
        <th><i class="fa fa-fw fa-list txt-color-blue hidden-md hidden-sm hidden-xs"></i> {{ trans($trans_path.'general.columns.sort-order') }} </th>
        <th></th>
    </tr>
    </thead>
    <tbody id="multiple-image-row-wrapper">

    <?php
    $multiple_image_index = 0;
    ?>

    @if (!empty($medias))
        <?php /* This executes if Request is coming form Edit form */ ?>
        <input type="hidden" name="is_update_request_img" value="1">

        @foreach($medias as $media)

            <tr>
                <td class="text-left">
                    <section>
                        <div class="clearfix">
                            <div class="col-md-6 text-center">
                            <label class="input">
                                <input type="hidden" name='multiple_image[{{ $multiple_image_index }}][product_media_id]' value="{{ $media->id }}">
                                <img width="200" src="{{ asset($image_path . $media->media) }}" class="" alt="img">
                            </label>
                            </div>
                            <div class="col-md-6">
                            <label class="input margin-t-lglg">
                                {!! Form::file('multiple_image['.$multiple_image_index.'][file]', null, ['class' => 'input-xs', 'id' => 'files']) !!}
                            </label>
                            </div>
                        </div>
                    </section>
                </td>
                <td class="text-left">
                    <section>
                        <label class="input margin-t-lglg">
                            <input type="text" name="multiple_image[{{ $multiple_image_index }}][alt_tag]" value="{{ $media->alt_tag }}" >
                        </label>
                        {{ ViewHelper::showValidationError($errors, 'multiple_image['.$multiple_image_index.'][alt_tag]') }}
                    </section>
                </td>
                <td class="text-left">
                    <section>
                        <label class="input margin-t-lglg">
                            <input type="number" name="multiple_image[{{ $multiple_image_index }}][sort_order]" value="{{ $media->sort_order }}" min='0' max='999'>
                        </label>
                        {{ ViewHelper::showValidationError($errors, 'multiple_image['.$multiple_image_index.'][sort_order]') }}
                    </section>
                </td>
                <td class="text-right">
                    <span class="btn btn-danger btn-recover margin-t-lglg" onclick="return removeRow(this);"><i class=" fa fa-remove"></i></span>
                </td>
            </tr>

            <?php $multiple_image_index++; ?>
        @endforeach

    @else
        <?php /* This executes if Request is coming for Add form */ ?>
        <tr>
            <td class="text-left">
                <section>
                    <label class="input">
                        {!! Form::file('multiple_image['.$multiple_image_index.'][file]', null, ['class' => 'input-xs', 'id' => 'files']) !!}
                    </label>
                </section>
            </td>
            <td class="text-left">
                <section>
                    <label class="input">
                        <input type="text" name="multiple_image[{{ $multiple_image_index }}][alt_tag]" value="" >
                    </label>
                    {{ ViewHelper::showValidationError($errors, 'multiple_image['.$multiple_image_index.'][alt_tag]') }}
                </section>
            </td>
            <td class="text-left">
                <section>
                    <label class="input">
                        <input type="number" name="multiple_image[{{ $multiple_image_index }}][sort_order]" value="" min='0' max='999'>
                    </label>
                    {{ ViewHelper::showValidationError($errors, 'multiple_image['.$multiple_image_index.'][sort_order]') }}
                </section>
            </td>
            <td class="text-right">
                <span class="btn btn-danger btn-recover" onclick="return removeRow(this);"><i class=" fa fa-remove"></i></span>
            </td>
        </tr>

        <?php $multiple_image_index++; ?>

    @endif


    </tbody>
    <tfoot>
    <tr>
        <td colspan="3">&nbsp;</td>
        <td class="text-right">
            <a href="#" class="btn btn-primary btn-recover add_field_button"><i class=" fa fa-plus"></i></a>
        </td>
    </tr>
    </tfoot>
</table>

<script>

    $(document).ready(function () {

        var max_fields_img = 10; //maximum input boxes allowed
        var add_button_img = $(".add_field_button"); //Add button ID
        var wrapper_img = $("#multiple-image-row-wrapper");

        var row_index_img = '{{ $multiple_image_index }}';
        x_img = 1; //initialize text box count
        $(add_button_img).click(function (e) { //on add input button click
            e.preventDefault();
            if (x_img < max_fields_img) { //max input box allowed
                x_img++; //text box increment

                // Load by Ajax
                loadMultipleImageRow(wrapper_img, row_index_img);
                row_index_img++;
            }
        });


    });

    function removeRow(selector) {
        selector.closest('td').closest('tr').remove();
        x_img--;
    }


    // Load the table Row for Attribute value section by Ajax call
    function loadMultipleImageRow(wrapper, row_index) {

        $.ajax({
            method: 'GET',
            url: '{{ url('admin/product/multiple-image-row') }}' + '/' + row_index,
            error: function (request, status, error) {
                //console.log(request.responseText);
            },
            success: function (data) {

                var data = jQuery.parseJSON(data);
                if (data.html)
                    wrapper.append(data.html);
            }
        });
    }


</script>


