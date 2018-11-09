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

                <tr>
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
                @endforeach
            </table>
            <div>
                <p> <b>Доставка: </b> 800 ₸</p>
                <p> <b>Итого: </b>80 800 ₸</p>
            </div>
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