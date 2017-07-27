<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3></h3>
                <ul class="nav side-menu">
                  <li><a href="/backend"><i class="fa fa-home"></i> Главная </a>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Купоны
                  @if(count(DB::table('coupons')->where("is_new", 1)->get()) > 0)
                        <span class="label label-danger">{{count(DB::table('coupons')->where("is_new", 1)->get())}}</span>
                      @endif
                  <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route("crud-coupon")}}">Все купоны</a></li>

                      <li><a href="{{route("coupons-unconfirmed")}}">Новые купоны
                      @if(count(DB::table('coupons')->where("is_new", 1)->get()) > 0)
                        <span class="label label-danger">{{count(DB::table('coupons')->where("is_new", 1)->get())}}</span>
                      @endif
                      </a></li>
                      {{-- <li><a href="{{route("admin.categories")}}">Категории</a></li> --}}
                      <li>
                    
                        <a href="{{route("categories.all")}}"><i class="fa fa-cogs"></i>Категории купонов</a>
                      </li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-building-o"></i>Компании @if(count(DB::table('companies')->where("confirmed", 0)->get()) > 0)
                      <span class="label label-danger">{{count(DB::table('companies')->where("confirmed", 0)->get())}}</span>
                      @endif <span class="fa fa-building-o"></span></a>
                    <ul class="nav child_menu">
                      
                      <li><a href="{{route("crud-company")}}">Все компании</a></li>

                      <li><a href="{{route("unconfirmed-companies")}}">Новые компании 
                      @if(count(DB::table('companies')->where("confirmed", 0)->get()) > 0)
                      <span class="label label-danger">{{count(DB::table('companies')->where("confirmed", 0)->get())}}</span>
                      @endif
                      </a></li>

                      {{-- <li><a href="{{route("admin.categories")}}">Категории</a></li> --}}
                      <li>
                    {{-- <i class="fa fa-cogs"></i> --}}
                    <a href="{{route("companytypes")}}"><i class="fa fa-cogs"></i>Типы компаний</a>
                  </li>
                    </ul>
                  </li>


                  <li><a><i class="fa fa-money"></i>Платежи <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('payments')}}">Список последних</a></li>
                      {{-- <li><a href="#">Провести платеж</a></li> --}}
                      <li><a href="{{route('pay-set')}}">Настройки платежей</a></li>
                    </ul>
                  </li>

                  {{-- Типы платежей для компаний --}}
                  {{-- <li>
                    <a href="{{route('type')}}" ><i class="fa fa-money"></i>Предложения</a>
                  </li> --}}
                  <li><a href="{{route('banner-top')}}" ><i class="fa fa-volume-up"></i>Баннер</a>
                  </li>
                  {{-- <li>
                    <a>
                      <i class="fa fa-sitemap"></i>Номенклатура <span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('payments')}}">Список типов</a></li>
                      <li><a href="#">Провести платеж</a></li>
                      <li><a href="{{route('pay-set')}}">Настройки платежей</a></li>
                    </ul>
                  </li> --}}

                  {{-- <li><a><i class="fa fa-users"></i>Рефералка <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route("crud-ref-setup")}}">Настройки</a></li>
                      <li><a href="{{route("crud-crud-ref-list")}}">Списки</a></li>
                    </ul>
                  </li>
 --}}
                  <li><a href="{{route("setting.all")}}"><i class="fa fa-cogs"></i>Настройки</a>
                  </li>

                  <li><a href="{{route("faq.all")}}"><i class="fa fa-question-circle-o "></i>Вопрос ответ</a>
                  </li>
                  <li><a href="{{route("news.all")}}"><i class="fa fa-newspaper-o"></i>Новости</a>
                  </li>
                  
                  

                  <li><a href="{{route("trash")}}"><i class="fa fa-trash"></i>Корзина</a>
                  </li>

                  
                </ul> 
              </div>

            </div>
            <!-- /sidebar menu -->