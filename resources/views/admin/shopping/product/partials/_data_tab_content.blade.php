<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice{
        float: left;
        margin-right: 5px;
        margin-top: 5px;
        padding: 1px 8px 1px 8px;
        margin: 4px 0 3px 5px;
        position: relative;
        line-height: 18px;
        color: #fff;
        cursor: default;
        border: 1px solid #2a6395;
        -webkit-background-clip: padding-box;
        background-clip: padding-box;
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-color: #3276b1;
        border-radius: 0;
    }
    .select2-selection__choice__remove{
        float: right;
        background: #fff;
        border-radius: 50%;
        width: 12px;
        height: 12px;
        text-align: center;
        line-height: 12px;
        color: #3276B1 !important;
        margin: 3px 5px;
    }
    .select2-container--default .select2-selection--multiple{
        border-radius: 0;
    }
</style>
<fieldset style="border: 1px solid #ddd;">

    @if(isset($data['product_data_id_field']))
        {!! $data['product_data_id_field'] !!}
    @endif

    <section>
        {!! Form::label('sort_order', trans($trans_path . 'general.columns.choose_category'), ['class' => 'label'] ) !!}
        <label class="select select-multiple">
            <select name="product_category[]" multiple class="select2" required>
                @foreach($data['category_dropdown'] as $key => $dd)
                    <option value="{{ $key }}" {{ (isset($dd['active']) && $dd['active'])?'selected="selected"':'' }} >{{ $dd['value'] }}</option>
                @endforeach
            </select>
        </label>
        {{ ViewHelper::showValidationError($errors, 'parent_category') }}
    </section>


    <section style="display: none;">
        {!! Form::label('related_products', trans($trans_path . 'general.columns.related_products'), ['class' => 'label'] ) !!}
        <label class="select select-multiple">
            <select name="related_products[]" class="related_products">
            </select>
        </label>
        {{ ViewHelper::showValidationError($errors, 'related_products') }}
    </section>


    <section>
        {!! Form::label('sku', trans($trans_path . 'general.columns.sku'), ['class' => 'label'] ) !!}
        <label class="input">
            <i class="icon-append fa fa-question-circle"></i>
            <input type="text" name="sku" value="{{ ViewHelper::getValue('sku', isset($data['sku'])?$data['sku']:'') }}" id="sku"/>
            <b class="tooltip tooltip-top-right">
                {{ trans($trans_path . 'general.page.create.product-sku-help') }}</b>
        </label>
        {{ ViewHelper::showValidationError($errors, 'sku') }}

    </section>

    <section>
        {!! Form::label('url', trans($trans_path . 'general.columns.url'), ['class' => 'label'] ) !!}
        <label class="input">
            <i class="icon-append fa fa-question-circle"></i>
            <input type="text" name="url" value="{{ ViewHelper::getValue('url', isset($data['url'])?$data['url']:'') }}" id="url"/>
            <b class="tooltip tooltip-top-right">
                {{ trans($trans_path . 'general.page.create.product-seo-url-help') }}</b>
        </label>
        {{ ViewHelper::showValidationError($errors, 'url') }}
        <div class="note">
            {!! trans($trans_path . 'general.columns.url-note') !!}
        </div>
    </section>

    <section>
        {!! Form::label('price', trans($trans_path . 'general.columns.price'), ['class' => 'label'] ) !!}
        <label class="input">
            <input type="text" name="price" value="{{ ViewHelper::getValue('price', isset($data['price'])?$data['price']:'') }}" id="price"/>
        </label>
        {{ ViewHelper::showValidationError($errors, 'price') }}
        <div class="note">
            {!! trans($trans_path . 'general.columns.price-note') !!}
        </div>
    </section>

    <section>
        {!! Form::label('weight_in', trans($trans_path . 'general.columns.weight_in'), ['class' => 'label'] ) !!}
        <label class="input">
            <select name="weight_in" id="weight_in" class="form-control">
                @if($data['weight_classes'])
                    @foreach($data['weight_classes'] as $weight_class)
                        <option value="{{ $weight_class->primary_key }}" {{ $weight_class->active?'selected':'' }}>{{ $weight_class->title }}</option>
                    @endforeach
                @endif
            </select>
        </label>
        {{ ViewHelper::showValidationError($errors, 'weight_in') }}
    </section>

    <section>
        {!! Form::label('weight', trans($trans_path . 'general.columns.weight'), ['class' => 'label'] ) !!}
        <label class="input">
            <input type="text" name="weight" required value="{{ ViewHelper::getValue('weight', isset($data['weight'])?$data['weight']:'') }}" id="weight"/>
        </label>
        {{ ViewHelper::showValidationError($errors, 'weight') }}
    </section>

    <section>
        {!! Form::label('quantity', trans($trans_path . 'general.columns.quantity'), ['class' => 'label'] ) !!}
        <label class="input">
            {!! Form::number('quantity', ViewHelper::getValue('quantity', isset($data['quantity'])?$data['quantity']:0), ['class' => 'input', 'min' => 0, 'max' => 999]) !!}
        </label>
        {{ ViewHelper::showValidationError($errors, 'quantity') }}
    </section>


    <section>
        {!! Form::label('sort_order', trans($trans_path . 'general.columns.sort-order'), ['class' => 'label'] ) !!}
        <label class="input">
            {!! Form::number('sort_order', ViewHelper::getValue('sort_order', isset($data['sort_order'])?$data['sort_order']:''), ['class' => 'input', 'min' => 0, 'max' => 999, 'required' => 'required']) !!}
        </label>
        {{ ViewHelper::showValidationError($errors, 'sort_order') }}
        <div class="note">
            {!! trans($trans_path . 'general.columns.sort-order-note') !!}
        </div>
    </section>

    <section>
        <label class="label">Is Perishable</label>

        <div class="row">
            <div class="col col-4">
                <?php
                $s1 = 0;
                $s2 = 1;
                if ((isset($data['is_perishable']) && $data['is_perishable'] == 1) || (old('is_perishable') && old('is_perishable') == 1)) {
                    $s1 = '1';
                    $s2 = '0';
                }
                ?>
                <label class="radio">
                    {!! Form::radio('is_perishable', '1', $s1, []) !!}
                    <i></i>Yes
                </label>
                <label class="radio">
                    {!! Form::radio('is_perishable', '0', $s2, []) !!}
                    <i></i>No
                </label>
            </div>
        </div>
    </section>


    <section>
        <label class="label">Is Special</label>

        <div class="row">
            <div class="col col-4">
                <?php
                $s1 = 0;
                $s2 = 1;
                if ((isset($data['is_special']) && $data['is_special'] == 1) || (old('is_special') && old('is_special') == 1)) {
                    $s1 = '1';
                    $s2 = '0';
                }
                ?>
                <label class="radio">
                    {!! Form::radio('is_special', '1', $s1, []) !!}
                    <i></i>Yes
                </label>
                <label class="radio">
                    {!! Form::radio('is_special', '0', $s2, []) !!}
                    <i></i>No
                </label>
            </div>
        </div>
    </section>

    <section>
        <label class="label">Is Featured</label>

        <div class="row">
            <div class="col col-4">
                <?php
                $s1 = 0;
                $s2 = 1;
                if ((isset($data['is_featured']) && $data['is_featured'] == 1) || (old('is_featured') && old('is_featured') == 1)) {
                    $s1 = '1';
                    $s2 = '0';
                }
                ?>
                <label class="radio">
                    {!! Form::radio('is_featured', '1', $s1, []) !!}
                    <i></i>Yes
                </label>
                <label class="radio">
                    {!! Form::radio('is_featured', '0', $s2, []) !!}
                    <i></i>No
                </label>
            </div>
        </div>
    </section>

    <section>
        <label class="label">Status</label>

        <div class="row">
            <div class="col col-4">
                <?php
                $s1 = '1';
                $s2 = '0';
                if ((isset($data['status']) && $data['status'] == 0) || (old('status') && old('status') == 0)) {
                    $s1 = 0;
                    $s2 = 1;
                }
                ?>
                <label class="radio">
                    {!! Form::radio('status', '1', $s1, []) !!}
                    <i></i>Active
                </label>
                <label class="radio">
                    {!! Form::radio('status', '0', $s2, []) !!}
                    <i></i>Inactive
                </label>
            </div>
        </div>
    </section>


</fieldset>