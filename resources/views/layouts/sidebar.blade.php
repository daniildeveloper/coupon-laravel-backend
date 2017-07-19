<aside class="sidebar-left">
  <ul class="nav nav-tabs nav-stacked nav-coupon-category nav-coupon-category-left">
    @foreach(\App\Model\CouponsCategory::all() as $c)
      <li>
        <a href="{{route("category", ["cat" => $c->id])}}">
          <i class="@if($c->icon_type === 'fontawesome') {{$c->icon}} @endif"></i>
          {{$c->title}}
        </a>
      </li>
    @endforeach
  </ul>
</aside>