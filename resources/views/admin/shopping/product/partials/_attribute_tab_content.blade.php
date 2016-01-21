<fieldset style="border: 1px solid #ddd;">
    <section id="attribute-value-section">

    </section>

</fieldset>

@section('extra_script')
    @parent
    <script>

        $(document).ready(function () {
            loadAttributeValueSection();
        });

        // Load the HTML for Attribute value section by Ajax call
        function loadAttributeValueSection() {

            var attribute_value_section = $('#attribute-value-section');
            attribute_value_section.html('');

            $.ajax({
                method: 'GET',
                @if(!isset($data['primary_key']))
                    url: '{{ url('admin/product/attribute-value-html') }}',
                @else
                    url: '{{ url('admin/product/attribute-value-html') }}'+'?for=edit&key='+'{{ $data['primary_key'] }}',
                @endif
                error: function (request, status, error) {
                    //console.log(request.responseText);
                },
                success: function (data) {

                    var data = jQuery.parseJSON(data);
                    if (data.html)
                        attribute_value_section.append(data.html);
                    else
                        attribute_value_section.html('');
                }
            });
        }

    </script>
    @endsection