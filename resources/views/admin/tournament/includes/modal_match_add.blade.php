<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">Добавить матчи</h4>
</div>
<div class="modal-body" id="app">

    @foreach($matches as $league)
        <div class="panel panel-default">
            <div class="panel-heading">
                {{$league['league_name']}} {{$league['league_country']}}
                <img width="64" height="64" src="{{$league['league_logo']}}"/>
            </div>
            <div class="panel-body">
                <table class="table table-striped matchesTable table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Выбор</th>
                        <th>Дата матча</th>
                        <th>Команда 1</th>
                        <th>Команда 2</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($league['matches'] as $match)
                        <tr>
                            <td>
                                <input type="checkbox" data-match="{{json_encode($match)}}" class="matchSelecter"/>
                            </td>
                            <td>
                                {{$match['event_date']}}
                            </td>
                            <td>
                                {{$match['homeTeam']->team_name}}
                                <img width="64" height="64" src="{{$match['homeTeam']->logo}}" alt="">
                            </td>
                            <td>
                                {{$match['awayTeam']->team_name}}
                                <img width="64" height="64" src="{{$match['awayTeam']->logo}}" alt="">
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    @endforeach
</div>
<div class="modal-footer">
    <button type="button" class="btn dark btn-outline" data-dismiss="modal">{{ trans('Close') }}</button>
    <button type="submit" id="saveMatches" class="btn green"><i class="fa fa-check"></i> {{ trans('Save') }}</button>
</div>
<script>

    let selectedMatch = [];
    $('.matchSelecter').on('click', function (e) {
        if ($(this).prop("checked") == true) {
            selectedMatch.push($(this).data('match'))
        } else if ($(this).prop("checked") == false) {
            selectedMatch.splice(selectedMatch.findIndex(match => match, fixture_id === $(this).data('match').fixture_id), 1);
        }
    });
    $('#saveMatches').click(function (e) {
        e.preventDefault();
        $("#matchesInput").val(JSON.stringify(selectedMatch));
        $('#add_match').modal('toggle');
    })
    $("#range_1").ionRangeSlider({
        type: "single",
        min: 0.1,
        max: 100,
        step: 0.1
    });
</script>
