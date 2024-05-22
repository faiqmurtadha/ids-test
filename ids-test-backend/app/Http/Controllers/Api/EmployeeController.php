<?php

namespace App\Http\Controllers\Api;

use App\Classes\ApiResponseClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Interfaces\EmployeeRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    private EmployeeRepositoryInterface $employeeRepositoryInterface;

    public function __construct(EmployeeRepositoryInterface $employeeRepositoryInterface) {
        $this->employeeRepositoryInterface = $employeeRepositoryInterface;
    }

    public function index() {
        $data = $this->employeeRepositoryInterface->index();

        return ApiResponseClass::sendResponse(EmployeeResource::collection($data), '', 200);
    }

    public function store(StoreEmployeeRequest $request) {
        $details = [
            'name' => $request->name
        ];
        DB::beginTransaction();
        try {
            $employee = $this->employeeRepositoryInterface->store($details);

            DB::commit();
            return ApiResponseClass::sendResponse(new EmployeeResource($employee), 'Employee create successful', 201);
        } catch (\Exception $ex) {
           return ApiResponseClass::rollback($ex);
        }
    }

    public function show($id) {
        $employee = $this->employeeRepositoryInterface->getById($id);

        return ApiResponseClass::sendResponse(new EmployeeResource($employee), '', 200);
    }

    public function update(UpdateEmployeeRequest $request, $id)
    {
        $updateDetails =[
            'name' => $request->name
        ];
        DB::beginTransaction();
        try{
             $product = $this->employeeRepositoryInterface->update($updateDetails,$id);

             DB::commit();
             return ApiResponseClass::sendResponse('Product Update Successful','',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    public function destroy($id)
    {
         $this->employeeRepositoryInterface->delete($id);

        return ApiResponseClass::sendResponse('Product Delete Successful','',204);
    }
}
