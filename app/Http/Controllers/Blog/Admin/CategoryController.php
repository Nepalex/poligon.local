<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Http\Requests\BlogCategoryCreateRequest;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        //
        $paginator = BlogCategory::paginate(20);

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

        return view('blog.admin.categories.edit', compact('item','categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->input();

        if(empty($data['slug'])){
            $data['slug'] = str_slug($data['title']);
        }

        //Создаст объект, но не добавит в бд
             // $item = new BlogCategory($data);
        // Сохранение в БД через модель
            // $item->save();

        //Создаст объект и добавит в бд

        $item = (new BlogCategory())->create($data);

        if ($item){
            return redirect()->route('blog.admin.categories.edit', [$item->id])
                ->with(['success' => 'Успешно сохранено']);
        }else{
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $item = BlogCategory::findOrFail($id);
        $categoryList = BlogCategory::all();

       return view('blog.admin.categories.edit',
           compact('item','categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
        /*
            $rules = [
               'title' => 'required|min:5|max:200',
               'slug' => 'max:200',
               'description' => 'string|min:3|max:500',
               'parent_id' => 'required|integer|exists:blog_categories,id',
           ];

           //$validatedData = $this->validate($request, $rules);

           //$validatedData = $request->validate($rules);

           $validator = \Validator::make($request->all(), $rules);
           $validatedData[] = $validator->passes();
          // $validatedData[] = $validator->validate();
           $validatedData[] = $validator->valid();
           $validatedData[] = $validator->failed();
           $validatedData[] = $validator->errors();
           $validatedData[] = $validator->fails();



           dd($validatedData);
   */
        $item = BlogCategory::find($id);
        if (empty($item)){
            return back()
                ->withErrors(['msg' => "Запись с id=[{$id}] не найдена"])
                ->withInput();
        }

        $data = $request->all();

        if(empty($data['slug'])){
            $data['slug'] = str_slug($data['title']);
        }
        /*
        $result = $item
            ->fill($data)
            ->save();
        */

        $result = $item->update($data);

        if ($result){
            return redirect()
                ->route('blog.admin.categories.edit', $item->id)
                ->with(['success' => 'Успешно сохранено']);
        }else{
            return back()
                ->withErrors(['msg' => "Ошибка сохранения"])
                ->withInput();
        }
    }
}
