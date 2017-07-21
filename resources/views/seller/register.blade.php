@extends('layouts.app')

@section('title')
Регистрация
@endsection

@section('content')
  <form role="form" method="POST" class="container">
    {{ csrf_field() }}
    <div class="container">
      <h1>Регистрация новой компании</h1>
    </div>
    @if(!Auth::user())
      <div class="container">
        <h2>Новый пользователь</h2>
      </div>
      <div class="row">
        {{-- left column for register user --}}
        <div class="col-md-5">
          {{-- company owner name --}}
          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label for="name" class="col-md-4 control-label">Имя</label>

              <div class="col-md-6">
                  <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                  @if ($errors->has('name'))
                      <span class="help-block">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                  @endif
              </div>
          </div>
          {{-- end company owner name --}}
          
          {{-- company owner email address --}}
          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="col-md-4 control-label">E-Mail</label>

              <div class="col-md-6">
                  <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                  @if ($errors->has('email'))
                      <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
              </div>
          </div>
          {{-- end company owner email address --}}
        </div>
        {{-- end left column for register user --}}

        {{-- right column for register user. here password and password confirm --}}
        <div class="col-md-5">
          {{-- password --}}
          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <label for="password" class="col-md-4 control-label">Пароль</label>

              <div class="col-md-6">
                  <input id="password" type="password" class="form-control" name="password" required>

                  @if ($errors->has('password'))
                      <span class="help-block">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
              </div>
          </div>
          {{-- end password --}}
          
          {{-- password confirm --}}
          <div class="form-group">
              <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

              <div class="col-md-6">
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
              </div>
          </div>
          {{-- end password confirm --}}
        </div>
      </div>
      <hr>
    @endif

    {{-- register company --}}
    <div class="container">
      <h2>Новая компания</h2>
    </div>
    {{-- new company row --}}
    <div class="row row-wrap">

      {{-- left column --}}
      <div class="col-md-5">
        <div class="container">
          <h3>Название и адрес</h3>
        </div>
        <div class="container">
          <div class="row row-wrap">

            {{-- seller name --}}
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <label for="password" class="col-md-12 control-label">Название</label>

              <div class="col-md-5">
                  <input id="seller_name" type="text" class="form-control" name="seller_name" required>

                  @if ($errors->has('seller_name'))
                      <span class="help-block">
                          <strong>{{ $errors->first('seller_name') }}</strong>
                      </span>
                  @endif
              </div>
            </div>
            {{-- end seller name --}}
            
            {{-- seller address --}}
            <div class="form-group{{ $errors->has('seller_name') ? ' has-error' : '' }}">
              <label for="seller_name" class="col-md-12 control-label">Адрес</label>

              <div class="col-md-5">
                  <input id="seller_name" type="text" class="form-control" name="seller_name" required>

                  @if ($errors->has('seller_name'))
                      <span class="help-block">
                          <strong>{{ $errors->first('seller_address') }}</strong>
                      </span>
                  @endif
              </div>
            </div>
            {{-- end seller address --}}

            {{-- seller phone --}}
            <div class="form-group{{ $errors->has('seller_phone') ? ' has-error' : '' }}">
              <label for="password" class="col-md-12 control-label">Телефон</label>

              <div class="col-md-5">
                  <input id="seller_phone" type="text" class="form-control" name="seller_phone" required>

                  @if ($errors->has('seller_phone'))
                      <span class="help-block">
                          <strong>{{ $errors->first('seller_phone') }}</strong>
                      </span>
                  @endif
              </div>
            </div>
            {{-- end seller phone --}}

            {{-- seller second_phone --}}
            <div class="form-group{{ $errors->has('seller_second_phone') ? ' has-error' : '' }}">
              <label for="password" class="col-md-12 control-label">Второй телефон</label>

              <div class="col-md-5">
                  <input id="seller_second_phone" type="text" class="form-control" name="seller_second_phone" required>

                  @if ($errors->has('seller_second_phone'))
                      <span class="help-block">
                          <strong>{{ $errors->first('seller_second_phone') }}</strong>
                      </span>
                  @endif
              </div>
            </div>
            {{-- end seller phone --}}
          </div>
        </div>
      </div>
      {{-- end left column --}}

    </div>
    {{-- end new company row --}}
    <div class="container"><button class="text-center btn btn-success" type="submit">Зарегистрировать</button></div>
  </form>
  {{-- end company creation form --}}
  
@endsection