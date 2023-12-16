<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContractRequest;
use App\Models\Contract;

/**
 * @group Contracts
 *
 * Gestión de contratos de empleados.
 */
class ContractController extends Controller
{
    /**
     * Crear un nuevo contrato.
     *
     * Se utiliza para crear un nuevo contrato para un empleado. Si ya existe un contrato activo para el empleado, el contrato anterior se cierra y se crea uno nuevo.
     *
     * @bodyParam employee_id int required ID del empleado al que se le asignará el contrato.
     * @bodyParam contract_type_id int required ID del tipo de contrato que se le asignará el contrato.
     * @bodyParam date_from datetime required Fecha de inicio del contrato.
     * @bodyParam date_to datetime required Fecha de fin del contrato.
     * @bodyParam salary_per_day double required Salario por día del contrato.
     *
     * @response 201 {
     *     "employee_id": "3",
     *     "contract_type_id": "3",
     *     "date_from": "2023-07-19 00:00:00",
     *     "date_to": "2023-07-19 00:00:00",
     *     "salary_per_day": "30.00",
     *     "created_at": "2023-12-16T05:58:50.000000Z",
     *     "id": 2
     * }
     *
     * @response 401 {
     *     "message": "Unauthenticated"
     * }
     *
     * @param  \App\Http\Requests\ContractRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ContractRequest $request)
    {
        $contract = Contract::where('employee_id', $request->employee_id)->first();

        if (is_null($contract)) {

            $new_contract = Contract::create($request->validated());

            return response()->json($new_contract, 201);
        }

        $contract->date_to = now();
        $contract->is_active = false;
        $contract->save();

        $new_contract = Contract::create($request->validated());

        return response()->json($new_contract, 201);
    }

    /**
     * Desactivar contrato de un empleado.
     *
     * Se utiliza para desactivar el contrato activo de un empleado.
     *
     * @urlParam employee_id int required ID del empleado cuyo contrato se desactivará.
     *
     * @response 204 {}
     *
     * @response 404 {
     *     "message": "Not found"
     * }
     *
     * @response 401 {
     *     "message": "Unauthenticated"
     * }
     *
     * @param  int  $employee_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($employee_id)
    {
        $contract = Contract::where('employee_id', $employee_id)
            ->where('is_active', 1)
            ->first();

        if (is_null($contract)) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $contract->date_to = now();
        $contract->is_active = false;
        $contract->save();

        return response()->noContent();
    }
}
