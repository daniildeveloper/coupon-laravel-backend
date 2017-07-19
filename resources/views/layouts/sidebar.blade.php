<aside class="sidebar-left">
        <h3 class="mb20">Я ищу:</h3>
        <ul class="nav nav-tabs nav-stacked nav-coupon-category nav-coupon-category-left">
          @foreach(\App\Model\CouponCategory::all() as $c)
            <li><a href="{{route("category", ["cat" => $c->id])}}"><i class="fa fa-{{$c->icon}}"></i>{{$c->name}}</a></li>
          @endforeach
        </ul>
      </aside>