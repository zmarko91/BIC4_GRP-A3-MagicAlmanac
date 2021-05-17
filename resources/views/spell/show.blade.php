@extends('layouts.app')


@section('content')
    <section class="section is-fullwidth">
        <spell-form :current-Spell="{{ $spell }}" :is-Editable="true" :current-user="{{ auth()->user() }}"></spell-form>
    </section>
@endsection
