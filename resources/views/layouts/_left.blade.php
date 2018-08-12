<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        {{--<div class="user-panel">--}}
            {{--<div class="pull-left image">--}}
                {{--<img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">--}}
            {{--</div>--}}
            {{--<div class="pull-left info">--}}
                {{--<p>Alexander Pierce</p>--}}
                {{--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>--}}
            {{--</div>--}}
        {{--</div>--}}
        <!-- search form -->
        {{--<form action="#" method="get" class="sidebar-form">--}}
            {{--<div class="input-group">--}}
                {{--<input type="text" name="q" class="form-control" placeholder="Search...">--}}
                {{--<span class="input-group-btn">--}}
                {{--<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>--}}
                {{--</button>--}}
              {{--</span>--}}
            {{--</div>--}}
        {{--</form>--}}
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">店铺信息</li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-id-card"></i> <span>商家店铺</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('user.index')}}"><i class="fa fa-circle-o"></i>店铺详情</a></li>
                </ul>
            </li>
            {{--菜品分类管理--}}
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-calendar-check-o"></i> <span>菜品分类管理</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('menuCategories.index')}}"><i class="fa fa-circle-o"></i>菜品分类管理</a></li>
                    <li><a href="{{route('menuCategories.add')}}"><i class="fa fa-circle-o"></i> 添加菜品分类</a></li>
                </ul>
            </li>
         {{--商家菜品管理--}}
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>商家菜品管理</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('menu.index')}}"><i class="fa fa-circle-o"></i>店铺菜品管理</a></li>
                    <li><a href="{{route('menu.add')}}"><i class="fa fa-circle-o"></i> 菜品添加</a></li>
                </ul>
            </li>
            {{--订单管理--}}
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>订单管理</span>
                    <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route("order.index")}}"><i class="fa fa-circle-o"></i> 订单管理</a></li>
                    <li><a href="{{route("order.cartList")}}"><i class="fa fa-circle-o"></i> 菜品销量统计</a></li>
                </ul>
            </li>
            <li>
                <a href="{{route('user.activityIndex')}}">
                    <i class="fa fa-th"></i> <span>正在进行的活动</span>
                    <span class="pull-right-container">
              <small class="label pull-right bg-red">hot</small>
            </span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>抽奖</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route("events.index")}}"><i class="fa fa-circle-o"></i> 活动列表</a></li>
                    <li><a href="{{route("events.winner")}}"><i class="fa fa-circle-o"></i>中奖信息</a></li>
                    {{--<li><a href=""><i class="fa fa-circle-o"></i> Flot</a></li>--}}
                    {{--<li><a href=""><i class="fa fa-circle-o"></i> Inline charts</a></li>--}}
                </ul>
            </li>
            {{--<li class="treeview">--}}
                {{--<a href="#">--}}
                    {{--<i class="fa fa-laptop"></i>--}}
                    {{--<span>UI Elements</span>--}}
                    {{--<span class="pull-right-container">--}}
              {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
                {{--</a>--}}
                {{--<ul class="treeview-menu">--}}
                    {{--<li><a href=""><i class="fa fa-circle-o"></i> General</a></li>--}}
                    {{--<li><a href=""><i class="fa fa-circle-o"></i> Icons</a></li>--}}
                    {{--<li><a href=""><i class="fa fa-circle-o"></i> Buttons</a></li>--}}
                    {{--<li><a href=""><i class="fa fa-circle-o"></i> Sliders</a></li>--}}
                    {{--<li><a href=""><i class="fa fa-circle-o"></i> Timeline</a></li>--}}
                    {{--<li><a href=""><i class="fa fa-circle-o"></i> Modals</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}

            {{--<li class="treeview">--}}
                {{--<a href="#">--}}
                    {{--<i class="fa fa-table"></i> <span>Tables</span>--}}
                    {{--<span class="pull-right-container">--}}
              {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
                {{--</a>--}}
                {{--<ul class="treeview-menu">--}}
                    {{--<li><a href="/pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>--}}
                    {{--<li><a href="/pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="/pages/calendar.html">--}}
                    {{--<i class="fa fa-calendar"></i> <span>Calendar</span>--}}
                    {{--<span class="pull-right-container">--}}
              {{--<small class="label pull-right bg-red">3</small>--}}
              {{--<small class="label pull-right bg-blue">17</small>--}}
            {{--</span>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="/pages/mailbox/mailbox.html">--}}
                    {{--<i class="fa fa-envelope"></i> <span>Mailbox</span>--}}
                    {{--<span class="pull-right-container">--}}
              {{--<small class="label pull-right bg-yellow">12</small>--}}
              {{--<small class="label pull-right bg-green">16</small>--}}
              {{--<small class="label pull-right bg-red">5</small>--}}
            {{--</span>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li class="treeview">--}}
                {{--<a href="#">--}}
                    {{--<i class="fa fa-folder"></i> <span>Examples</span>--}}
                    {{--<span class="pull-right-container">--}}
              {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
                {{--</a>--}}
                {{--<ul class="treeview-menu">--}}
                    {{--<li><a href="/pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>--}}
                    {{--<li><a href="/pages/examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>--}}
                    {{--<li><a href="/pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>--}}
                    {{--<li><a href="/pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>--}}
                    {{--<li><a href="/pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>--}}
                    {{--<li><a href="/pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>--}}
                    {{--<li><a href="/pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>--}}
                    {{--<li><a href="/pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>--}}
                    {{--<li><a href="/pages/examples/pace.html"><i class="fa fa-circle-o"></i> Pace Page</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            {{--<li class="treeview">--}}
                {{--<a href="#">--}}
                    {{--<i class="fa fa-share"></i> <span>Multilevel</span>--}}
                    {{--<span class="pull-right-container">--}}
              {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
                {{--</a>--}}
                {{--<ul class="treeview-menu">--}}
                    {{--<li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>--}}
                    {{--<li class="treeview">--}}
                        {{--<a href="#"><i class="fa fa-circle-o"></i> Level One--}}
                            {{--<span class="pull-right-container">--}}
                  {{--<i class="fa fa-angle-left pull-right"></i>--}}
                {{--</span>--}}
                        {{--</a>--}}
                        {{--<ul class="treeview-menu">--}}
                            {{--<li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>--}}
                            {{--<li class="treeview">--}}
                                {{--<a href="#"><i class="fa fa-circle-o"></i> Level Two--}}
                                    {{--<span class="pull-right-container">--}}
                      {{--<i class="fa fa-angle-left pull-right"></i>--}}
                    {{--</span>--}}
                                {{--</a>--}}
                                {{--<ul class="treeview-menu">--}}
                                    {{--<li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>--}}
                                    {{--<li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    {{--<li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            {{--<li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>--}}
            {{--<li class="header">LABELS</li>--}}
            {{--<li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>--}}
            {{--<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>--}}
            {{--<li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>--}}
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>