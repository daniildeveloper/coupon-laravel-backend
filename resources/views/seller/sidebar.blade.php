<aside class="sidebar-left">
    <ul class="nav nav-tabs nav-stacked nav-coupon-category nav-coupon-category-left">
        <li>
            <a href="{{ route('seller.dashboard') }}">
                <i class="fa fa-dashboard">
                </i>
                Панель управления
            </a>
        </li>
        <li>
            <a href="{{ route('seller.coupons') }}">
                <i class="fa fa-tags">
                </i>
                Купоны
            </a>
        </li>
        <li>
            <a href="{{ route('seller.managers') }}">
                <i class="fa fa-id-card">
                </i>
                Менеджеры
            </a>
        </li>
        <li>
            <a href="{{ route('seller.orders') }}">
                <i class="fa fa-order">
                </i>
                Заказы
            </a>
        </li>
        <li>
            <a href="{{ route('seller.coupons.confirm') }}">
                <i class="fa fa-search-plus">
                </i>
                Проверить купон
            </a>
        </li>
        <li>
            <a href="{{ route('seller.clients') }}">
                <i class="fa fa-address-book-o">
                </i>
                Лояльные клиенты
            </a>
        </li>
        <li>
            <a href="{{ route('seller.payments') }}">
                <i class="fa fa-money">
                </i>
                Платежи
            </a>
        </li>
        <li>
            <a href="{{ route('seller.payments.out') }}">
                <i class="fa fa-money">
                </i>
                Вывод средств
            </a>
        </li>
        {{-- TODO: make active after referal creation --}}
        {{-- <li>
            <a href="{{ route('partners') }}">
                <i class="fa fa-user-group">
                </i>
                Партнерская программа
            </a>
        </li> --}}
        <li>
            <a href="{{ route('accounting') }}">
                <i class="fa fa-file-exel-o">
                </i>
                Отчетность
            </a>
        </li>

        {{-- TODO activate after messages --}}
        {{-- TODO: if is no messages is open. Else new messages and its count --}}
        {{-- <li>
            <a href="{{ route('seller.messanger') }}">
                <i class="fa fa-envelope-o">
                </i>
                Чат
            </a>
        </li> --}}
    </ul>
</aside>