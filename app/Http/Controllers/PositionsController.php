<?php

namespace App\Http\Controllers;

use App\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PositionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function addSession(Request $request) {
        //        session()->flush();
        $check = ['id', 'position_code', 'name', 'base_salary_level', 'created_at', 'updated_at'];
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
        $positions = new Position();
        $positions = $positions->where('name', 'like', '%'.$request->session()->get('search').'%')
            ->orderBy($request->session()->get('field'), $request->session()->get('sort'))->paginate(5);
        $page = $positions->currentPage();

        if($request->ajax()){
            return view('positions.index', compact('positions', 'page'));
        }else{
            return view('positions.ajax', compact('positions', 'page'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('positions.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function form(Request $request, Position $position) {
        $b = Position::orderBy('id', 'desc')->first();
        $count = 1;
        if($b !== null)$count = $b->id + 1;
        if($position->position_code === null)
            $position->position_code = $count < 10 ? "P"."000".$count:($count < 100 ? "P"."00".$count:($count < 1000?"P"."0".$count:"P".$count));
        
        $position->name = $request->name;
        $position->base_salary_level = $request->base_salary_level;
        $position->save();

        return response()->json([
            'fail' => false,
            'redirect_url' => url('positions')
        ]);
    }

    public function validatePositions(Request $request, $id = null) {
        $rules = [
            'name' => ['required', 'max:50',
                    Rule::unique('positions')->ignore($id)],
            'base_salary_level' => 'required|numeric|min:0'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return $validator;
        }else return "success";
    }

    public function store(Request $request)
    {
        $validator = $this->validatePositions($request);
        if($validator !== "success") {
            return response()->json([
                'fail' =>true,
                'errors' => $validator->errors()
            ]);
        }
        $position = new Position();
        $this->form($request, $position);
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
        return view('positions.form', compact('id'));
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
        $validator = $this->validatePositions($request, $id);
        if($validator !== "success") {
            return response()->json([
                'fail' =>true,
                'errors' => $validator->errors()
            ]);
        }
        $position = Position::findOrFail($id);
        $this->form($request, $position);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Position::destroy($id);
        return redirect('positions');
    }
}
