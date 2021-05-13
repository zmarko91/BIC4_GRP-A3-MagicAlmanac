@extends('layouts.app')


@section('content')
    <section class="section is-fullheight">
        <spell-form :is-editable="true" :current-spell="{{ $spell }}"></spell-form>
    </section>
@endsection
