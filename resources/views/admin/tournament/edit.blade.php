@extends('layouts.admin')

@section('content')
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
    <h1 class="page-title"> Создание нового турнира </h1>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-body">
                    <form method="post" action="/admin/tournaments/{{$tournament->id}}" enctype="multipart/form-data"
                          class="horizontal-form" id="save">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="matches" id="matchesInput" value=""/>
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Название турнира</label>
                                        <input type="text" class="form-control"
                                               value="{{$tournament->name}}"
                                               placeholder="Название лиги"
                                               name="name">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-daterange">
                                        <label for="">Дата начала</label>
                                        <input value="{{$tournament->start_date}}" type="text" name="start_date"
                                               class="form-control datepicker">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-daterange">
                                        <label for="">Дата конца</label>
                                        <input type="text" value="{{$tournament->end_date}}" name="end_date"
                                               class="form-control datepicker">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group input-daterange">
                                        <label for="">Дата регистрации</label>
                                        <input type="text" value="{{$tournament->register_end}}" name="register_end"
                                               class="form-control datepicker">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Вступительный взнос</label>
                                        <input type="text" class="form-control"
                                               value="{{$tournament->entrance_fee}}"
                                               placeholder="Вступительный взнос"
                                               name="entrance_fee">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Макс. число участников:</label>
                                        <input type="text" class="form-control"
                                               placeholder="Макс. число участников:"
                                               value="{{$tournament->max_participant}}"
                                               name="max_participant">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Гарантированный фонд выигрыша</label>
                                        <input type="text" class="form-control"
                                               placeholder="Гарантированный фонд выигрыша:"

                                               value="{{$tournament->ensure_won}}"
                                               name="ensure_won">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Статус:</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="0" {{ $tournament->status === 0 ? 'checked' : ''}}>Не
                                                активный
                                            </option>
                                            <option value="1" {{ $tournament->status === 1 ? 'checked' : ''}}>Активный
                                            </option>
                                            <option value="2" {{ $tournament->status === 2 ? 'checked' : ''}}>Идет
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Лого турнира:</label>
                                        <input type="file" class="form-control"
                                               placeholder="Лого турнира:"
                                               name="logo">
                                        <div class="col-md-12">
                                            <img src="{{ $tournament->logo }}" width="50px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px;
												margin-bottom: 10px;">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-12 control-label text-center">
                                            <b>% призовых</b>
                                        </label>
                                        <div class="col-md-12">
                                            <input id="range_1" value="{{$tournament->percent_prize}}" type="text"
                                                   name="percent_prize"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions right">
                                <button type="submit" class="btn blue"><i class="fa fa-check"></i> Обновить
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <h1 class="page-title"> Матчи </h1>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-body">
                    <table id="matches" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Команда 1</th>
                            <th>Команда 2</th>
                            <th>Дата</th>
                            <th>Кофф.</th>
                            <th>Управление</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tournament->games as $game)
                            <tr>
                                <td align="center">
                                    {{$game->homeTeam->team_name}}
                                    <img width="50px" src="{{$game->homeTeam->team_logo}}"/>
                                </td>
                                <td align="center">
                                    {{$game->awayTeam->team_name}}
                                    <img width="50px" src="{{$game->awayTeam->team_logo}}"/>
                                </td>
                                <td align="center">
                                    {{$game->event_date}}
                                </td>
                                <td align="center">
                                    @foreach($game->odds as $odd)
                                        <p>{{$odd->bookmaker->bookmaker_name}} - {{$odd->value}} - {{$odd->odd}}</p>
                                    @endforeach
                                </td>
                                <td align="center" style="vertical-align: middle;">
                                    <a class="btn blue btn-sm"
                                       href="/admin/games/{{ $game->id }}/edit">Редактировать</a>
                                    <a class="btn red btn-sm" href="/admin/games/{{ $game->id }}/delete">Удалить</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-body">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add_match" tabindex="-1" style="width: 100%;    z-index: 999999;" role="basic"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                @include('admin.tournament.includes.modal_match_add', ['matches' => $matches])
            </div>
        </div>
    </div>
@endsection
@section('additional_js')
    <script>
        $(function () {
            $('.datepicker').datepicker({format: 'yyyy-mm-dd'});
            $('#matches').DataTable();
        });
    </script>
@endsection
