<div class="navbr w-100 text-white" style="box-shadow: 2px 2px 7px 1px rgba(0, 0, 0, 0.15); background-color: #474d50;">
    <div class="container-fluid" style="padding-left: 255px;">
        <div class="row">
            <div class="col-10 text-right">
                <div class="d-flex" style="justify-content: space-between;">
                    <div class="d-flex">
                        <a href="{{route('home')}}" style="margin-left: -227px;">
                            <img width="100px" style="margin-top: 25px; margin-right: 20px;" src="{{asset('FrontEnd/img/logo.png')}}">
                        </a>
                        <i class="bi bi-person-fill" style="margin-top: 26px; margin-right: 5px;"></i>
                        <p class="font-weight-bold" style="margin-top: 22px;">{{\Illuminate\Support\Facades\Auth::user()->name}}</p>
                    </div>
                    <div class="d-flex" style="margin-top: 20px">
                        <i class="bi bi-envelope-fill" style="margin-top: 5px; margin-right: 5px; "></i>
                        <p class="font-weight-bold" style="margin-right: 20px;">{{\Illuminate\Support\Facades\Auth::user()->email}}</p>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="margin-top: 5px;">
                            <i class="bi bi-box-arrow-right" style="color: white; width: 20px;"></i>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

