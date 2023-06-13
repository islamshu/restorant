<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        {{-- @if (auth()->user()->type != 'famous' || auth()->user()->famous == null) --}}
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item  ">
                <a href="{{ route('setting') }}">
                    <i class="fa fa-cog"></i>
                    <span class="menu-title"> الاعدادات  </span></a>
            </li>
            <li class="nav-item  ">
                <a href="{{ route('get_orders') }}?status=">
                    <i class="fa fa-list"></i>
                    <span class="menu-title"> الحجوزات  </span></a>
            </li>



            {{-- <li class="nav-item  ">
            <a href="{{ route('users.index') }}">
                <i class="fa fa-pencil"></i>
                <span class="menu-title">المستخدمين </span></a>
        </li>         --}}


        </ul>
    </div>
</div>
