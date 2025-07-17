<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    /**
     * Display a listing of the suppliers.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new supplier.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created supplier in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'contact' => 'nullable|string|max:255',
                'email' => 'nullable|string|email|max:255|unique:suppliers,email',
                'address' => 'nullable|string|max:255',
            ],
            ['email.unique' => "The supplier email already exists."]
        );
        if ($supplier = Supplier::create($request->only(['name', 'contact', 'email', 'address']))) {

            //log activity here if needed
            Activity::create([
                'action' => 'create',
                'subject_type' => Supplier::class,
                'subject_id' => $supplier->id,
                'user_id' => Auth::id(),
                'description' => 'Added new supplier: ' . $supplier->name,
            ]);
        }
        return redirect()->route('suppliers.index')->with('success', 'Supplier added successfully!');
    }

    /**
     * Remove the specified supplier from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        if ($supplier->delete()) {
            //log activity here if needed
            Activity::create([
                'action' => 'delete',
                'subject_id' => $supplier->id,
                'subject_type' => Supplier::class,
                'description' => 'Deleted supplier: ' . $supplier->name,
                'user_id' => Auth::id(),
            ]);
        }
        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully!');
    }

    /**
     * Show the form for editing the specified supplier.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified supplier in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        $request->validate(
            [
                'name' => 'required|string|max:255',
                'contact' => 'nullable|string|max:255',
                'email' => 'nullable|string|email|max:255|unique:suppliers,email,' . $supplier->id,
                'address' => 'nullable|string|max:255',
            ],
            ['email.unique' => "The supplier email already exists."]
        );

        if ($supplier->update($request->only(['name', 'contact', 'email', 'address']))) {
            //log activity here if needed
            Activity::create([
                'action' => 'update',
                'subject_id' => $supplier->id,
                'subject_type' => Supplier::class,
                'description' => 'Updated supplier: ' . $supplier->name,
                'user_id' => Auth::id(),
            ]);
        }

        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully!');
    }

    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('suppliers.show', compact('supplier'));
    }
}
