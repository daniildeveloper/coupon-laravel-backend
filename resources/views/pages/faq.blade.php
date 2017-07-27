@extends("layouts.app")

@section('title')
Часто задаваемые вопросы
@endsection

@section('content')
  @if(count($quests) === 0)
    @include('layouts.empty')
  @endif
  <div class="container">
    @foreach($quests as $q)
    <div class="panel-group" id="accordion{{$q->id}}">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                  <a class="collapsed" data-toggle="collapse" aria-expanded="false" data-parent="#accordion{{$q->id}}" href="#collapse-{{$q->id}}">{{$q->quest}}</a>
                </h4>
            </div>
            <div class="panel-collapse collapse" id="collapse-{{$q->id}}">
                <div class="panel-body">
                    <p>{!!$q->answer!!}</p>
                </div>
            </div>
        </div>
    </div>
  @endforeach
  </div>
  
<div class="gap gap-small"></div>
@endsection