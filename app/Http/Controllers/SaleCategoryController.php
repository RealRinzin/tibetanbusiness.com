<?php

namespace App\Http\Controllers;

use App\SaleCategory;
use Illuminate\Http\Request;

class SaleCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories =  SaleCategory::orderBy('name', 'asc')->get();
        return $categories->toArray($categories);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SaleCategory  $saleCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SaleCategory $saleCategory)
    {
        //
        $categories =  SaleCategory::orderBy('name', 'asc')->get();
        return $categories->toArray($categories);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SaleCategory  $saleCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SaleCategory $saleCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SaleCategory  $saleCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SaleCategory $saleCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SaleCategory  $saleCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaleCategory $saleCategory)
    {
        //
    }
}
