<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;

/**
 * @group Employees
 *
 * Gestión de empleados.
 */
class EmployeeController extends Controller
{
    /**
     * Obtener la lista de empleados activos.
     *
     * Se utiliza para obtener una lista de empleados activos junto con sus contratos.
     *
     * @response 200 {
     *      "data": [
     *        {
     *          "full_name": "Rogelio Goyette Bins",
     *          "tax_id_number": "0389881828766",
     *          "email": "carolyn49@rippin.com",
     *          "contracts": []
     *        },
     *        {
     *          "full_name": "Mario Torphy Kuhlman",
     *          "tax_id_number": "3550145757415",
     *          "email": "gstiedemann@yahoo.com",
     *          "contracts": [
     *            {
     *              "contract_type": [
     *                {
     *                  "name": "External"
     *                }
     *              ],
     *              "date_from": "2023-02-21 18:11:44",
     *              "date_to": "2008-08-05 05:58:37",
     *              "salary_per_day": "25.00",
     *              "is_active": true
     *            }
     *          ]
     *        }
     *      ]
     *}
     *
     * @response 401 {
     *     "message": "Unauthenticated"
     * }
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $employees = Employee::with('contracts')->where('is_active', '1')->get();

        return EmployeeResource::collection($employees);
    }

    /**
     * Crear un nuevo empleado.
     *
     * Se utiliza para crear un nuevo empleado.
     *
     * @bodyParam tax_id_number string required Número de identificación fiscal del empleado.
     * @bodyParam name string required Nombre del empleado.
     * @bodyParam last_name string required Apellido del empleado.
     * @bodyParam birth_date string required Fecha de nacimiento del empleado.
     * @bodyParam email string required Correo del empleado.
     * @bodyParam cell_phone string required Celular del empleado.
     *
     * @response 201 {
     *     "tax_id_number": "1233878024496",
     *     "name": "Jhon",
     *     "last_name": "Doe",
     *     "birth_date": "1988-04-28",
     *     "email": "jhon@gmail.com",
     *     "cell_phone": "(111) 889-3678",
     *     "created_at": "2023-12-16T05:24:51.000000Z",
     *     "id": 3
     * }
     *
     * @response 401 {
     *     "message": "Unauthenticated"
     * }
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(EmployeeRequest $request)
    {
        $employee = Employee::create($request->validated());

        return response()->json($employee, 201);
    }

    /**
     * Actualizar los detalles de un empleado.
     *
     * Se utiliza para actualizar los detalles de un empleado identificado por su número de identificación fiscal (folio).
     *
     * @urlParam folio string required Número de identificación fiscal (folio) del empleado.
     *
     * @bodyParam tax_id_number string required Número de identificación fiscal del empleado.
     * @bodyParam name string required Nombre del empleado.
     * @bodyParam last_name string required Apellido del empleado.
     * @bodyParam birth_date string required Fecha de nacimiento del empleado.
     * @bodyParam email string required Correo del empleado.
     * @bodyParam cell_phone string required Celular del empleado.
     *
     * @response 200 {
     *     "id": 3,
     *     "tax_id_number": "1233878024496",
     *     "name": "Jhon",
     *     "last_name": "Doe",
     *     "birth_date": "2023-07-18",
     *     "email": "jhondoe@hotmail.com",
     *     "cell_phone": "555.555.5555",
     *     "is_active": 1,
     *     "created_at": "2023-12-16T05:24:51.000000Z"
     * }
     *
     * @response 404 {
     *     "message": "Not found"
     * }
     *
     * @response 401 {
     *     "message": "Unauthenticated"
     * }
     *
     * @param  \App\Http\Requests\EmployeeRequest  $request
     * @param  string  $folio
     * @return \Illuminate\Http\JsonResponse
     */
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
