@extends('goldenmines.layout')

@section('content')
    <div class="content" id="app">
        <div class="container">
            <tournaments-page>
            </tournaments-page>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ mix('/frontend/app.js') }}"></script>
@endsection
