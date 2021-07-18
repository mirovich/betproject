@extends('layouts.admin')

@section('content')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="/admin">{{ trans('Home') }}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>{{ trans('News') }}</span>
            </li>
        </ul>
    </div>

    <div class="">
        <a
            type="button"
            class="btn blue btn-sm"
            style="float:right;"
            href="/admin/news/create">{{ trans('Create') }}</a>
        <h1 class="page-title"> {{ trans('News') }}</h1>
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
                            <th>Заголовок</th>
                            <th>{{ trans('Created') }}</th>
                            <th>{{ trans('Manage') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($news as $singleNew)
                            <tr>
                                <td style="vertical-align: middle;">{{$singleNew->id}}</td>
                                <td style="vertical-align: middle;">{{$singleNew->title}}</td>
                                <td style="vertical-align: middle;">{{$singleNew->created_at}}</td>
                                <td align="center" style="vertical-align: middle;">
                                    <a class="btn blue btn-sm" href="/admin/news/{{ $singleNew->id }}/edit">Редактировать</a>
                                    <a class="btn red btn-sm" href="/admin/news/{{ $singleNew->id }}/delete">Удалить</a>
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
