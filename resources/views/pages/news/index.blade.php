@extends('layouts.app')

@section('title')
Новости
@endsection

@section('content')
  <div class="container">
    <h1>Новости</h1>

    @if(count($news) === 0)
      <h4>Новостей нет</h4>
      @if(Auth::user() !== null && Auth::user()->role === 999) 
        <a href="{{ route('news.new') }}" class="btn btn-success">Создать новость</a>
      @endif
    @else
      @foreach($news as $n)
        <h3><a href="{{ route('news.id', ['id' => $n->id]) }}">{{ $n->title }}</a></h3>
        <div class="div" style="max-height: 200px; overflow: hidden">
          {!! $n->content !!}
        </div>
        <a href="{{ route('news.id', ['id' => $n->id]) }}" class="content">Читать далее</a>
        
        <hr>
      @endforeach
      {{ $news->links() }}
    @endif
  </div>
@endsection