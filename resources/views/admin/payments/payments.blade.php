@extends('layouts.admin')

@section('content')
<style>
	.res-payments dl {display: flex;font-size:1.6em;}
	.res-payments dt {padding-right:10px;}
	.res-payments dd {padding-right:10px; font-weight: 700;color: orange}
</style>
<div class="top-bar">
	<h3>{{ __('Payments') }}</h3>
</div>
<div class="res-payments">
	<dl>
		<dt>{{ __('Всего заводов:') }}</dt>
		<dd id="payments-itog" style="white-space: nowrap;">{{number_format($itogo, 2, '.', ' ')}}$</dd>
		<dt>{{ __('Заработано оператором:') }}</dt>
		<dd id="payments-zar" style="white-space: nowrap;">{{number_format($zarabotano, 2, '.', ' ')}}$</dd>
	</dl>
</div>
<div class="portlet light bordered">
	<div class="portlet-body">
        <div class="col-md-4" style="padding-left: 0">
            <div class="form-group">
                <label class="control-label">{{ __('From') }}: </label>
                <input class="date_range_filter date form-control" type="text" id="datepicker_from"/>
            </div>
        </div>
        <div class="col-md-4">
            <label for="" class="control-label">{{ __('To') }}:</label>
            <input class="date_range_filter date form-control" type="text" id="datepicker_to"/>
        </div>
		<table id="paymentsTable" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>{{ __('User') }}</th>
					<th>{{ __('Manager') }}</th>
					<th>{{ __('Amount') }}</th>
					<th>{{ __('Date') }}</th>
				</tr>
			</thead>
			<tbody>
				@if(!empty($a))
				@foreach($a as $b)
				<tr>
					<td>{{$b->id}}</td>
					<td><a href="/user/{{$b->name_id}}" target="blank">{{$b->name}}</a></td>
					<td style="vertical-align: middle;">{{$b->manager}}</td>
					<td>{{$b->amount}}</td>
					<td>{{$b->timestamp}}</td>
				</tr>
				@endforeach
				@else
				<tr>
					<td> <b>{{ __('No data') }}</b> </td>
				</tr>
				@endif
			</tbody>
		</table>
	</div>
</div>
@stop

@section('additional_css')
    <style>
        .ui-datepicker-trigger {
            position: absolute;
            right: 20px;
            top: 32px;
        }
    </style>
@endsection
