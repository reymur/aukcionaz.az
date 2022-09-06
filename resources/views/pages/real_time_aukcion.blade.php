@extends('layouts.app')

@section('content')
    <div class="container-xl container-lg">
        <main-aukcion-page :users="{{ $users }}"
        ></main-aukcion-page>
    </div>
@endsection
