@extends('layouts.app')


@section('content')
    <section class="section is-fullwidth">
        <spells :all-spells="{{ $spells }}" :current-user="{{ Auth::user() }}"></spells>
    </section>
@endsection
