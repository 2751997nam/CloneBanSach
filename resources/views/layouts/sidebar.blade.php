<div class="row row-offcanvas row-offcanvas-left active">
    <!-- sidebar -->
    <div class="column col-sm-2 col-xs-1 sidebar-offcanvas" id="sidebar">
        <ul class="nav" id="menu">
            <li><a href="{{ route('book.index') }}" title="books manager"><i class="fa fa-book"></i> <span class="collapse visible-xs">Book</span></a></li>
            <li><a href="{{ route('categories.index') }}" title="categories manager"><i class="fa fa-tags"></i> <span class="collapse visible-xs">Categories</span></a></li>
            <li><a href="{{ route('employees.index') }}" title="employees manamer"><i class="fa fa-users"></i> <span class="collapse visible-xs">Employees</span></a></li>
            <li><a href="{{ route('positions.index') }}" title="positions manager"><i class="fa fa-building"></i> <span class="collapse visible-xs">Positions</span></a></li>
            <li><a href="{{ route('order.index') }}" title="orders manager"><i class="fa fa-shopping-cart"></i> <span class="collapse visible-xs">Orders</span></a></li>
            <li><a href="{{ route('bills.index') }}" title="bills manager"><i class="glyphicon glyphicon-list-alt"></i> <span class="collapse visible-xs">Bills</span></a></li>
            <li><a href="javascript:void(0)" title="change password"><i class="fa fa-key"></i> <span class="collapse visible-xs">Change Password</span></a></li>
            <li><a href="javascript:document.getElementById('logout').submit()" title="log out"><i class="fa fa-sign-out"></i> <span class="collapse visible-xs">Log Out</span></a></li>
        </ul>
    </div>
    <form action="{{ route('logout') }}" method="POST" id="logout">
        {{ csrf_field() }}
    </form>
    <div class="column col-sm-9 col-xs-11" id="main">
        <p><a href="javascript:void(0)" data-toggle="offcanvas"><i class="fa fa-navicon fa-2x"></i></a></p>
        @yield('container')
    </div>
    <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>
    @yield('js')
</div>