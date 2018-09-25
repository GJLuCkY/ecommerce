@extends('layouts.master')

@section('content')
    <div id="sign" class="bs-header__modal" style="display: block;position: static;text-align: center;">
        <h1 style="margin-bottom: 40px">Войти</h1>
        <?php
        if (Auth::check()) {
            $authStatus = 'Авторизован';
        } else {
            $authStatus = 'Не авторизован';
        }
        ?>
        <h2>{{ $authStatus }}</h2>
        <!-- Modal content -->
        <div class="bs-header__modal-content row" style="margin: 0px auto;margin-bottom: 100px;">

            <form id="signin">
                {{ csrf_field() }}
                <input type="email" name="email" placeholder="E-mail">
                <small class="signin-error signin-email-error"></small>
                <input type="password" name="password" placeholder="Пароль">
                <small class="signin-error signin-password-error"></small>
                <button type="submit" class="form-btn">Войти</button>
            </form>
        </div>
    </div>
    </form>
@endsection

@section('after_js')
    <script>
        $(function() {
            'use strict';
            $('#signin').on('submit', function(e) {
                e.preventDefault();
                var fd = new FormData( this );
                $.ajax({
                    url: '{{ route('signin') }}',
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    data: fd,
                    beforeSend: function() {
                        $('.form-spinner').show();


                    },
                    error: function(xhr) {
                        $('.form-spinner').hide();
                        var smalls = $("#signin small");
                        $.each(smalls, function(index, value) {
                            $( this ).text('');
                        });
                        var errors = JSON.parse(xhr.responseText).errors;
                        $.each(errors, function(index, value) {
                            var inputName = $('#signin input[name$="' + index + '"]');

                            if(index == inputName[0].name) {
                                $( "#signin .signin-"+ index +"-error" ).text( value );
                            }
                        });
                    },
                    success: function(msg) {
                        $('.form-btn').prop('disabled', true);
                        console.log(1);
                        if(msg === 'ok') {
                             window.location.href = "{{ route('profile.index') }}";
                        } else {
                            $('.form-btn').prop('disabled', false);
                            $('.form-spinner').hide();
                            var errorDate = $(".signin-email-error");
                            errorDate.text('Неправильный логин или пароль');
                        }
                    }
                });
            });
        });

    </script>
@endsection