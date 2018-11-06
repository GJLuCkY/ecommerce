<div class="mob-proff">
  <div class="mob-proff__name">
    <p><span><img src="/images/proffMob.png" alt="profile_photo"></span> {{ Auth::user()->name }}</p>
  </div>
  <a class="mob-proff__link" href="{{ route('getLogout') }}">Выход</a>
</div>
<ul class="bs-profile__list">
    <li class="{{ Request::path() == 'user/profile' ? 'active' : '' }}">
        <a class="bs-profile__link" href="{{ route('profile.index') }}">Мой профиль</a>
    </li>
    <li class="{{ Request::path() == 'user/profile/wishlist' ? 'active' : '' }}">
        <a class="bs-profile__link" href="{{ route('profile.wishlist') }}">Избранное</a>
    </li>
    <li class="{{ Request::path() == 'user/profile/purchases' ? 'active' : '' }}">
        <a class="bs-profile__link" href="{{ route('profile.purchases') }}">Мои покупки</a>
    </li>
    <li class="{{ Request::path() == 'user/profile/help' ? 'active' : '' }}">
        <a class="bs-profile__link" href="{{ route('profile.help') }}">Помощь</a>
    </li>
    <li>
        <a class="bs-profile__link" href="{{ route('getLogout') }}">Выход</a>
    </li>
</ul>
