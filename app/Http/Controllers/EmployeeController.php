<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        $employee = Employee::all();
        return view('employee.index', compact('employee'));
    }

    public function store(Request $request)
    {

        // Validate the form data
        $request->validate([
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email'         => 'required|email|unique:employees,email',
            'gender'        => 'required|string',
            'mobile_number' => 'required|numeric',
            'country_code'  => 'required|string|max:5',
            'hobbies'       => 'required|array',
            'photo'         => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('upload'), $imageName);
            $photoPath = 'upload/' . $imageName;
        } else {
            $photoPath = null;
        }

        // Store the employee data in the database
        Employee::create([
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'email'         => $request->email,
            'gender'        => $request->gender,
            'mobile_number' => $request->mobile_number,
            'country_code'  => $request->country_code,
            'hobbies'       => implode(',', $request->hobbies), // Convert the hobbies array to a comma-separated string
            'photo'         => $photoPath, // Store the photo path in the database
            'address'       => $request->address,
        ]);

        return redirect()->route('employee.index')->with('success', 'Employee added successfully!');
    }

    public function show($id)
    {
        $employee = Employee::find($id);
        return view('employee.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email'         => 'required|email|unique:employees,email,' . $id,
            'gender'        => 'required|string',
            'mobile_number' => 'required|numeric',
            'country_code'  => 'required|string|max:5',
            'hobbies'       => 'required|array',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address'       => 'nullable|string',
        ]);

        // Find the employee by ID
        $employee = Employee::findOrFail($id);

        // Handle the photo upload if a new one is provided
        if ($request->hasFile('photo')) {
            // Delete the old photo if it exists
            if ($employee->photo) {
                unlink(public_path($employee->photo)); // Delete the existing photo file
            }

            // Upload the new photo
            $image = $request->file('photo');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('upload'), $imageName);
            $photoPath = 'upload/' . $imageName;
        } else {
            // If no new photo is uploaded, keep the old one
            $photoPath = $employee->photo;
        }

        // Update the employee record in the database
        $employee->update([
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'email'         => $request->email,
            'gender'        => $request->gender,
            'mobile_number' => $request->mobile_number,
            'country_code'  => $request->country_code,
            'hobbies'       => implode(',', $request->hobbies),  // Convert hobbies array to a comma-separated string
            'photo'         => $photoPath,  // Store the new photo path or keep the old one
            'address'       => $request->address,
        ]);

        // Redirect back to the employee list with a success message
        return redirect()->route('employee.index')->with('success', 'Employee updated successfully!');
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employee.index')->with('success', 'Employee deleted successfully');
    }
}
