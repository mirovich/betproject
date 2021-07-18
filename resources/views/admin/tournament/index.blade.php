@extends('layouts.admin')

@section('content')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="/admin">{{ trans('Home') }}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>{{ trans('Tournaments') }}</span>
            </li>
        </ul>
    </div>
    <div class="">
        <a
            type="button"
            class="btn blue btn-sm"
            style="float:right;"
            href="/admin/tournaments/create">{{ trans('Create') }}</a>
        <h1 class="page-title"> {{ trans('Tournaments') }}</h1>
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
                            <th>Имя</th>
                            <th>Статус</th>
                            <th>Начало - Конец</th>
                            <th>{{ trans('Created') }}</th>
                            <th>{{ trans('Manage') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tournaments as $tournament)
                            <tr>
                                <td style="vertical-align: middle;">{{$tournament->id}}</td>
                                <td style="vertical-align: middle;">{{$tournament->name}}</td>
                                <td style="vertical-align: middle;">{{$tournament->status_name}}</td>
                                <td style="vertical-align: middle">
                                    {{$tournament->start_date}} - {{$tournament->end_date}}
                                </td>
                                <td style="vertical-align: middle">
                                    {{$tournament->created_at}}
                                </td>
                                <td align="center" style="vertical-align: middle;">
                                    <a class="btn blue btn-sm" href="/admin/tournaments/{{ $tournament->id }}/edit">Редактировать</a>
                                    <a class="btn red btn-sm" href="/admin/tournaments/{{ $tournament->id }}/delete">Удалить</a>
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
