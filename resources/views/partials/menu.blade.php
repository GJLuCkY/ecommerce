<ul class="bs-links__list">
    <li class="bs-links__item active"><a href="">Каталог товаров</a></li>
    @foreach($menus as $item)
        <li class="bs-links__item"><a href="{{ asset($item->link) }}">{{ $item->name }}</a></li>
    @endforeach
</ul>