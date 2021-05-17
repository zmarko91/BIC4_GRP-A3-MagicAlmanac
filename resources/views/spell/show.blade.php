@extends('layouts.app')


@section('content')
    <section class="section is-fullwidth">
        <spell-form :is-Editable="false" :current-Spell="{{ $spell }}" ></spell-form>
    </section>
@endsection
