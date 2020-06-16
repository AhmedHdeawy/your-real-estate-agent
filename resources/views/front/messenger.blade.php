@extends('layouts.master')

@section('content')

<section class="messenger-page">

    <messenger :friends="{{ json_encode($friends) }}"></messenger>
</section>



@endsection
