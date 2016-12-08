@extends('template')

@section('title', 'RSS Reader')

@section('body')
<div class="jumbotron">
  <h2>Welcome to RSS Reader</h2>
  <a class="btn btn-primary "href="{{route('auth.index')}}"> Get started for free</a>
</div>
<div class="slideshow-container" >

  <div class="mySlides fade">
    <div class="numbertext">1 / 3</div>
    <img class="pict" src="{{asset('dist//image/slideshow/2.jpg')}}" >
    <div class="text">You get news update</div>
  </div>

  <div class="mySlides fade">
    <div class="numbertext">2 / 3</div>
    <img class="pict" src="{{asset('dist//image/slideshow/6.png')}}">
    <div class="text">You can categorize the news items</div>
  </div>

  <div class="mySlides fade">
    <div class="numbertext">3 / 3</div>
    <img class="pict" src="{{asset('dist//image/slideshow/4.png')}}">
    <div class="text">Saved or read it later</div>
  </div>

</div>
<br>

<div style="text-align:center">
  <span class="dot"></span>
  <span class="dot"></span>
  <span class="dot"></span>
</div>

<script src="{{asset('dist/js/slide-show.js')}}"></script>

@stop
