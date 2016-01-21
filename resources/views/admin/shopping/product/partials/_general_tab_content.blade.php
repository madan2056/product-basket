<div class="widget-body">
    <ul id="language-tab" class="nav nav-tabs bordered">
        @foreach($languages as $key => $language)
            <li <?php echo $key == 0 ? "class='active'" : ''; ?>>
                <a href="#t{{ $key }}" data-toggle="tab" class="input-wimg">
                    <img style="width: 20px;" class="icon-prepend" src="{{ asset($lang_image_path.$language->image) }}" alt=""/>
                    {{ $language->name }}
                </a>
            </li>
        @endforeach
    </ul>
    <div id="language-tab-content" class="tab-content padding-10">

        @foreach($languages as $key => $language)
            <div class="tab-pane fade <?php echo $key == 0 ? "active in" : ''; ?>" id="t{{ $key }}">

                <section>
                    {!! Form::label('name['.$language->id.']', trans($trans_path . 'general.columns.product-name'), ['class' => 'label'] ) !!}
                    <label class="input">
                        <input type="text" name="name[{{ $language->id }}]" value="{{ ViewHelper::getValue('name.'.$language->id, isset($data['name'])?$data['name'][$language->id]:'') }}"
                               id="name{{ $language->id }}" required/>
                    </label>
                    {{ ViewHelper::showValidationError($errors, 'name.'.$language->id) }}
                </section>
                <section>
                    {!! Form::label('short_description['.$language->id.']', trans($trans_path . 'general.columns.short_description'), ['class' => 'label'] ) !!}
                    <label class="input">
                        {!! Form::textarea('short_description['.$language->id.']', ViewHelper::getValue('short_description.'.$language->id, isset($data['short_description'])?$data['short_description'][$language->id]:''), ['class' => 'input-xs description']) !!}
                    </label>
                </section>

                <section>
                    {!! Form::label('description['.$language->id.']', trans($trans_path . 'general.columns.description'), ['class' => 'label'] ) !!}
                    <label class="input">
                        {!! Form::textarea('description['.$language->id.']', ViewHelper::getValue('description.'.$language->id, isset($data['description'])?$data['description'][$language->id]:''), ['class' => 'input-xs description']) !!}
                    </label>
                </section>

                <section>
                    {!! Form::label('meta_title['.$language->id.']', trans($trans_path . 'general.columns.meta_title'), ['class' => 'label'] ) !!}
                    <label class="input">
                        <i class="icon-append fa fa-question-circle"></i>
                        <input type="text" name="meta_title[{{ $language->id }}]"
                               value="{{ ViewHelper::getValue('meta_title.'.$language->id, isset($data['meta_title'])?$data['meta_title'][$language->id]:'') }}" id="meta_title{{ $language->id }}"
                               required/>
                        <b class="tooltip tooltip-top-right">
                            {{ trans($trans_path . 'general.page.create.meta-title-help') }}</b>
                    </label>
                    {{ ViewHelper::showValidationError($errors, 'meta_title.'.$language->id) }}
                </section>

                <section>
                    {!! Form::label('meta_description['.$language->id.']', trans($trans_path . 'general.columns.meta_description'), ['class' => 'label'] ) !!}
                    <label class="input">
                        {!! Form::textarea('meta_description['.$language->id.']', ViewHelper::getValue('meta_description.'.$language->id, isset($data['meta_description'])?$data['meta_description'][$language->id]:''), ['class' => 'form-control']) !!}
                    </label>
                </section>

                <section>
                    {!! Form::label('meta_keywords['.$language->id.']', trans($trans_path . 'general.columns.meta_keywords'), ['class' => 'label'] ) !!}
                    <label class="input">
                        {!! Form::textarea('meta_keywords['.$language->id.']', ViewHelper::getValue('meta_keywords.'.$language->id, isset($data['meta_keywords'])?$data['meta_keywords'][$language->id]:''), ['class' => 'form-control']) !!}
                    </label>
                </section>


            </div>
        @endforeach

    </div>
</div>