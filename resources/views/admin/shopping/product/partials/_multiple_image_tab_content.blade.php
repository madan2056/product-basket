<fieldset style="border: 1px solid #ddd;">
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
                    url: '{{ url('admin/product/multiple-image-html') }}',
                @else
                    url: '{{ url('admin/product/multiple-image-html') }}'+'?for=edit&key='+'{{ $data['primary_key'] }}',
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