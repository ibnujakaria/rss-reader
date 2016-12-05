@extends('template')

@section('title', 'RSS Reader')

@section('body')
<h2>Welcome to RSS Reader</h2>
<a href="{{route('auth.index')}}">Login</a>
@stop