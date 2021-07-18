<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getAll()
    {
        return view('backend.category');
    }

    public function add()
    {
        return view('backend.addCategory');
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        Category::where('parent_id', $id)->delete();
        return redirect()->back();
    }

    public function save(Request $request)
    {
        $request->validate([
            'name_bn' => 'required',
            'name_ar' => 'required',
            'name_en' => "required"
        ]);
        $category = new Category();
        $category->name_bn = $request->name_bn;
        $category->name_en = $request->name_en;
        $category->name_ar = $request->name_ar;
        if($request->parent != "none"){
            $category->parent_id = $request->parent;
        }
        $category->created_by = auth()->id();
        $category->save();
        return redirect()->route('admin.category');
    }
}
