@extends('layouts.app')

@section('content')
    <section class="section is-fullheight">
        <dashboard-component title="Dashboard">
            @if (session('status'))
                <query-message :success="true" :fail="false" message="{{ session('status') }}"></query-message>
            @endif
                <p>Welcome <strong>{{ auth()->user()->name }}</strong>.</p>
                <p>Hey, you. You’re finally awake. You were trying to cross the border,
                    right? Walked right into that Imperial ambush, same as us, and that
                    thief over there.</p>
                <p><img src="{{asset('img/logo_transparent.png')}}" width="30" height="14" ><strong> Welcome to Magic Almanac.</strong></p>
        </dashboard-component>
    </section>
@endsection
