<?php

namespace App\Http\Controllers\Admin\SubCategory;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $sub_categories = SubCategory::orderBy('id', 'desc')->with('mainCategory')->paginate(20);

        return view('admin.sub_category.list', compact('sub_categories'));
    }

    public function create()
    {
        $main_categories = MainCategory::orderBy('id', 'desc')->get();

        return view('admin.sub_category.create', compact('main_categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'main_category_id' => 'required',
            'name' => 'required'
        ]);

        SubCategory::create([
            'main_category_id' => $request->main_category_id,
            'name' => $request->name
        ]);

        return redirect(route('admin_get_sub_categories'))->with('success', 'Sub Category Added Successfully');
    }

    public function edit($id)
    {
        $sub_category = SubCategory::find($id);
        if ($sub_category) {
            $main_categories = MainCategory::orderBy('id', 'desc')->get();

            return view('admin.sub_category.edit', compact('main_categories', 'sub_category'));
        } else {
            return redirect(back())->with('error', 'Sub Category Not Found');
        }
    }

    public function update(Request $request, $id)
    {
        $sub_category = SubCategory::find($id);
        if ($sub_category) {
            $sub_category->update([
                'main_category_id' => $request->main_category_id,
                'name' => $request->name,
            ]);
            return redirect(route('admin_get_sub_categories'))->with('success', 'Sub Category Updated Successfully');

        } else {
            return redirect(back())->with('error', 'Sub Category Not Found');
        }
    }

    public function destroy($id)
    {
        $sub_category = SubCategory::find($id);
        if ($sub_category) {
            foreach ($sub_category->subsubcategories as $subsubCategory) {
                $subsubCategory->delete();
            }
            $sub_category->delete();

            return redirect(route('admin_get_sub_categories'))->with('success', 'Sub Category Deleted Successfully');
        } else {
            return redirect(back())->with('error', 'Sub Category Not Found');
        }
    }
}
