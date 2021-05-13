@extends('layouts.app')


@section('content')
    <section class="section is-fullheight">
        <kind-form :is-editable="true" :current-kind="{{ $kind }}"></kind-form>
    </section>
@endsection
