<footer class="main">
    <div class="footer-top-area">
        <div class="container">
            <div class="row row-wrap">
                <div class="col-md-3">
                    <a href="/">
                        <img src="{{asset("images/logo-inline.png")}}" alt="logo" title="logo" class="logo" style="width: 170px">
                    </a>
                    <ul class="list list-social">
                        <li>
                            <a class="fa fa-facebook box-icon" href="#" data-toggle="tooltip" title="Facebook"></a>
                        </li>
                        <li>
                            <a class="fa fa-twitter box-icon" href="#" data-toggle="tooltip" title="Twitter"></a>
                        </li>
                        <li>
                            <a class="fa fa-vk box-icon" href="#" data-toggle="tooltip" title="VK"></a>
                        </li>
                        <li>
                            <a class="fa fa-instagram box-icon" href="#" data-toggle="tooltip" title="Instagram"></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h4>Подписаться на рассылку</h4>
                    <div class="box" style="margin: 0; width: 100%; min-width: 100%; height: inherit;">
                        <form>
                            <div class="form-group mb10">
                                <label>E-mail</label>
                                <input type="text" class="form-control" />
                            </div>
                            <p class="mb10">Только самые интересные предложения</p>
                            <input type="submit" class="btn btn-primary" value="Подписаться" />
                        </form>
                    </div>
                </div>
                <div class="col-md-3">
                    <img src="{{asset('images/download-play-store.png')}}" alt="" class="img-responsive">
                </div>
                <div class="col-md-3">
                    <div class="widget footer_widget">
                        <div class="caption footer-caption">
                            <h3>Для компаний</h3>
                        </div>
                        <div class="widget-list">
                            <ul class="list-unstyled faq">
                                <li><a href="{{route("c-add")}}">Разместить купон</a></li>
                                {{-- <li><a href="#">Разместить акцию</a></li> --}}
                                <li><a href="#">Запросить консультацию</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <p>Copyright © {{\Carbon\Carbon::now()->year}}, Coupon Land, Все права защищены</p>
                </div>
            </div>
        </div>
    </div>
</footer>
