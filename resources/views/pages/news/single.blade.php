@extends('layouts.app')

@section('title')
{{ $news->title }}
@endsection

@section('content')
<h1>{{ $news->title }}</h1>
<ol class="breadcrumb">
  <li><a href="/">Главная</a></li>
  <li><a href="{{ route('news') }}">Новости</a></li>
  <li class="active">{{ $news->title }}</li>
</ol>
{!! $news->content !!}
@endsection