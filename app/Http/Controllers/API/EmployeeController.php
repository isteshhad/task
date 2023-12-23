<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Http\Resources\Employee as EmployeeResource;

class EmployeeController extends BaseController
{
    public function index()
    {
        $employees = Employee::all();
        return $this->sendResponse(EmployeeResource::collection($employees), 'Employees retrieved successfully.');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required|email|unique:employees,email',
            'contact' => 'required',
            'address' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $employees = Employee::create($input);

        return $this->sendResponse(new EmployeeResource($employees), 'Employee created successfully.');
    }

    public function show($id)
    {
        $employees = Employee::find($id);
        if (is_null($employees)) {
            return $this->sendError('Employee not found.');
        }

        return $this->sendResponse(new EmployeeResource($employees), 'Employee retrieved successfully.');
    }


    public function update(Request $request, Employee $employee)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required|email|unique:employees,email,'.$employee->id,
            'contact' => 'required',
            'address' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $employee->name = $input['name'];
        $employee->email = $input['email'];
        $employee->contact = $input['contact'];
        $employee->address = $input['address'];
        $employee->save();

        return $this->sendResponse(new EmployeeResource($employee), 'Employee updated successfully.');
    }


    public function destroy(Employee $employee)
    {
        $employee->delete();
                return $this->sendResponse([], 'Employee deleted successfully.');
            }
}
