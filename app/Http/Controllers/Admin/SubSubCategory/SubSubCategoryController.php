<?php

namespace App\Http\Controllers\Admin\SubSubCategory;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\SubSubCategoryDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubSubCategoryController extends Controller
{
    public function index()
    {
        $sub_sub_categories = SubSubCategory::orderBy('id', 'desc')->with('subCategory','subSubCategoryDocuments')->paginate(20);

        return view('admin.sub_sub_category.list', compact('sub_sub_categories'));
    }

    public function create()
    {
        $main_categories = MainCategory::orderBy('id','desc')->get();

        return view('admin.sub_sub_category.create', compact('main_categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'main_category_id' => 'required',
            'sub_category_id' => 'required',
            'name' => 'required',
            'file_image' => 'required',
            'file_file' => 'required',
            'description' => 'required',
        ]);
        if ($request->hasFile('file_image')) {
            $image = $request->file('file_image');
            $image_name = Str::random(3) . time() . $image->getClientOriginalName();
            $destinationPath = public_path('uploads/subSubCategoryImages');
            $image->move($destinationPath, $image_name);
        }

        $sub_sub_category = SubSubCategory::create([
            'main_category_id' => $request->main_category_id,
            'sub_category_id' => $request->sub_category_id,
            'name' => $request->name,
            'file_image' => $image_name,
            'description' => $request->description
        ]);

        if ($request->hasFile('file_file')) {
            foreach ($request->file('file_file') as $document) {
                $doc = $document;
                $docName = $doc->getClientOriginalName();
                $destinationPath = public_path('uploads/subSubCategoryDocuments');
                $doc->move($destinationPath, $docName);
                SubSubCategoryDocument::create([
                    'sub_sub_category_id' => $sub_sub_category->id,
                    'doc_name' => $docName
                ]);
            }
        }

        return redirect(route('admin_get_sub_sub_categories'))->with('success', 'Sub Sub Category Added Successfully');
    }

    public function details($id)
    {
        $sub_sub_category = SubSubCategory::find($id);
        if ($sub_sub_category) {
            $main_categories = MainCategory::orderBy('id', 'desc')->get();
            $sub_categories = SubCategory::orderBy('id', 'desc')->get();

            return view('admin.sub_sub_category.details', compact('main_categories', 'sub_categories', 'sub_sub_category'));
        } else {
            return redirect(back())->with('error', 'Sub Sub Category Not Found');
        }
    }

    public function destroyDocument(Request $request)
    {
        $employeeDocument = SubSubCategoryDocument::find($request->docId);
        if ($employeeDocument) {
            $file_path = public_path('uploads/subSubCategoryDocuments/') . $employeeDocument->doc_name;
            unlink($file_path);
            $employeeDocument->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'document deleted successfully'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'document not found'
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'main_category_id' => 'required',
            'sub_category_id' => 'required',
            'name' => 'required',
            'description' => 'required',
        ]);

        $sub_sub_category = SubSubCategory::find($id);
        if ($sub_sub_category) {
            $image_name = $sub_sub_category->file_image;
            if ($request->hasFile('file_image')) {
                $file_path = public_path('uploads/subSubCategoryImages/') . $sub_sub_category->file_image;
                unlink($file_path);
                $image = $request->file('file_image');
                $image_name = Str::random(3) . time() . $image->getClientOriginalName();
                $destinationPath = public_path('uploads/subSubCategoryImages');
                $image->move($destinationPath, $image_name);
            }

            $sub_sub_category->update([
                'main_category_id' => $request->main_category_id,
                'sub_category_id' => $request->sub_category_id,
                'name' => $request->name,
                'file_image' => $image_name,
                'description' => $request->description
            ]);

            if ($request->hasFile('file_file')) {
                foreach ($request->file('file_file') as $document) {
                    $doc = $document;
                    $docName = $doc->getClientOriginalName();
                    $destinationPath = public_path('uploads/subSubCategoryDocuments');
                    $doc->move($destinationPath, $docName);
                    SubSubCategoryDocument::create([
                        'sub_sub_category_id' => $sub_sub_category->id,
                        'doc_name' => $docName
                    ]);
                }
            }

            return redirect(route('admin_get_sub_sub_categories'))->with('success', 'Sub Sub Category Updated Successfully');

        } else {
            return redirect(back())->with('error', 'Sub Sub Category Not Found');
        }
    }

    public function destroy($id)
    {
        $sub_sub_category = SubSubCategory::find($id);
        if ($sub_sub_category) {
            foreach ($sub_sub_category->subSubCategoryDocuments as $document) {
                $document->delete();
            }
            $sub_sub_category->delete();

            return redirect(route('admin_get_sub_sub_categories'))->with('success', 'Sub Sub Category Deleted Successfully');
        } else {
            return redirect(back())->with('error', 'Sub Sub Category Not Found');
        }
    }

    public function getSubCategories(Request $request)
    {
        if ($request->main_category_id !== null) {
            $mainCategory = MainCategory::find($request->main_category_id);
            return response()->json([
                'status' => 'success',
                'subCategories' => $mainCategory->subCategories
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Main Category Not Found'
            ]);
        }
    }
}
