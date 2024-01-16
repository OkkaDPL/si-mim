<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Division;
use App\Models\Part;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Category::class);
        return view(
            'dashboard.masterdata.category.mcategory',
            [
                "title" => 'Data Categories',
                "subTitle" => 'MasterData',
                "categories" => Category::with(['division'])->get()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('viewAny', Category::class);
        return view('dashboard.masterdata.category.fcategory', [
            "title" => 'Form Categories',
            "subTitle" => 'MasterData',
            "divisions" => Division::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:10|unique:categories',
            'division_id' => 'required|exists:divisions,id'
        ]);

        Category::create($validatedData);

        return redirect('/dashboard/categories')->with('success', 'The new data has been successfully added!');
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
    public function edit(Category $category)
    {
        $this->authorize('viewAny', Category::class);
        return view('dashboard.masterdata.category.ecategory', [
            "title" => 'Form Categories',
            "subTitle" => 'MasterData',
            "categories" => $category,
            "divisions" => Division::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $rules = [];
        if ($request->nama != $category->nama) {
            $rules['nama'] = 'required|max:10|unique:categories';
        }
        if ($request->division_id != $category->division_id) {
            $rules['division_id'] = 'required|exists:divisions,id';
        }

        $validatedData = $request->validate($rules);
        // $validatedData['user_id'] = auth()->user()->id;

        Category::where('id', $category->id)
            ->update($validatedData);
        return redirect('/dashboard/categories')->with('success', 'Data has been changed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if ($category->part()->count()) {
            return redirect('dashboard/categories')->with('error', 'Category exists in another table cannot be deleted');
        }

        Category::destroy($category->id);
        return redirect('dashboard/categories')->with('success', 'Data has been deleted!');
    }
}
