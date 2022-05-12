<nav id="sidebar">
    <div class="p-4 pt-5">
        <h5>Categories</h5>
        <ul class="list-unstyled components mb-5">
            <li>
                @foreach($sub_categories as $sub_category)
                    <a href="#pageSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        {{$sub_category->name}}
                    </a>
                    <ul class="collapse list-unstyled" id="pageSubmenu1">
                        @foreach($sub_category->subsubcategories as $sub_sub_category)
                            <li>
                                <a href="{{route('get_sub_sub_category_detail',$sub_sub_category->id)}}">
                                    {{$sub_sub_category->name}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endforeach
            </li>
        </ul>
    </div>
</nav>
