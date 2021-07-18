@extends('layouts.admin')

@section('content')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="/admin">{{ trans('Home') }}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>{{ trans('Games') }}</span>
            </li>
        </ul>
    </div>

    <div class="">
        <a
            type="button"
            class="btn blue btn-sm"
            style="float:right;"
            href="/admin/games/create">{{ trans('Create') }}</a>
        <h1 class="page-title"> {{ trans('Games') }}</h1>
    </div>
    @include('layouts.partials.admin.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-body">
                    <table id="newsTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Статус</th>
                            <th>Участники</th>
                            <th>{{ trans('Manage') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($games as $game)
                            <tr>
                                <td style="vertical-align: middle;">{{$game->id}}</td>
                                <td style="vertical-align: middle;">{{$game->status}}</td>
                                <td style="vertical-align: middle">
                                    {{$game->homeTeam->team_name}} - {{$game->awayTeam->team_name}}
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
@endsection
