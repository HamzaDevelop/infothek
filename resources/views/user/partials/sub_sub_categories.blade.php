<div class="row mt-5">
    @foreach($sub_sub_category as $category)
        <div class="col-4 my-3">
            <div class="card" style="width: 18rem;">
                <img src="{{asset('uploads/subSubCategoryImages/'.$category->file_image)}}" class="card-img-top" alt="" style="height: 259px;">
                <div class="card-body">
                    <h5 class="card-title">{{$category->name}}</h5>
                    <p class="card-text">{!! mb_strimwidth($category->description, 0, 120, '...') !!}</p>
                    <a href="{{route('get_sub_sub_category_detail',$category->id)}}" class="btn btn-dark">See details</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
