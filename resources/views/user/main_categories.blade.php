<ul class="nav nav-tabs flex-scroll-x">
    @foreach($main_categories as $main_category)
        <li class="pl-3 changeColorHover">
            <a href="{{route('get_sub_categories_of_main_category',$main_category->id)}}" style="color: #0f6674">{{$main_category->name}}</a>
        </li>
    @endforeach
</ul>
