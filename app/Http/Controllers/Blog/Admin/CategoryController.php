<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Blog\BaseController;
use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\BlogCategory;
use App\Repositories\BlogCategoryRepository;
use Illuminate\Support\Str;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = BlogCategory::paginate(5);

        return view('blog.admin.categories.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new BlogCategory();
        $categoryList = BlogCategory::all();

        return view(
            'blog.admin.categories.edit',
            compact('item','categoryList')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BlogCategoryCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->input();
        if(empty($data['slug'])){
            $data['slug'] = Str::slug($data['title']);
        }

        $item = new BlogCategory($data);
        $item->save();

        //$item = (new BlogCategory())->create($data);

        if($item) {
            return redirect()
                ->route('blog.admin.categories.edit', [$item->id])
                ->with(['success' => 'Success save']);
        }else{
            return back()
                ->withErrors(['msg' => 'Error save'])
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param  BlogCategoryRepository $categoryRepository
     * @return \Illuminate\Http\Response
     */
    public function edit($id, BlogCategoryRepository $categoryRepository)
    {
//        $item = BlogCategory::findOrFail($id);
//        $categoryList = BlogCategory::all();

        $item = $categoryRepository->getEdit($id);
        $categoryList = $categoryRepository->getForComboBox();

        return view('blog.admin.categories.edit',
            compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\BlogCategoryUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
//        $rules = [
//            'title'         => 'required|min:5|max:200',
//            'slug'          => 'max:200',
//            'description'   => 'string|max:500|min:3',
//            'parent_id'     => 'required|integer|exists:blog_categories,id'
//        ];

        //$validateData = $this->validate($request, $rules);
        //$validateData = $request->validate($rules);

        $item = BlogCategory::find($id);
        if(empty($item)){
            return back()
                ->withErrors(['msg' => "Category id=[{$id}] not found"])
                ->withInput();
        }

        $data = $request->all();
        $result = $item->update($data);

        if($result) {
            return redirect()
                ->route('blog.admin.categories.edit', $item->id)
                ->with(['success' => 'Success update']);
        }else{
            return back()
                ->withErrors(['msg' => 'Error update'])
                ->withInput();
        }
    }
}
