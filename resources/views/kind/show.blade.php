@extends('layouts.app')


@section('content')
    <section class="section is-fullwidth">
        <kind :kind="{{ $kind }}" :user="{{ Auth::user() }}" :spells="{{$kind->spells->load('spell')}}"></kind>
    </section>
@endsection
