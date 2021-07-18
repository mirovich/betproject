@extends('layouts.admin')

@section('content')
    <style>
        .create_tournament {
            position: fixed; /* Фиксированное положение */
            right: 70%; /* Расстояние от правого края окна браузера */
            bottom: 0%; /* Расстояние сверху */
            padding: 10px; /* Поля вокруг текста */
            z-index: 9999;
        }

    </style>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="/admin">Главная</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Добавить турнир</span>
            </li>
        </ul>
    </div>
    @include('layouts.partials.admin.flash')
    @error('matches')
    <p class="alert alert-warning">{{$message}}
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    </p>
    @enderror
    <h1 class="page-title"> Создание нового турнира </h1>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-body">
                    <form method="post" action="/admin/tournaments" enctype="multipart/form-data"
                          class="horizontal-form" id="save">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="matches" id="matchesInput" value=""/>
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group @error('name') has-error @enderror">
                                        <label class="control-label">Название турнира</label>
                                        <input type="text" class="form-control "
                                               placeholder="Название лиги"
                                               name="name">
                                        @error('name')
                                        <label class="control-label has-error" role="alert">
                                            {{ $message }}
                                        </label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group @error('start_date') has-error @enderror input-daterange">
                                        <label class="control-label">Дата начала</label>
                                        <input type="text" name="start_date" class="form-control datepicker">
                                        @error('start_date')
                                        <label class="control-label has-error" role="alert">
                                            {{ $message }}
                                        </label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div
                                        class="form-group @error('start_date_time') has-error @enderror input-daterange">
                                        <label class="control-label">Время начала</label>
                                        <input type="text" name="start_date_time" class="form-control timepicker">
                                        @error('start_date_time')
                                        <label class="control-label has-error" role="alert">
                                            {{ $message }}
                                        </label>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group @error('end_date') has-error @enderror  input-daterange">
                                        <label class="control-label">Дата конца</label>
                                        <input type="text" name="end_date" class="form-control datepicker">
                                        @error('end_date')
                                        <label class="control-label has-error" role="alert">
                                            {{ $message }}
                                        </label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group @error('end_date_time') has-error @enderror input-daterange">
                                        <label class="control-label" for="">Время конца</label>
                                        <input type="text" name="end_date_time" class="form-control timepicker">
                                        @error('end_date_time')
                                        <label class="control-label has-error" role="alert">
                                            {{ $message }}
                                        </label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group @error('register_end') has-error @enderror input-daterange">
                                        <label class="control-label" for="">Дата регистрации</label>
                                        <input type="text" name="register_end" class="form-control datepicker">
                                        @error('register_end')
                                        <label class="control-label has-error" role="alert">
                                            {{ $message }}
                                        </label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div
                                        class="form-group  @error('register_end_time') has-error @enderror input-daterange">
                                        <label class="control-label" for="">Время регистрации</label>
                                        <input type="text" name="register_end_time" class="form-control timepicker">
                                        @error('register_end_time')
                                        <label class="control-label has-error" role="alert">
                                            {{ $message }}
                                        </label>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group @error('entrance_fee') has-error @enderror">
                                        <label class="control-label">Вступительный взнос</label>
                                        <input type="text" class="form-control"
                                               placeholder="Вступительный взнос"
                                               name="entrance_fee">
                                        @error('entrance_fee')
                                        <label class="control-label has-error" role="alert">
                                            {{ $message }}
                                        </label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group @error('max_participant') has-error @enderror">
                                        <label class="control-label">Макс. число участников:</label>
                                        <input type="text" class="form-control"
                                               placeholder="Макс. число участников:"
                                               name="max_participant">
                                        @error('max_participant')
                                        <label class="control-label has-error" role="alert">
                                            {{ $message }}
                                        </label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group @error('ensure_won') has-error @enderror">
                                        <label class="control-label">Гарантированный фонд выигрыша</label>
                                        <input type="text" class="form-control"
                                               placeholder="Гарантированный фонд выигрыша:"
                                               name="ensure_won">
                                        @error('ensure_won')
                                        <label class="control-label has-error" role="alert">
                                            {{ $message }}
                                        </label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group @error('status') has-error @enderror">
                                        <label class="control-label">Статус:</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="0">Не активный</option>
                                            <option value="1">Активный</option>
                                            <option value="2">Идет</option>
                                            <option value="3">Завершенный</option>
                                        </select>
                                        @error('status')
                                        <label class="control-label has-error" role="alert">
                                            {{ $message }}
                                        </label>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group @error('logo') has-error @enderror">
                                        <label class="control-label">Лого турнира:</label>
                                        <input type="file" class="form-control"
                                               placeholder="Лого турнира:"
                                               name="logo">
                                        @error('logo')
                                        <label class="control-label has-error" role="alert">
                                            {{ $message }}
                                        </label>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{--                            <div class="row" style="margin-top: 10px;--}}
                            {{--												margin-bottom: 10px;">--}}
                            {{--                                <div class="col-md-12">--}}
                            {{--                                    <div class="form-group">--}}
                            {{--                                        <label class="col-md-12 control-label text-center">--}}
                            {{--                                            <b>% призовых</b>--}}
                            {{--                                        </label>--}}
                            {{--                                        <div class="col-md-12">--}}
                            {{--                                            <input id="range_1" type="text" name="percent_prize"/>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            <div class="form-actions right">
                                <button type="submit" class="btn blue create_tournament" ><i class="fa fa-check"></i>
                                    Создать турнир
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <h1 class="page-title"> Список матчей
        <span style="margin-left: 20px;">
            <a class="btn btn-lg green"
               data-toggle="modal"
               data-target="#add_match"
            > Добавить матч
                <i class="fa fa-plus"></i>
            </a>
        </span>
    </h1>
    <div id="app">
        <league-list></league-list>
    </div>
    <div class="modal fade" id="add_match" tabindex="-1" style="width: 100%;    z-index: 999999;" role="basic"
         aria-hidden="true">
        <div class="modal-dialog" style="width: 85%">
            <div class="modal-content">
                @include('admin.tournament.includes.modal_match_add', ['matches' => $matches])
            </div>
        </div>
    </div>
@endsection
@section('additional_css')
    <link
        rel="stylesheet"
        type="text/css"
        href="https://unpkg.com/select2@4.0.3/dist/css/select2.min.css"
    />
@endsection
@section('additional_js')
    <script src="https://unpkg.com/select2@4.0.3/dist/js/select2.js"></script>
    <script src="{{mix('/assets/admin/js/entry.js')}}"></script>
    <script>
        $(function () {
            $('.datepicker').datetimepicker({format: 'YYYY-MM-DD'});
            $('.timepicker').datetimepicker({format: 'HH:mm'});
        });
    </script>
@endsection
