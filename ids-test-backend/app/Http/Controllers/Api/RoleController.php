<?php

namespace App\Http\Controllers\Api;

use App\Classes\ApiResponseClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Interfaces\RoleRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    private RoleRepositoryInterface $roleRepositoryInterface;

    public function __construct(RoleRepositoryInterface $roleRepositoryInterface) {
        $this->roleRepositoryInterface = $roleRepositoryInterface;
    }

    public function index() {
        $data = $this->roleRepositoryInterface->index();

        return ApiResponseClass::sendResponse(RoleResource::collection($data), '', 200);
    }

    public function store(StoreRoleRequest $request) {
        $details = [
            'name' => $request->name
        ];
        DB::beginTransaction();
        try {
            $role = $this->roleRepositoryInterface->store($details);

            DB::commit();
            return ApiResponseClass::sendResponse(new RoleResource($role), 'Role create successful', 201);
        } catch (\Exception $ex) {
           return ApiResponseClass::rollback($ex);
        }
    }

    public function show($id) {
        $role = $this->roleRepositoryInterface->getById($id);

        return ApiResponseClass::sendResponse(new RoleResource($role), '', 200);
    }

    public function update(UpdateRoleRequest $request, $id)
    {
        $updateDetails =[
            'name' => $request->name
        ];
        DB::beginTransaction();
        try{
             $product = $this->roleRepositoryInterface->update($updateDetails,$id);

             DB::commit();
             return ApiResponseClass::sendResponse('Product Update Successful','',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    public function destroy($id)
    {
         $this->roleRepositoryInterface->delete($id);

        return ApiResponseClass::sendResponse('Product Delete Successful','',204);
    }
}
