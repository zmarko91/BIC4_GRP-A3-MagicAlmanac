@extends('layouts.app')


@section('content')
    <section class="section is-fullwidth">
        <kinds :all-kinds="{{ $kinds->load('blogs') }}" ></kinds>
    </section>
@endsection
