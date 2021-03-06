<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>

<li><a href="{{backpack_url('page') }}"><i class="fa fa-file-o"></i> <span>Страницы</span></a></li>
<li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/slider') }}"><i class="fa fa-sliders"></i> <span>Слайдер</span></a></li>
{{-- <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/menu-item') }}"><i class="fa fa-list"></i> <span>Menu</span></a></li> --}}
<li class="treeview">
    <a href="#"><i class="fa fa-newspaper-o"></i> <span>Новости</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        {{-- <li><a href="{{ backpack_url('category') }}"><i class="fa fa-list"></i> <span>Категории</span></a></li> --}}
        <li><a href="{{ backpack_url('article') }}"><i class="fa fa-list-alt"></i> <span>Новости</span></a></li>
        {{-- <li><a href="{{ backpack_url('tag') }}"><i class="fa fa-tag"></i> <span>Тэги</span></a></li> --}}

        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/advice') }}"><i class="fa fa-hand-o-up"></i> <span>Советы</span></a></li>
    </ul>
</li>


<li class="treeview">
    <a href="#"><i class="fa fa-product-hunt"></i> <span>Номенклатура</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/category') }}"><i class="fa fa-list-ol"></i> <span>Категории</span></a></li>
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/product') }}"><i class="fa fa-product-hunt"></i> <span>Продукты</span></a></li>
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/review') }}"><i class="fa fa-users"></i> <span>Отзывы</span></a></li>
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/order') }}"><i class="fa fa-money"></i> <span>Заказы</span></a></li>
    </ul>
</li>

<li class="treeview">
        <a href="#"><i class="fa fa-th-list"></i> <span>Фильтры</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
            <li><a href="{{ backpack_url('filter') }}"><i class="fa fa-list-ul"></i> <span>Категории фильтра</span></a></li>
            <li><a href="{{ backpack_url('value') }}"><i class="fa fa-outdent"></i> <span>Значения фильтра</span></a></li>
        </ul>
    </li>

    <li class="treeview">
            <a href="#"><i class="fa fa-map-marker"></i> <span>Адреса</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/city') }}"><i class="fa fa-globe"></i> <span>Города</span></a></li>
                    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/address') }}"><i class="fa fa-map-pin"></i> <span>Адреса</span></a></li>
            </ul>
        </li>   


<li class="treeview">
    <a href="#"><i class="fa fa-address-card-o"></i> <span>Вакансия</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li><a href="{{ backpack_url('vacancy-city') }}"><i class="fa fa-globe"></i> <span>Города</span></a></li>
        <li><a href="{{ backpack_url('vacancy') }}"><i class="fa fa-id-badge"></i> <span>Вакансии</span></a></li>
    </ul>
</li>

<li><a href="{{ backpack_url('elfinder') }}"><i class="fa fa-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li>
{{-- <li><a href='{{ url(config('backpack.base.route_prefix', 'admin').'/backup') }}'><i class='fa fa-hdd-o'></i> <span>Backups</span></a></li>
<li><a href="{{ backpack_url('log') }}"><i class="fa fa-terminal"></i> <span>Logs</span></a></li> --}}
<li><a href='{{ url(config('backpack.base.route_prefix', 'admin') . '/setting') }}'><i class='fa fa-cog'></i> <span>Настройки</span></a></li>