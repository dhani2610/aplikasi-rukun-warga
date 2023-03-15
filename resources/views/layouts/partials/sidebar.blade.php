<!-- ========== Left Sidebar Start ========== -->
<style>
span{
    color: black;
}
#sidebar-menu{
    background: silver;
}
.simplebar-content-wrapper{
    background: silver!important;
}
</style>
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu" style="background:silver">
                @if(auth()->user()->can('dashboard') || auth()->user()->can('master-data') || auth()->user()->can('history-log-list'))
                <li class="menu-title" key="t-menu">Menu</li>
                @endif

                @if(auth()->user()->can('dashboard'))
                <li>
                    <a href="{{ route('dashboard.index') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboard</span>
                    </a>
                </li>
                @endif

                @if(auth()->user()->can('master-data'))
                <li>
                    <a href="{{ route('approval-list') }}" class="waves-effect">
                        <i class="mdi mdi-tools"></i>
                        <span key="t-dashboards">Approval User</span>
                    </a>
                </li>
                @endif

                @if (auth()->user()->can('slider-management') || auth()->user()->can('berita-management'))
                    <li class="menu-title" key="t-menu">Setting</li>
                @endif


                @if(auth()->user()->can('slider-management'))
                <li>
                    <a href="{{ route('slider-list') }}" class="waves-effect">
                        <i class="mdi mdi-tools"></i>
                        <span key="t-dashboards">Slider Management</span>
                    </a>
                </li>
                @endif
                @if(auth()->user()->can('berita-management'))
                <li>
                    <a href="{{ route('berita-list') }}" class="waves-effect">
                        <i class="mdi mdi-tools"></i>
                        <span key="t-dashboards">Berita Management</span>
                    </a>
                </li>
                @endif

                <li class="menu-title" key="t-menu">Master Data</li>

                @if(auth()->user()->can('master-data'))
                <li>
                    <a href="{{ route('master-data.index') }}">
                        <i class="mdi mdi-folder-outline"></i>
                        <span data-key="t-dashboard">Master Data</span>
                    </a>
                </li>
                @endif

                <li>
                    <form action="{{ url('/logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn"> 
                            <i class="mdi mdi-logout"></i>
                            <span data-key="t-dashboard">Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->