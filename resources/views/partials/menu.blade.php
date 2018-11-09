<ul class="bs-links__list">
    <li class="bs-links__item active"><a href="">Каталог товаров</a></li>
    @foreach($menus as $item)
        <li class="bs-links__item">
            <a href="{{ route('category', ['catSlug' => $item->slug]) }}">{{ $item->title }}</a>
            
            @if($item->children->count() > 0)
            <div class="dropdown-content">
                @foreach($item->children as $menu)
                <a href="{{ route('category', ['catSlug' => $menu->slug]) }}">{{ $menu->title }}</a>

                @endforeach
            </div>
            @endif
        </li>
    @endforeach
</ul>