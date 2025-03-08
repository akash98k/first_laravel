<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Traits\FileUpload;
use App\Traits\HttpResponse;
use App\Traits\StringHelper;
use Illuminate\Http\Request;
use Validator;

class CategoryController extends Controller
{
    use HttpResponse, FileUpload, StringHelper;

    public function index()
    {
      
        return view('categories.index');
    }


    public function list()
    {
        $categories = Category::latest()->get();
        
    }


    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request= Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       
        ]);

        if ($request->fails()) {
            return $this->validationError($request->errors()->toArray(), 'Validation failed');
        }

        list($path, $thumbnail) = $this->uploadFile($request->file('image'), 'categories', null, 'public', true);
        
        try {
            $category = Category::create([
                'name' => $request->validated()['name'],
                'description' => $request->validated()['description'],
                'slug' => $this->uniqueSlug($request->validated()['name'], function ($slug) {
                    return Category::where('slug', $slug)->exists();
                }),
                'image' => $path,
                'thumbnail' => $thumbnail,
            ]);
            
            return $this->successResponse($category, 'Category created successfully');
        } catch (\Exception $e) {   
            return $this->errorResponse('Category creation failed', 500);
        }
    }

  

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        if ($request->fails()) {
            return $this->validationError($request->errors()->toArray(), 'Validation failed');
        }
        if($request->name!=$category->name){
            $validated['slug'] = $this->uniqueSlug($request->name, function ($slug) {
                return Category::where('slug', $slug)->exists();
            });
        }
        $data = $validated;
        
        
        if ($request->hasFile('image')) {
       
            if ($category->image) {
                $this->deleteFile($category->image);
                if ($category->thumbnail) {
                    $this->deleteFile($category->thumbnail);
                }
            }
            
            list($path, $thumbnail) = $this->uploadFile($request->file('image'), 'categories', null, 'public', true);
            $data['image'] = $path;
            $data['thumbnail'] = $thumbnail;
        }
        try {
            $category->update($data);
            return $this->successResponse($category, 'Category updated successfully');
        } catch (\Exception $e) {
            return $this->errorResponse('Category update failed', 500);
        }

    }

    public function destroy(Category $category)
    {
       
        if ($category->image) {
            $this->deleteFile($category->image);
            if ($category->thumbnail) {
                $this->deleteFile($category->thumbnail);
            }
        }
        
        $category->delete();
       
    }

    public function status(Category $category)
    {
        $category->update([
            'status' => !$category->status,
        ]);
        return $this->successResponse($category, 'Category status updated successfully');
    }



}
