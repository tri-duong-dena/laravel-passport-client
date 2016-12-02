@extends('pages.user.index')

@section('content')
<div class="container">
    <p class="content">
        <div class="title">You are authorized!  </div>
        <p>Your email: {{ $authUser->email }} </p>
    </div>
</div>
@stop
