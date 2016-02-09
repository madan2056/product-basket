<table class="table table-striped table-bordered" width="100%">
    <thead>
    <tr>
        <th><i class="fa fa-fw fa-list text-muted hidden-md hidden-sm hidden-xs"></i> {{ trans($trans_path.'general.columns.attribute') }} </th>
        <th><i class="fa fa-fw fa-list txt-color-blue hidden-md hidden-sm hidden-xs"></i> {{ trans($trans_path.'general.columns.attribute_values') }} </th>
        <th></th>
    </tr>
    </thead>
    <tbody id="attribute-value-row-wrapper">

    <?php
    $attribute_value_index = 0;
    ?>

    @if (!empty($attribute_values))
        <?php /* This executes if Request is coming form Edit form */ ?>

        <input type="hidden" name="is_update_request_attr" value="1">

        @for ($i = 0; $i < count($attribute_values[$default_lang_id]); $i++)

            <tr>
                <td class="text-left">

                    <section>
                        {{--<input type="hidden" name="attribute[{{ $attribute_value_index }}][old_attribute_id]" value="{{ $attribute_values[$default_lang_id][$i]->id }}">--}}

                        <label class="input">
                            <select name="attribute[{{ $attribute_value_index }}][attribute_pk]" class="form-control select2">
                                <option value="0"> -- Choose Attribute --</option>
                                @foreach($attribute as $row)
                                    <optgroup label="{{ $row['group'] }}">
                                        @foreach($row['attr'] as $attr)
                                            <option value="{{ $attr['pk'] }}" {{ $attribute_values[$default_lang_id][$i]->attribute_id == $attr['pk']?'selected="selected"':'' }}>
                                                {{ $attr['name'] }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach

                            </select>
                        </label>
                    </section>

                    <section>
                        {!! Form::label('sort_order', trans($trans_path . 'general.columns.sort-order'), ['class' => 'label'] ) !!}
                        <label class="input">
                            <input type="number" name="attribute[{{ $attribute_value_index }}][sort_order]"
                                   value="{{ $attribute_values[$default_lang_id][$i]->sort_order }}" min='0' max='999'>
                        </label>
                        {{ ViewHelper::showValidationError($errors, 'sort_order') }}
                        <div class="note">
                            {!! trans($trans_path . 'general.columns.sort-order-note') !!}
                        </div>
                    </section>
                </td>
                <td class="text-left">
                    {{--<label class="label">{{ trans($trans_path . 'general.columns.attribute_values') }}</label>--}}
                    @foreach($all_languages as $language)
                        @if($language->status == 1)
                            <section>
                                <label class="textarea">
                                    <img class="icon-prepend auto-height-width" src="{{ asset($lang_image_path.$language->image) }}" alt=""/>
                                <textarea required name="attribute[{{ $attribute_value_index }}][value][{{ $language->id }}]" rows="6">{{
                                $attribute_values[$language->id][$i]->value
                                }}</textarea>
                                </label>
                            </section>
                        @endif

                            <input type="hidden" name="attribute[{{ $attribute_value_index }}][id][{{ $language->id }}]" value="{{ $attribute_values[$language->id][$i]->id }}">
                    @endforeach
                </td>
                <td class="text-left">
                    <span class="btn btn-danger btn-recover" onclick="return removeRow(this);"><i class=" fa fa-remove"></i></span>
                </td>
            </tr>

            <?php $attribute_value_index++; ?>



        @endfor


    @else
        <?php /* This executes if Request is coming for Add form */ ?>
        <tr>
            <td class="text-left">
                <section>
                    <label class="input">
                        {{--<label class="label">{{ trans($trans_path . 'general.columns.attribute') }}</label>--}}
                        <select name="attribute[{{ $attribute_value_index }}][attribute_pk]" class="form-control select2">
                            <option value="0"> -- Choose Attribute --</option>
                            @foreach($attribute as $row)
                                <optgroup label="{{ $row['group'] }}">
                                    @foreach($row['attr'] as $attr)
                                        <option value="{{ $attr['pk'] }}">{{ $attr['name'] }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach

                        </select>
                    </label>
                </section>
                <section>
                    {!! Form::label('sort_order', trans($trans_path . 'general.columns.sort-order'), ['class' => 'label'] ) !!}
                    <label class="input">
                        <input type="number" name="attribute[{{ $attribute_value_index }}][sort_order]" value="" min='0' max='999'>
                    </label>
                    {{ ViewHelper::showValidationError($errors, 'sort_order') }}
                    <div class="note">
                        {!! trans($trans_path . 'general.columns.sort-order-note') !!}
                    </div>
                </section>
            </td>
            <td class="text-left">
                {{--<label class="label">{{ trans($trans_path . 'general.columns.attribute_values') }}</label>--}}
                @foreach($languages as $language)
                    <section>
                        <label class="textarea">
                            <img class="icon-prepend auto-height-width" src="{{ asset($lang_image_path.$language->image) }}" alt=""/>
                            <textarea required name="attribute[{{ $attribute_value_index }}][value][{{ $language->id }}]" rows="6"></textarea>
                        </label>
                    </section>
                @endforeach
            </td>
            <td class="text-left">
                <span class="btn btn-danger btn-recover" onclick="return removeRow(this);"><i class=" fa fa-remove"></i></span>
            </td>
        </tr>

        <?php $attribute_value_index++; ?>

    @endif


    </tbody>
    <tfoot>
    <tr>
        <td colspan="2">&nbsp;</td>
        <td class="text-left">
            <a href="#" class="btn btn-primary btn-recover add_attribute_field_button"><i class=" fa fa-plus"></i></a>
        </td>
    </tr>
    </tfoot>
</table>

<script>

    $(document).ready(function () {

        var max_fields_attr = 10; //maximum input boxes allowed
        var add_button_attr = $(".add_attribute_field_button"); //Add button ID
        var wrapper_attr = $("#attribute-value-row-wrapper");

        var row_index_attr = '{{ $attribute_value_index }}';

        x_attr = 1; //initialize text box count
        $(add_button_attr).click(function (e) { //on add input button click
            e.preventDefault();
            if (x_attr < max_fields_attr) { //max input box allowed
                x_attr++; //text box increment

                // Load by Ajax
                loadAttributeValueRow(wrapper_attr, row_index_attr);
                row_index_attr++;
            }
        });


    });

    function removeRow(selector) {
        selector.closest('td').closest('tr').remove();
        x_attr--;
    }


    // Load the table Row for Attribute value section by Ajax call
    function loadAttributeValueRow(wrapper, row_index) {

        $.ajax({
            method: 'GET',
            url: '{!! route($base_route.'.attribute-value-row') !!}'.replace('%7Bindex%7D', row_index),
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


