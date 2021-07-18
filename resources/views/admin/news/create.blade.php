@extends('layouts.admin')

@section('content')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="/admin">Главная</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Создать новость</span>
            </li>
        </ul>
    </div>

    <h1 class="page-title"> Создание новости </h1>

    @include('layouts.partials.admin.flash')

    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-body">
                    <form method="post" action="/admin/news" class="horizontal-form">
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
                                               value="">
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
                                                  name="full_text"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">
                                            PUSH нотификация
                                            <input type="checkbox" name="is_push"/>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">
                                            Отправить уведомление в звонок
                                            <input type="checkbox" value="true" name="is_notify"/>
                                        </label>
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
