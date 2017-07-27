  <div class="global-wrap">
    <div class="top-main-area">
      <div class="container">
        <div class="row">
          <div class="col-md-2">
            <a class="logo mt5" href="/"><img src="{{asset("images/logo-inline.png")}}" alt="{{ env('APP_NAME') }}" title="{{ env('APP_NAME') }}" style="width: 190px"></a>
          </div>
          <div class="col-md-6 col-md-offset-4" style="margin-top: 15px">
            <div class="pull-right">
              <ul class="header-features">
                <li><i class="fa fa-phone"></i>
                  <div class="header-feature-caption">
                    <h5 class="header-feature-title">{{S::getValue("phone")}}</h5>
                    <p class="header-feature-sub-title">24/7 консультация клиентов</p>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <header class="main">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="flexnav-menu-button" id="flexnav-menu-button">Menu</div>
            <nav>
              <ul class="nav nav-pills flexnav" id="flexnav" data-breakpoint="800">
                <li class="active"><a href="/">Все купоны</a></li>
                <li>
                  <a href="{{url("newspaper")}}">Новости</a>
                </li>

                {{-- Проверяем есть ли активные промо акции\Копании. Сезонные пачковые предложения --}}
                {{-- @if(count(DB::table("promo_companies")->where("is_show", 1)->get()))
                  @foreach(DB::table("promo_companies")->where("is_show", 1)->get() as $promo)
                    <li>
                      <a href="promo/{{$promo->slug}}">{{$promo->title}}</a>
                    </li>
                  @endforeach
                @endif --}}
                {{-- заканчиваем первью промо --}}
                <li><a href="{{route('faq')}}">Вопрос-ответ</a></li>
              </ul>
            </nav>
          </div>
          <div class="col-md-6">
            <ul class="login-register">
              {{-- <li>
                <a href="{{ route('favorites') }}">
                  <i class="fa fa-heart"></i>
                  Избранное
                </a>
              </li> --}}
              <li class="shopping-cart"><a href="{{route("shop.cart")}}"><i class="fa fa-shopping-cart"></i>Корзина</a></li>
              @if(Auth::user() === null)
                <li><a class="popup-text" href="#login-dialog" data-effect="mfp-move-from-top"><i class="fa fa-sign-in"></i>Войти</a></li>
                <li><a class="popup-text" href="#register-dialog" data-effect="mfp-move-from-top"><i class="fa fa-edit"></i>Регистрация</a></li>
              @else
                <li><a href="{{route("cabinet")}}"><i class="fa fa-user"></i>{{Auth::user()->name}}</a></li>
                @if(Auth::user()->role === 999)
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-cogs"></i>Админка</a></li>
                @endif
                <li>

                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out"></i>
                        Выйти
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                          style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>

              @endif
            </ul>
          </div>
        </div>
      </div>
    </header>
    {{-- login --}}
    <div class="mfp-with-anim mfp-hide mfp-dialog clearfix" id="login-dialog"><i class="fa fa-sign-in dialog-icon"></i>
      <h3>Вход</h3>
      <h5>Введите свои данные чтобы войти</h5>
      <form class="dialog-form" method="POST" action="{{ route('login') }}" >
      {{ csrf_field() }}
        <div class="form-group">
          <label>Почта</label>
          <input class="form-control" type="text" name="email" placeholder="Почта">
          @if ($errors->has('email'))
              <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
          @endif
        </div>
        <div class="form-group">
          <label>Пароль</label>
          <input class="form-control" type="password" name="password" placeholder="Пароль">
          @if ($errors->has('password'))
              <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
          @endif
        </div>
        <div class="checkbox">
        <label>
          <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>Запомнить меня</label>
        </div>
        <input class="btn btn-primary" type="submit" value="Войти"></form>
      <ul class="dialog-alt-links">
        <li><a class="popup-text" href="#register-dialog" data-effect="mfp-zoom-out">Еще не с нами?</a></li>
        <li><a class="popup-text" href="#password-recover-dialog" data-effect="mfp-zoom-out">Забыли пароль?</a></li>
      </ul>
    </div>
    {{-- end login --}}

    {{-- register --}}
    <div class="mfp-with-anim mfp-hide mfp-dialog clearfix" id="register-dialog"><i class="fa fa-edit dialog-icon"></i>
      <h3>Регистрация новго пользователя</h3>

      <form class="dialog-form" method="POST" action="{{ route('register') }}">
      {{csrf_field()}}
      <div class="form-group">
        <label>Имя</label>
          <input class="form-control" type="text" placeholder="Имя" name="name" value="{{ old('name') }}" required>
          @if ($errors->has('name'))
              <span class="help-block">
                  <strong>{{ $errors->first('name') }}</strong>
              </span>
          @endif
        </div>
        <div class="form-group">
        <label>почта</label>
          <input class="form-control" type="email" placeholder="Почта" name="email" value="{{ old('email') }}">
          @if ($errors->has('email'))
              <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
          @endif
        </div>
        <div class="form-group">
          <label>пароль</label>
          <input class="form-control" type="password" placeholder="Пароль еще раз" name="password" required>
          @if ($errors->has('password'))
              <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
          @endif
        </div>
        <div class="form-group">
          <label>повторите пароль</label>
          <input class="form-control" type="password" placeholder="Пароль еще раз" name="password_confirmation" required>
          @if ($errors->has('password'))
              <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
          @endif
        </div>
        <div class="checkbox">
          <label>
            <input type="checkbox">Подписаться на обновления и предложения</label>
          </div>
          <input class="btn btn-primary" type="submit" value="Зарегистрироваться">
      </form>
      <ul class="dialog-alt-links">
        <li><a class="popup-text" href="#login-dialog" data-effect="mfp-zoom-out">Уже с нами?</a></li>
      </ul>
    </div>
  {{-- register --}}

    <div class="mfp-with-anim mfp-hide mfp-dialog clearfix" id="password-recover-dialog"><i class="icon-retweet dialog-icon"></i>
      <h3>Восстановление пароля</h3>
      <h5>Забыли пароль?</h5>
      <form class="dialog-form"><label>почта</label> <input class="span12" type="text" placeholder="почта"> <input class="btn btn-primary" type="submit" value="Восстановить пароль"></form>
    </div>
    <form class="search-area form-group search-area-white" action="{{route("search") }}">
      <div class="container">
        <div class="row">
          <div class="col-md-2 clearfix">
          </div>
          <div class="col-md-6 clearfix"><label></label>
            <div class="search-area-division search-area-division-input" style="width: 400px;">
              <input class="form-control" type="text" placeholder="Я ищу ...">
            </div>
          </div>
          <div class="col-md-3 clearfix">
            <label><i class="fa fa-map-marker"></i>
              <span>В</span>
            </label>
            <div class="search-area-division search-area-division-location">
              <input class="form-control" type="text" placeholder="Усть-Каменогорск">
            </div>
          </div>
          <div class="col-md-1"><button class="btn btn-block btn-white search-btn" type="submit">Поиск</button></div>
        </div>
      </div>
    </form>
    <div class="gap"></div>
  </div>
