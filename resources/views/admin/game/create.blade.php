@extends('layouts.admin')

@section('content')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="/admin">Главная</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Добавить матчи</span>
            </li>
        </ul>
    </div>
    <h1 class="page-title"> Создание новых матчей </h1>
    <div id="app" x-data="data()">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Строка поиска матча:</label>
                                    <input type="text" class="form-control datepicker"
                                           placeholder="Введите дату матча" value="">
                                </div>
                                <div class="form-group">
                                    <button class="btn blue" x-on:click="doSearch" x-text="searchText"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <template x-if="matches.length">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-body">
                            <table id="matchesTable" class="table table-striped table-bordered" cellspacing="0"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th>ID:</th>
                                    <th>Дата начала:</th>
                                    <th>Раунд</th>
                                    <th>Статус</th>
                                    <th>Стадион</th>
                                    <th>Лига</th>
                                    <th>Хозяин(команда)</th>
                                    <th>Гость(команда)</th>
                                    <th>Счет</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                <template x-for="(match, index) in matches" :key="index">
                                    <tr>
                                        <td x-text="match.fixture_id"></td>
                                        <td x-text="match.event_date"></td>
                                        <td x-text="match.round"></td>
                                        <td x-text="match.status"></td>
                                        <td x-text="match.venue"></td>
                                        <td x-text="match.league.name + ' ' + match.league.country"></td>
                                        <td x-text="match.homeTeam.team_name"></td>
                                        <td x-text="match.awayTeam.team_name"></td>
                                        <td x-text="match.score.fulltime"></td>
                                        <td align="center" style="vertical-align: middle;">
                                            <button type="button" class="btn blue btn-sm"
                                                    x-text="parse.indexOf(match.fixture_id) > -1 ? 'Уже существует' : 'Сохранить'"
                                                    x-on:click="saveMatch(match)">
                                            </button>
                                        </td>
                                    </tr>
                                </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
@endsection
@section('additional_js')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.3.5/dist/alpine.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
    <script>
        $('.datepicker').datepicker();

        function data() {
            return {
                date: '{{Carbon\Carbon::now()->format("Y-m-d")}}',
                matches: [],
                searchText: 'Найти',
                parse: [],
                saveMatch(match) {
                    axios.post('/admin/games', {match: match})
                        .then(result => {
                            if (result.status === 200) {
                                alert('Матч сохранен')
                                this.parse.push(match.fixture_id);
                            }
                        })
                },
                doSearch() {
                    axios.post('/admin/games/parse', {date: this.date})
                        .then(result => {
                            if (result.status === 200) {
                                this.matches = result.data.fixtures;
                            }
                        })
                }
            }
        }
    </script>
@endsection
