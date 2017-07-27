@extends('admin.layouts.master')

@section("title")
Новые компании
@endsection

@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
@if(count($companies) === 0)
<h1>Семья теряет популярность!</h1>
@endif

@foreach($companies as $company)
    <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
        <div class="well profile_view">
            <div class="col-sm-12">
                <h4 class="brief">
                    <i>
                       {{$company->name}}
                    </i>
                </h4>
                <div class="left col-xs-7">
                    <h2>
                        {{\App\User::find($company->user_id)->name}}
                    </h2>
                    <p>
                        <strong>
                            О компании:
                        </strong>
                        {{$company->description}}
                    </p>
                    <ul class="list-unstyled">
                        <li>
                            <i class="fa fa-building">
                            </i>
                            Адресс: {{$company->address}}
                        </li>
                        <li>
                            <i class="fa fa-phone">
                            </i>
                            Phone #: {{$company->phone}}
                        </li>
                    </ul>
                </div>
                <div class="right col-xs-5 text-center">
                    <img alt="" class="img-circle img-responsive" src="{{$company->preview_name}}">
                    </img>
                </div>
            </div>
            <div class="col-xs-12 bottom text-center">
                <div class="col-xs-12 col-sm-6 emphasis">
                    <a class="btn btn-primary btn-xs" href="{{route("to-family", ["id" => $company->id])}}">
                        <i class="fa fa-user">
                        </i>
                        Принять в семью
                    </a>
                </div>
            </div>
        </div>
    </div>
@endforeach
</div>
@endsection
