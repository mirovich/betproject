@extends('layouts.admin')

@section('content')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="/admin">Главная</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Редактировать новость</span>
            </li>
        </ul>
    </div>

    <h1 class="page-title"> Редактирование новости </h1>

    @include('layouts.partials.admin.flash')

    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-body">
                    <form method="post" action="/admin/news/{{$single->id}}" class="horizontal-form">
                        <input name="id" value="{{$single->id}}" type="hidden">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">
                                            <b>Название</b>
                                        </label>
                                        <input type="text" class="form-control" placeholder="Название новости"
                                               name="title"
                                               value="{{ $single->title }}">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">
                                            <b>Полный текст</b>
                                        </label>
                                        <textarea type="text" class="form-control" placeholder="Полный текст"
                                                  name="full_text">{!! $single->full_text !!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions right">
                            <button type="submit" class="btn blue"><i class="fa fa-check"></i> Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
