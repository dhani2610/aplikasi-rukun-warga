<header id="page-topbar">
<<<<<<< HEAD
    <div class="navbar-header" style="background: #000080">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box" style="background: #000080">
=======
    <div class="navbar-header" style="background: #55efc4">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box" style="background: #55efc4">
>>>>>>> 3b87fe0e48d65581d6a3c7f7cd8bbf8a8406e833
                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('img/76-764671_software-tools-icon-png-transparent-png-removebg-preview.png') }}" alt="" height="50">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('img/76-764671_software-tools-icon-png-transparent-png-removebg-preview.png') }}" alt="" width="90">
                    </span>
                </a>
            </div>

          

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
        </div>
<<<<<<< HEAD
        <div class="" style="background: #000080">
=======
        <div class="" style="background: #55efc4">
>>>>>>> 3b87fe0e48d65581d6a3c7f7cd8bbf8a8406e833
            <a href="#" class="logo logo-light">
                {{-- <span class="logo-sm">
                    <img src="{{ asset('img/76-764671_software-tools-icon-png-transparent-png-removebg-preview.png') }} " style="width: 469px;" alt="" height="50">
                </span>
                <span class="logo-lg">
                    <img src="{{ asset('img/76-764671_software-tools-icon-png-transparent-png-removebg-preview.png') }} " style="width: 469px;" alt="" width="90">
                </span> --}}
            </a>
        </div>

        <div class="d-flex">
           

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
               
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

         

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                    <i class="bx bx-fullscreen"></i>
                </button>
            </div>
           
            <div class="dropdown d-inline-block">
                <button onclick="location.href='{{ route('profile.index') }}';" type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{ asset('img/users/'.(Auth::user()->avatar ?? 'user.png')) }}"
                        alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{ Str::limit(Auth::user()->name, '10', '...') }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
            </div>
        </div>
    </div>
</header>