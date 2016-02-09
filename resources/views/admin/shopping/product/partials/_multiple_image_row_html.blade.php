<tr>
    <td class="text-left">
        <section>
            <label class="input">
                {!! Form::file('multiple_image['.$index.'][file]', null, ['class' => 'input-xs', 'id' => 'files']) !!}
            </label>
        </section>
    </td>
    <td class="text-left">
        <section>
            <label class="input">
                <input type="text" name="multiple_image[{{ $index }}][alt_tag]" value="" >
            </label>
            {{ ViewHelper::showValidationError($errors, 'multiple_image['.$index.'][alt_tag]') }}
        </section>
    </td>
    <td class="text-left">
        <section>
            <label class="input">
                <input type="number" name="multiple_image[{{ $index }}][sort_order]" value="" min='0' max='999'>
            </label>
            {{ ViewHelper::showValidationError($errors, 'multiple_image['.$index.'][sort_order]') }}
        </section>
    </td>
    <td class="text-right">
        <span class="btn btn-danger btn-recover" onclick="return removeRow(this);"><i class=" fa fa-remove"></i></span>
    </td>
</tr>