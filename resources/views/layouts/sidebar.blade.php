<style>
    .chose {
        border-right: 3px solid dodgerblue;
        background-color: #d0d0d0;
    }
    .item-icon {
        width: 32px; height: 32px
    }
    .item-icon img {
        width: 100%;
        height: 100%;
    }
    .container {
        float: left;
    }
</style>

<div class="row row-offcanvas row-offcanvas-left active">
    <!-- sidebar -->
    <div class="column col-sm-2 col-xs-1 sidebar-offcanvas" id="sidebar">
        <ul class="nav" id="menu">
            <li class="menu-items {{ isset($books) ? "chose" : ""}}">
                <a href="{{ route('book.index') }}" title="books manager">
                    <div class="item-icon">
                        <img src="{{ asset('/images/admin/book.png') }}" alt="books">
                        <span class="collapse visible-xs">Book</span>
                    </div>
                </a>
            </li>
            <li class="menu-items {{ isset($categories) ? "chose" : "" }}">
                <a href="{{ route('categories.index') }}" title="categories manager">
                    <div class="item-icon">
                        <img src="{{ asset('/images/admin/category.svg') }}" alt="categories">
                        <span class="collapse visible-xs">Categories</span>
                    </div>
                </a>
            </li>
            <li class="menu-items {{ isset($employees) && !isset($orders) ? "chose" : "" }}">
                <a href="{{ route('employees.index') }}" title="employees manamer">
                    <div class="item-icon">
                        <img src="{{ asset('/images/admin/employee.png') }}" alt="employees">
                        <span class="collapse visible-xs">Employees</span>
                    </div>
                </a>
            </li>
            <li class="menu-items {{ isset($positions) ? "chose" : "" }}">
                <a href="{{ route('positions.index') }}" title="positions manager">
                    <div class="item-icon">
                        <img src="{{ asset('/images/admin/position.png') }}" alt="positions">
                        <span class="collapse visible-xs">Positions</span>
                    </div>
                </a>
            </li>
            <li class="menu-items {{ isset($users) ? "chose" : "" }}">
                <a href="{{ route('users.index') }}" title="customers manager">
                    <div class="item-icon">
                        <img src="{{ asset('/images/admin/customer.png') }}" alt="customers">
                        <span class="collapse visible-xs">Customers</span>
                    </div>
                </a>
            </li>
            <li class="menu-items {{ isset($orders) ? "chose" : "" }}">
                <a href="{{ route('order.index') }}" title="orders manager">
                    <div class="item-icon">
                        <img src="{{ asset('/images/admin/order.png') }}" alt="orders">
                        <span class="collapse visible-xs">Order</span>
                    </div>
                </a>
            </li>
            <li class="menu-items {{ isset($bills) ? "chose" : "" }}">
                <a href="{{ route('bills.index') }}" title="bills manager">
                    <div class="item-icon">
                        <img src="{{ asset('/images/admin/bill.png') }}" alt="bills">
                        <span class="collapse visible-xs">Bills</span>
                    </div>
                </a>
            </li>
            <li><a href="javascript:document.getElementById('logout').submit()" title="log out">
                    <div class="item-icon">
                        <img src="{{ asset('/images/admin/logout.png') }}" alt="logout">
                        <span class="collapse visible-xs">Logout</span>
                    </div>
                </a>
            </li>
        </ul>
    </div>
    <form action="{{ route('logout') }}" method="POST" id="logout">
        {{ csrf_field() }}
    </form>
    <div class="column col-sm-9 col-xs-11" id="main">
        <p style="padding-left: 15px"><a href="javascript:void(0)" data-toggle="offcanvas"><i class="fa fa-navicon fa-2x"></i></a></p>
        <div class="container">
        @yield('container')
        </div>
    </div>
    <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script>
        $('.menu-items a').click(function () {
            $(this).parents('li').siblings('.menu-items').removeClass('chose');
            $(this).parents('li').addClass('chose')
        });
    </script>
    @yield('js')
</div>