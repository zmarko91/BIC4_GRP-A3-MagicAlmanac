@extends('layouts.app')


@section('content')
    <section class="section is-fullwidth">
        <spell :current-spell="{{ $spell->load('user') }}"
              :current-messages="{{ $spell->messages->load('user')->sortByDesc('created_at') }}" :current-user="{{ auth()->user() }}"></spell>
    </section>
@endsection
