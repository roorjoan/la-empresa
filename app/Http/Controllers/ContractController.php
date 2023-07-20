<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContractRequest;
use App\Models\Contract;


class ContractController extends Controller
{
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
