<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<div class="navbarN">
    <div class="navbar-top">
        <ul >
            <div class="navbar-top-left">
                <li class="navbar-link"><a href="javascript:void(0)">Tải Ứng Dụng</a></li>
                <li class="navbar-link"><a href="javascript:void(0)">Kết Nối</a>
                    <a href="javascript:void(0)"><i class="fab fa-facebook-square"></i></a>
                    <a href="javascript:void(0)"><i class="fab fa-twitter-square"></i></a>
                </li>
            </div>
            <div class="navbar-top-right">
                <li class="navbar-link"><a href="javascript:void(0)"><i class="far fa-bell"></i>Thông Báo</a></li>
                <li class="navbar-link"><a href="javascript:void(0)"><i class="far fa-question-circle"></i>Trợ Giúp</a></li>
                @if($user !== null )
                    <div class="account" >
                    <li class="navbar-link" id="loggedIn"><a href="javascript:void(0)"><strong>{{ strlen($user->name) > 25 ? substr($user->name,0, 25)."..." : $user->name }}</strong></a></li>
                        <div class="account-dropdown">
                            <a href="{{ route('user.order') }}"><li>Đơn Hàng</li></a>
                            <a href="{{ route('user.account') }}"><li>Tài Khoản Của Tôi</li></a>
                            <a href="javascript:document.getElementById('logout').submit()" style="color: #2aabd2"><li>Đăng Xuất</li></a>
                        </div>
                    </div>

                @else
                    <li class="navbar-link"><a href="{{ route('register') }}">Đăng Ký</a></li>
                    <li class="navbar-link"><a href="{{ route('login') }}">Đăng Nhập</a></li>
                @endif
            </div>
        </ul>
        <form action="{{ route('logout') }}" method="POST" id="logout">
            {{ csrf_field() }}
        </form>
    </div>
    <div class="navbar-content">
        <div style="width: 1200px; position: relative">
        <div style="display: inline-block">
            <a style="margin-left: 15px" href="{{ route('index') }}"><img src="{{ url('logo.png') }}" alt="logo" width="50px" height="50px"></a>
        </div>
        <div class="search">
            <form class="form-inline" action="{{ route('product.index') }}">
                <input class="form-control col-md-10" id="search" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-light" id="btn-search">Search</button>
                <input type="hidden" name="state" value="false">
            </form>
            <div class="hot-words">
                <a href="javascript:void(0)" class="hot-words-items">aaaa</a>
                <a href="javascript:void(0)" class="hot-words-items">aaaa</a>
                <a href="javascript:void(0)" class="hot-words-items">aaaa</a>
                <a href="javascript:void(0)" class="hot-words-items">aaaa</a>
                <a href="javascript:void(0)" class="hot-words-items">aaaa</a>
            </div>
        </div>
        <div class="cart-dropdown">
            <img src="{{ url('images/cart.png') }}" alt="cart" class="cart-dropdown-hover">
            <div id="cartSize">
                <span style="color: orangered"></span>
            </div>
            @if($user != null)
            <div class="cart-dropdown-menu">

            </div>
            @endif
        </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.cart-dropdown-menu').load('/cart/dropdowncart')
    })

</script>
