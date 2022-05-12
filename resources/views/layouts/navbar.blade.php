<nav class="navbar navbar-expand navbar-light" style="padding: 5px;">
    <div class="container-fluid">
        <a href="#" class="burger-btn d-block">
            <i class="bi bi-justify fs-3"></i>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
            </ul>
            <div class="dropdown">
                <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="user-menu d-flex">
                        <div class="user-img d-flex align-items-center">
                            <div class="avatar avatar-md">
                                <img src="{{asset('assets/images/faces/2.jpg')}}">
                            </div>
                        </div>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                    <li>
                        <h6 class="dropdown-header">Hello, {{auth()->user()->name}}</h6>
                    </li>
                    <li>
                        <a class="dropdown-header" href="{{route('admin_update_profile')}}">Update Profile</a>
                    </li>
                    <li>
                        <a class="dropdown-header" href="#" onclick="document.getElementById('logout').submit()">
                            Logout
                        </a>
                        <form action="{{route('logout')}}" method="post" id="logout">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

