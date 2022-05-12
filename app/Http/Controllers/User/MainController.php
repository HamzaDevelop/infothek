<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function home()
    {
        $sub_sub_category = SubSubCategory::orderBy('id','desc')->take(20)->get();

        return view('user.home',compact('sub_sub_category'));
    }

    public function getSubCategories($id)
    {
        $main_category = MainCategory::find($id);
        if ($main_category) {
            $main_category->load('subCategories');

            return view('user.sub_categories', compact('main_category'));
        } else {
            return redirect(back())->with('error', 'Main Category Not Found');
        }
    }

    public function getSubSubCategoryDetail($id)
    {
        $sub_sub_category = SubSubCategory::find($id);
        if ($sub_sub_category) {
            $main_category = MainCategory::where('id', $sub_sub_category->main_category_id)->first();

            return view('user.sub_sub_category_detail', compact('sub_sub_category', 'main_category'));
        } else {
            return redirect(back())->with('error', 'Sub Sub Category Not Found');
        }
    }

    public function search(Request $request)
    {
        $sub_sub_category = SubSubCategory::where('name', 'like', '%' . $request->name . '%')->Orwhere('description', 'like', '%' . $request->name . '%')->get();
        if (count($sub_sub_category) > 0) {
            $sub_sub_category->load('subSubCategoryDocuments');

            return view('user.sub_sub_category_search_list', compact('sub_sub_category'));
        } else {
            return redirect()->back()->with('error', 'No Result Found');
        }
    }
}
