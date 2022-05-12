<?php

namespace App\Http\Controllers\Admin\MainCategory;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use Illuminate\Http\Request;

class MainCategoryController extends Controller
{
    public function index()
    {
        $main_categories = MainCategory::orderBy('id', 'desc')->paginate(20);

        return view('admin.main_category.list', compact('main_categories'));
    }

    public function create()
    {
        return view('admin.main_category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        MainCategory::create([
            'name' => $request->name
        ]);

        return redirect(route('admin_get_main_categories'))->with('success', 'Main Category Added Successfully');
    }

    public function edit($id)
    {
        $main_category = MainCategory::find($id);
        if ($main_category) {
            return view('admin.main_category.edit', compact('main_category'));
        } else {
            return redirect(back())->with('error', 'Main Category Not Found');
        }
    }

    public function update(Request $request, $id)
    {
        $main_category = MainCategory::find($id);
        if ($main_category) {
            $main_category->update([
                'name' => $request->name,
            ]);
            return redirect(route('admin_get_main_categories'))->with('success', 'Main Category Updated Successfully');

        } else {
            return redirect(back())->with('error', 'Main Category Not Found');
        }
    }

    public function destroy($id)
    {
        $main_category = MainCategory::find($id);
        if ($main_category) {
            foreach ($main_category->subCategories as $subCategory) {
                $subCategory->delete();
            }
            foreach ($main_category->subSubCategories as $subSubCategory) {
                $subSubCategory->delete();
            }
            $main_category->delete();

            return redirect(route('admin_get_main_categories'))->with('success', 'Main Category Deleted Successfully');
        } else {
            return redirect(back())->with('error', 'Main Category Not Found');
        }
    }
}
