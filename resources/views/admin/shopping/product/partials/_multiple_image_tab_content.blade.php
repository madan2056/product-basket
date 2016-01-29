<fieldset style="border: 1px solid #ddd;">

    <section>
        <label class="label">{{ trans($trans_path . 'general.columns.primary-image') }}</label>
        <label class="input">
            @if(isset($data['image']))
                <img src="{{ asset($image_path . $data['image']) }}" class="img-responsive" alt="img">
            @else
                <img src="{{ asset(config('neptrox.asset_path.admin.smart').'img/default.jpg') }}" class="img-responsive" alt="img">
            @endif
        </label>
    </section>

    <section>
        {!! Form::label('file', trans($trans_path . 'general.columns.primary-image'), ['class' => 'label'] ) !!}
        <label class="input">
            {!! Form::file('file', null, ['class' => 'input-xs', 'id' => 'files']) !!}
        </label>
        {{ ViewHelper::showValidationError($errors, 'file') }}
    </section>


    <section>
        <hr />
    </section>


    <section id="multiple-image-section">

    </section>

</fieldset>

@section('extra_script')
    @parent
    <script>

        $(document).ready(function () {
            loadMultipleImageSection();
        });

        // Load the HTML for multiple image section by Ajax call
        function loadMultipleImageSection() {

            var multiple_image_section = $('#multiple-image-section');
            multiple_image_section.html('');

            $.ajax({
                method: 'GET',
                @if(!isset($data['primary_key']))
                    url: '{{ route($base_route.'.multiple-image-html') }}',
                @else
                    url: '{{ route($base_route.'.multiple-image-html') }}'+'?for=edit&key='+'{{ $data['primary_key'] }}',
                @endif
                error: function (request, status, error) {
                    //console.log(request.responseText);
                },
                success: function (data) {

                    var data = jQuery.parseJSON(data);
                    if (data.html)
                        multiple_image_section.append(data.html);
                    else
                        multiple_image_section.html('');
                }
            });
        }

    </script>
@endsection