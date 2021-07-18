@extends('goldenmines.layout')
@section('content')
    <div class="content" id="app">
        <div class="container">
            <tournament-detail-page :id="{{$tournament->id}}"></tournament-detail-page>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ mix('/frontend/app.js') }}"></script>
@endsection
