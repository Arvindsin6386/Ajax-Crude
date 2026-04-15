<?php

namespace App\Http\Controllers;

use App\Models\modelEmployee;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() //listing
    {
        //
        $employees = modelEmployee::get();
        return view('ajax', compact('employees'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:20',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'mobile' => 'required'

        ]);
        $employee =  modelEmployee::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'mobile' => $request->mobile,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Employee created successfully',
            'data' => $employee


        ]);
    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show()
    // {
    //     //

    //     $employees = modelEmployee::all();
    //     return view('ajax', compact('employees'));
    // }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $employee = modelEmployee::find($id);

        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required'
        ]);
        $employee = modelEmployee::find($id);

        $employee->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Employee update successfully',
            'data' => $employee
        ]);
        // return redirect()->back()->with('success', 'Data Updated');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $employee = modelEmployee::find($id);
        $employee->delete();

        return response()->json([
            'message' => 'Employee deleted successfully'
        ]);
    }
}
