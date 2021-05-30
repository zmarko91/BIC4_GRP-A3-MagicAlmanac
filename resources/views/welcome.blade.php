@extends('layouts.app')

@section('content')
    <section class="hero is-fullheight-with-navbar">
        <div class="container">
            <div class="section is-fullheight">
                <img src="{{asset('img/logo_transparent.png')}}" width="112" height="28" >
                <h1 class="title">

                    {{ env('APP_TITLE', 'Sample application') }}

                </h1>
            </div>
        </div>
    </section>
@endsection
