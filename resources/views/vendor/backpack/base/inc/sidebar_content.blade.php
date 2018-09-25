<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
<li><a href="{{ backpack_url('elfinder') }}"><i class="fa fa-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li>
<li><a href='{{ url(config('backpack.base.route_prefix', 'admin').'/backup') }}'><i class='fa fa-hdd-o'></i> <span>Backups</span></a></li>
<li><a href="{{ backpack_url('log') }}"><i class="fa fa-terminal"></i> <span>Logs</span></a></li>
<li><a href='{{ url(config('backpack.base.route_prefix', 'admin') . '/setting') }}'><i class='fa fa-cog'></i> <span>Settings</span></a></li>
<li><a href="{{backpack_url('page') }}"><i class="fa fa-file-o"></i> <span>Pages</span></a></li>
<li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/menu-item') }}"><i class="fa fa-list"></i> <span>Menu</span></a></li>
<li class="treeview">
    <a href="#"><i class="fa fa-newspaper-o"></i> <span>News</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li><a href="{{ backpack_url('article') }}"><i class="fa fa-newspaper-o"></i> <span>Articles</span></a></li>
        <li><a href="{{ backpack_url('category') }}"><i class="fa fa-list"></i> <span>Categories</span></a></li>
        <li><a href="{{ backpack_url('tag') }}"><i class="fa fa-tag"></i> <span>Tags</span></a></li>
    </ul>
</li>
<li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/slider') }}"><i class="fa fa-list"></i> <span>Слайдер</span></a></li>
<li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/review') }}"><i class="fa fa-list"></i> <span>Отзывы</span></a></li>
<li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/product-category') }}"><i class="fa fa-list"></i> <span>Категории продуктов</span></a></li>
<li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/product') }}"><i class="fa fa-list"></i> <span>Продукты</span></a></li>

<li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/order') }}"><i class="fa fa-list"></i> <span>Заказы</span></a></li>
<li class="treeview">
    <a href="#"><i class="fa fa-newspaper-o"></i> <span>Фильтры</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li><a href="{{ backpack_url('filter') }}"><i class="fa fa-newspaper-o"></i> <span>Категории фильтра</span></a></li>
        <li><a href="{{ backpack_url('value') }}"><i class="fa fa-list"></i> <span>Значения фильтра</span></a></li>
    </ul>
</li>

<li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/city') }}"><i class="fa fa-list"></i> <span>Города</span></a></li>