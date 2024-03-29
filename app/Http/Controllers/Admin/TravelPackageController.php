<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TravelPackageRequest;
use App\Models\TravelPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TravelPackageController extends Controller
{
    // INDEX Function
    public function index()
    {
        $items = TravelPackage::all();

        return view('pages.admin.travel-package.index', compact('items'));
    }

    // CREATE Function
    public function create()
    {
        return view('pages.admin.travel-package.create');
    }

    // STORE Function
    public function store(TravelPackageRequest $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->title);

        TravelPackage::create($data);
        return redirect()->route('travel-package.index');
    }

    // SHOW Function
    public function show($id)
    {
        //
    }

    // EDIT Function
    public function edit($id)
    {
        $item = TravelPackage::findOrFail($id);

        return view('pages.admin.travel-package.update', ['item' => $item]);
    }

    // UPDATE Function
    public function update(TravelPackageRequest $request, $id)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->title);

        $item = TravelPackage::findOrFail($id);

        $item->update($data);
        return redirect()->route('travel-package.index');
    }

    // DESTROY Function
    public function destroy($id)
    {
        $item = TravelPackage::findOrFail($id);

        $item->delete();
        return redirect()->route('travel-package.index');
    }
}
