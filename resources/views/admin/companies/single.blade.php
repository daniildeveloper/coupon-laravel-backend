@extends('admin.layouts.master')

@section("title")
{{$company->name}}
@endsection

@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>
                {{$company->name}}
            </h2>
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up">
                        </i>
                    </a>
                </li>
            </ul>
            <div class="clearfix">
            </div>
        </div>
        <div class="x_content">
            <div class="col-md-7 col-sm-7 col-xs-12">
                <div class="product-image">
                    <img alt="{{$company->name}}" src="{{asset("$company->seller_logo")}}">
                    </img>
                </div>
            </div>
            <div class="col-md-5 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">
                <h3 class="prod_title">
                    {{$company->seller_name}}
                </h3>
                <p>
                    {{$company->seller_address}}
                </p>
                <p>{{ App\Model\CompanyType::find($company->seller_company_type)->name }}</p>
                <p>
                    Основной номер:
                    <a href="tel:{{ $company->seller_primary_phone }}">{{ $company->seller_primary_phone }}</a>
                </p>
                <p>
                    Добавочный номер:
                    <a href="tel:{{ $company->seller_primary_phone }}">{{ $company->seller_primary_phone }}</a>
                </p>
                <hr>
                {{-- Confirm data --}}
                @if($company->confirmed === 0)
                    <a href="{{ route('to-family', ['id' => $company->id]) }}" class="btn btn-success">Подтвердить данные</a>
                @endif
                {{-- end data confirmation --}}
            </div>
            {{-- TODO: coupon show --}}
            {{-- <div class="col-md-12">
                <div class="" data-example-id="togglable-tabs" role="tabpanel">
                    <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                        <li class="active" role="presentation">
                            <a aria-expanded="true" data-toggle="tab" href="#tab_content1" id="home-tab" role="tab">
                                Home
                            </a>
                        </li>
                        <li class="" role="presentation">
                            <a aria-expanded="false" data-toggle="tab" href="#tab_content2" id="profile-tab" role="tab">
                                Profile
                            </a>
                        </li>
                        <li class="" role="presentation">
                            <a aria-expanded="false" data-toggle="tab" href="#tab_content3" id="profile-tab2" role="tab">
                                Profile
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div aria-labelledby="home-tab" class="tab-pane fade active in" id="tab_content1" role="tabpanel">
                            <p>
                                Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher
                              synth. Cosby sweater eu banh mi, qui irure terr.
                            </p>
                        </div>
                        <div aria-labelledby="profile-tab" class="tab-pane fade" id="tab_content2" role="tabpanel">
                            <p>
                                Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
                              booth letterpress, commodo enim craft beer mlkshk aliquip
                            </p>
                        </div>
                        <div aria-labelledby="profile-tab" class="tab-pane fade" id="tab_content3" role="tabpanel">
                            <p>
                                xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui
                              photo booth letterpress, commodo enim craft beer mlkshk
                            </p>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>
@endsection
