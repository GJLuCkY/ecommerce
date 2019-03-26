<!-- select2 multiple -->

<?php
$filters = $field['model']::with(['filter'])->get();
?>

<div @include('crud::inc.field_wrapper_attributes') >

    @include('crud::inc.field_translatable_icon')


    <div class="col-md-12">
        <label>Выберите фильтры</label>
        <select
                name="{{ $field['name'] }}[]"
                style="width: 100%"
                @include('crud::inc.field_attributes', ['default_class' =>  'form-control select2_multiple'])
                multiple
                id="temirlan">

            @if (isset($field['allows_null']) && $field['allows_null']==true)
                <option value="">-</option>
            @endif

            @if (isset($field['model']))

                @foreach ($filters as $connected_entity_entry)


                    @if( (old($field["name"]) && in_array($connected_entity_entry->getKey(), old($field["name"]))) || (is_null(old($field["name"])) && isset($field['value']) && in_array($connected_entity_entry->getKey(), $field['value']->pluck($connected_entity_entry->getKeyName(), $connected_entity_entry->getKeyName())->toArray())))
                        <option value="{{ $connected_entity_entry->getKey() }}" selected>{{ $connected_entity_entry->filter->name }} -> {{ $connected_entity_entry->{$field['attribute']} }}</option>
                    @else
                        <option value="{{ $connected_entity_entry->getKey() }}">{{ $connected_entity_entry->filter->name }} -> {{ $connected_entity_entry->{$field['attribute']} }}</option>
                    @endif
                @endforeach
            @endif
        </select>
    </div>







    @if(isset($field['select_all']) && $field['select_all'])
        <a class="btn btn-xs btn-default select_all" style="margin-top: 5px;"><i class="fa fa-check-square-o"></i> {{ trans('backpack::crud.select_all') }}</a>
        <a class="btn btn-xs btn-default clear" style="margin-top: 5px;"><i class="fa fa-times"></i> {{ trans('backpack::crud.clear') }}</a>
    @endif

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>


{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}
@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))

    {{-- FIELD CSS - will be loaded in the after_styles section --}}
    @push('crud_fields_styles')
    <!-- include select2 css-->
    <link href="{{ asset('vendor/adminlte/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <style>
        .filter-category-span{
            color: black;
        }
        .filter-filter-span{
            color: black;
            font-weight: 500;
        }
        .filter-value-span{
            color: red;
            font-weight: 500;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #fff;
            color: black;
            border: 1px solid #aaa;
            border-radius: 4px;
            cursor: default;
            float: left;
            margin-right: 5px;
            margin-top: 5px;
            padding: 0 5px;
        }
    </style>
    @endpush

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
    <!-- include select2 js-->
    <script src="{{ asset('js/select2.js') }}"></script>
    <script>
        jQuery(document).ready(function($) {
            // trigger select2 for each untriggered select2_multiple box
            $('.select2_multiple').each(function (i, obj) {
                if (!$(obj).hasClass("select2-hidden-accessible"))
                {
                    var $obj = $(obj).select2({
                        theme: "bootstrap"
                    });

                    var res = [];
                    @if (isset($field['model']))
                        @foreach ($field['model']::all() as $connected_entity_entry)
                            res.push('<b>' + {{ $connected_entity_entry->getKey() }} + '</b>');
                    @endforeach
                @endif

                @if(isset($field['select_all']) && $field['select_all'])
                    $(obj).parent().find('.clear').on("click", function () {
                        $obj.val([]).trigger("change");
                    });
                    $(obj).parent().find('.select_all').on("click", function () {
                        $obj.val(options).trigger("change");
                    });
                    @endif
                }
            });
        });
    </script>

    <script>
        $( document ).ready(function() {
            var filterText = $(".select2-selection__choice");
            var removeHTML = '<span class="select2-selection__choice__remove" role="presentation">×</span>';
            filterText.each(function( index ) {
                var xText = $( this ).text();
                var text = xText.substring(1, xText.length);
                var divider = '->';
                var obj = text.split(divider);
                var category = '<span class="filter-category-span">' + obj[0] + '</span> ->';
                var filter = '<span class="filter-filter-span">' + obj[1];

                var result = removeHTML + category + filter;
                $(this).html(result);
            });
        });
    </script>
    <script>
        $("#temirlan").select2().on("change", function(e) {
            var filterText = $(".select2-results__option");

            filterText.each(function( index ) {
                var xText = $( this ).text();
                var text = xText.substring(1, xText.length);
                var divider = '->';
                var obj = text.split(divider);
                var category = '<span class="filter-category-span">' + obj[0] + '</span> ->';
                var filter = '<span class="filter-filter-span">' + obj[1];

                var result = category + filter;
                $(this).html(result);
            });
        });
        $("#temirlan").select2().on("change", function(e) {
            var filterText = $(".select2-selection__choice");
            var removeHTML = '<span class="select2-selection__choice__remove" role="presentation">×</span>';
            filterText.each(function( index ) {
                var xText = $( this ).text();
                var text = xText.substring(1, xText.length);
                var divider = '->';
                var obj = text.split(divider);
                var category = '<span class="filter-category-span">' + obj[0] + '</span> ->';
                var filter = '<span class="filter-filter-span">' + obj[1];

                var result = removeHTML + category + filter;
                $(this).html(result);
            });
            var filterText = $(".select2-results__option");

            filterText.each(function( index ) {
                var xText = $( this ).text();
                var text = xText.substring(1, xText.length);
                var divider = '->';
                var obj = text.split(divider);
                var category = '<span class="filter-category-span">' + obj[0] + '</span> ->';
                var filter = '<span class="filter-filter-span">' + obj[1];

                var result = category + filter;
                $(this).html(result);
            });
        });
        $("#temirlan").select2().on("change", function(e) {
            var filterText = $(".select2-selection__choice");
            var removeHTML = '<span class="select2-selection__choice__remove" role="presentation">×</span>';
            filterText.each(function( index ) {
                var xText = $( this ).text();
                var text = xText.substring(1, xText.length);
                var divider = '->';
                var obj = text.split(divider);
                var category = '<span class="filter-category-span">' + obj[0] + '</span> ->';
                var filter = '<span class="filter-filter-span">' + obj[1];

                var result = removeHTML + category + filter;
                $(this).html(result);
            });
            var filterText = $(".select2-results__option");

            filterText.each(function( index ) {
                var xText = $( this ).text();
                var text = xText.substring(1, xText.length);
                var divider = '->';
                var obj = text.split(divider);
                var category = '<span class="filter-category-span">' + obj[0] + '</span> ->';
                var filter = '<span class="filter-filter-span">' + obj[1];

                var result = category + filter;
                $(this).html(result);
            });
        });








    </script>

    @endpush

@endif
{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}
