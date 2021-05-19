@extends('layouts.app')


@section('content')
    <section class="section is-fullwidth">
        <spell-search :current-user="{{ Auth::user() }}"></spell-search>
    </section>
@endsection
