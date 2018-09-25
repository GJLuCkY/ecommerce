@extends('layouts.master')

@section('content')
<article class="container bs-profile">
    <div class="row">
        <div class="col-sm-2 bs-profile__links">
            @include('partials.profile-menu')
        </div>
        <div class="col-sm-10 col">
            <h4 class="bs-profile__head">Мой профиль</h4>
            <div class="bs-profile__prof">
            <form>
                <div>
                <label class="bs-profile__label">Имя:</label>
                <input class="bs-profile__input" type="text" name="name" value="{{ Auth::user()->name }}">
                </div>
                <div>
                <label class="bs-profile__label">Фамилия:</label>
                <input class="bs-profile__input" type="text" name="surname" value="{{ Auth::user()->surname }}">
                </div>
                <div>
                <label class="bs-profile__label">Номер телефона:</label>
                <input class="bs-profile__input" type="text" name="phone" value="{{ Auth::user()->phone }}">
                </div>
                <div>
                <label class="bs-profile__label">E-mail:</label>
                <input class="bs-profile__input" type="email" name="email" value="{{ Auth::user()->email }}">
                </div>
                <button type="submit" class="bs-profile__save">Сохранить</button>
            </form>
            </div>
        </div>
    </div>
</article>
@endsection