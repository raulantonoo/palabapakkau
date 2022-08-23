@extends('errors::minimal')
@extends('layouts_user.app')
<style>
    .messages {
        color: black;
        font-weight: bold;
        border-radius: 1.2rem;
        background: #000046;
        /* fallback for old browsers */
        background: -webkit-linear-gradient(to left, #ffff, #61d2f2, #1CB5E0, #000046);
        /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to left, #ffff, #61d2f2, #1CB5E0, #000046);
        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }
</style>
@section('content')
@section('title', 'silahkan login')
@section('message')
<div class="col md-6 m-auto " style="margin-top:6%">
    <img class="m-auto" src="{{ asset('../images/ikon.png') }}" style="width:200px;height:auto;margin-top:10% !important; margin-left:auto !important;margin-right:auto !important; display: block;">
    <div class="messages  m-auto">
        <h4 class="p-3">
            <b>
                Silahkan login terlebih dahulu...
            </b>
        </h4>
    </div>
</div>

@endsection