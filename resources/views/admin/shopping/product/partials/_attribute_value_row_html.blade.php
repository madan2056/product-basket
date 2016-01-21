<tr>
    <td class="text-left">
        <section>
            <label class="input">
                {{--<label class="label">{{ trans($trans_path . 'general.columns.attribute') }}</label>--}}
                <select name="attribute[{{ $index }}][attribute_pk]" class="form-control select2">
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
                <input type="number" name="attribute[{{ $index }}][sort_order]" value="" min='0' max='999'>
            </label>
            {{ ViewHelper::showValidationError($errors, 'sort_order') }}
            <div class="note">
                {!! trans($trans_path . 'general.columns.sort-order-note') !!}
            </div>
        </section>
    </td>
    <td class="text-left">
        {{--<label class="label">{{ trans($trans_path . 'general.columns.image') }}</label>--}}
        @foreach($languages as $language)
            <section>
                <label class="textarea">
                    <img class="icon-prepend auto-height-width" src="{{ asset($lang_image_path.$language->image) }}" alt=""/>
                    <textarea name="attribute[{{ $index }}][value][{{ $language->id }}]" rows="6"></textarea>
                </label>
            </section>
        @endforeach
    </td>
    <td class="text-left">
        <span class="btn btn-danger btn-recover" onclick="return removeRow(this);"><i class=" fa fa-remove"></i></span>
    </td>
</tr>