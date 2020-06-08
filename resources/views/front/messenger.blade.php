@extends('layouts.master')

@section('content')

<section id="app" class="messenger-page">

    <messenger :friends="{{ json_encode($friends) }}"></messenger>
</section>



@endsection
