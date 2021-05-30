@extends('layouts.app')

@section('content')
    <section class="section is-fullheight">
        <dashboard-component title="Dashboard">
            @if (session('status'))
                <query-message :success="true" :fail="false" message="{{ session('status') }}"></query-message>
            @endif
            <p>Welcome <strong>{{ auth()->user()->name }}</strong></p>
        </dashboard-component>
    </section>
@endsection
