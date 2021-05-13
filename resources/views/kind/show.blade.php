@extends('layouts.app')


@section('content')
    <section class="section is-fullwidth">
        <kind :kind="{{ $kind }}" :user="{{ Auth::user() }}" :blogs="{{ $kind->blogs->load(['user','messages']) }}"></kind>
    </section>
@endsection
