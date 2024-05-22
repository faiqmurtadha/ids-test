<?php

namespace App\Http\Controllers\Api;

use App\Classes\ApiResponseClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface) {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function index() {
        $data = $this->userRepositoryInterface->index();

        return ApiResponseClass::sendResponse(UserResource::collection($data), '', 200);
    }

    public function store(StoreUserRequest $request) {
        $details = [
            'name' => $request->name
        ];
        DB::beginTransaction();
        try {
            $user = $this->userRepositoryInterface->store($details);

            DB::commit();
            return ApiResponseClass::sendResponse(new UserResource($user), 'User create successful', 201);
        } catch (\Exception $ex) {
           return ApiResponseClass::rollback($ex);
        }
    }

    public function show($id) {
        $user = $this->userRepositoryInterface->getById($id);

        return ApiResponseClass::sendResponse(new UserResource($user), '', 200);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $updateDetails =[
            'name' => $request->name
        ];
        DB::beginTransaction();
        try{
             $product = $this->userRepositoryInterface->update($updateDetails,$id);

             DB::commit();
             return ApiResponseClass::sendResponse('Product Update Successful','',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    public function destroy($id)
    {
         $this->userRepositoryInterface->delete($id);

        return ApiResponseClass::sendResponse('Product Delete Successful','',204);
    }
}
