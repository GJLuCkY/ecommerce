<!-- textarea -->
<div @include('crud::inc.field_wrapper_attributes') >
    <label>{!! $field['label'] !!}</label>
    @include('crud::inc.field_translatable_icon')
    {{--{{ $field['name'] }}--}}
    {{--{{ old($field['name']) ? old($field['name']) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : '' )) }}--}}
    <?php


    ?>

    @if(old($field['name']))
        {{ old($field['name']) }}
    @else
     
        @if(isset($field['value']))
            <table class="table table-bordered">

                <tr>
                    <th>Название</th>
                    <th>Количество</th>
                    <th>Цена</th>
                </tr>
                @foreach($field['value'] as $product)

                <tr style="background: #46d493">
                    <td>
                        {{ $product->name }}
                    </td>

                    <td>
                        {{ $product->qty }}
                    </td>
                    <td>
                        {{ number_format($product->price, 2, ',', ' ') }} ₸
                    </td>
                </tr>
                
                @if(count((array)$product->options->equipments) > 0)
                @foreach($product->options->equipments as $key=>$item)
              
                <tr>
                    <td>
                        {{ $item->name }}
                    </td>

                    <td>
                        Комплектация ↑
                    </td>
                    <td>
                        -
                    </td>
                </tr>
                @endforeach
                @endif
                @endforeach
            </table>
            
        @else

            @if(isset($field['default']))

            @else

            @endif
        @endif
    @endif

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>