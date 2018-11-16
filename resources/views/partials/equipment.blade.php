@if(count($equipment) > 0)

<input type="hidden" name="quantity" value="1">
<div class="bs-order__box">
    @foreach($equipment as $item)
    <label class="bs-order__checkLabel" style="display: block">
    <input type="checkbox" name="equipment[]" class="subproducts" value="{{ $item->id }}" data-price="{{ $item->price }}">{{ isset($item->custom_name) ? $item->custom_name : $item->title }}
        <span class="checkmark"></span>
    </label>
    @endforeach
</div>

@endif