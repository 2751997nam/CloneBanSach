<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function addSession(Request $request) {
        //        session()->flush();
        $check = ['id', 'name', 'created_at', 'updated_at'];
        if(session()->has('field') && !in_array(session()->get('field'), $check)) session()->forget('field');
        if(session()->has('search') && !in_array(session()->get('search'), $check)) session()->forget('search');

        $request->session()->flash('search', $request
            ->has('search') ? $request->get('search') : ($request->session()
            ->has('search') ? $request->session()->get('search') : ''));

        $request->session()->flash('field', $request
            ->has('field') ? $request->get('field') : ($request->session()
            ->has('field') ? $request->session()->get('field') : 'updated_at'));

        $request->session()->flash('sort', $request
            ->has('sort') ? $request->get('sort') : ($request->session()
            ->has('sort') ? $request->session()->get('sort') : 'asc'));
    }

    public function index(Request $request)
    {
        $this->addSession($request);
        $categories = new Category();
        $categories = $categories->where('name', 'like', '%'.$request->session()->get('search').'%')
            ->orderBy($request->session()->get('field'), $request->session()->get('sort'))->paginate(5);
        $page = $categories->currentPage();

        if($request->ajax()){
            return view('category.index', compact('categories', 'page'));
        }else{
            return view('category.ajax', compact('categories', 'page'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function form(Request $request, Category $category) {
        $category->name = $request->name;
        $category->save();

        return response()->json([
            'fail' => false,
            'redirect_url' => url('category')
        ]);
    }

    public function validateCategories(Request $request) {
        $rules = [
            'name' => 'required|unique:categories|max:50'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return $validator;
        }else return "success";
    }

    public function store(Request $request)
    {
        $validator = $this->validateCategories($request);
        if($validator !== "success") {
            return response()->json([
                'fail' =>true,
                'errors' => $validator->errors()
            ]);
        }
        $category = new Category();
        $this->form($request, $category);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('category.form', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validateCategories($request);
        if($validator !== "success") {
            return response()->json([
                'fail' =>true,
                'errors' => $validator->errors()
            ]);
        }
        $category = Category::findOrFail($id);
        $this->form($request, $category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::destroy($id);
        return redirect('categories');
    }
}
