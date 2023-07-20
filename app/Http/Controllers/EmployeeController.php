<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;


class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('contracts')->where('is_active', '1')->get();

        return EmployeeResource::collection($employees);
    }

    public function store(EmployeeRequest $request)
    {
        $employee = Employee::create($request->validated());

        return response()->json($employee, 201);
    }

    public function update(EmployeeRequest $request, $folio)
    {
        $employee = Employee::where('tax_id_number', $folio)->first();

        if (is_null($employee)) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $employee->update($request->validated());

        return response()->json($employee, 200);
    }
}
