@extends('backpack::layout')

@section('header')
    <section class="content-header">
      <h1>
        {{ trans('backpack::base.dashboard') }}<small>{{ trans('backpack::base.first_page_you_see') }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ backpack_url() }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">{{ trans('backpack::base.dashboard') }}</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">{{ trans('backpack::base.login_status') }}</div>
                </div>

                <div class="box-body">{{ trans('backpack::base.logged_in') }}
                    <form style="border: 4px solid #605ca8;margin-top: 15px;padding: 10px;" action="{{ route('importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                        @csrf
            
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
            
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <p>{{ Session::get('success') }}</p>
                            </div>
                        @endif
                        <h1>Импорт продуктов через excel файл</h1>
                        <div>
                            <label for="category-select">Выберите категорию</label>
                            <select name="category" id="category-select" style="display: block; margin-bottom: 15px;">
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                                <label for="type-select">Выберите тип</label>
                                <select name="type" id="type-select" style="display: block; margin-bottom: 15px;">
                                   
                                    <option value="polotno">Полотно</option>
                                    <option value="thing">Штука</option>
                                    <option value="package">Упаковка</option>
                                   
                                </select>
                            </div>
                        
                        <div>
                        <label for="import-file-input">Выберите excell файл с продуктами и характеристиками <a href="{{ asset('examples/example-import-products.csv') }}" >Скачать пример</a></label>
                            <input type="file" name="import_file" id="import-file-input" style="    margin-bottom: 15px; display:block" required/>
                            
                        </div>

                        <button class="btn btn-primary">Импортировать файл</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
