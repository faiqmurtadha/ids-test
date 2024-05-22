<?php

namespace App\Http\Controllers\Api;

use App\Classes\ApiResponseClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use App\Http\Resources\PositionResource;
use App\Interfaces\PositionRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PositionController extends Controller
{
    private PositionRepositoryInterface $positionRepositoryInterface;

    public function __construct(PositionRepositoryInterface $positionRepositoryInterface) {
        $this->positionRepositoryInterface = $positionRepositoryInterface;
    }

    public function index() {
        $data = $this->positionRepositoryInterface->index();

        return ApiResponseClass::sendResponse(PositionResource::collection($data), '', 200);
    }

    public function store(StorePositionRequest $request) {
        $details = [
            'name' => $request->name
        ];
        DB::beginTransaction();
        try {
            $position = $this->positionRepositoryInterface->store($details);

            DB::commit();
            return ApiResponseClass::sendResponse(new PositionResource($position), 'Position create successful', 201);
        } catch (\Exception $ex) {
           return ApiResponseClass::rollback($ex);
        }
    }

    public function show($id) {
        $position = $this->positionRepositoryInterface->getById($id);

        return ApiResponseClass::sendResponse(new PositionResource($position), '', 200);
    }

    public function update(UpdatePositionRequest $request, $id)
    {
        $updateDetails =[
            'name' => $request->name
        ];
        DB::beginTransaction();
        try{
             $product = $this->positionRepositoryInterface->update($updateDetails,$id);

             DB::commit();
             return ApiResponseClass::sendResponse('Product Update Successful','',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    public function destroy($id)
    {
         $this->positionRepositoryInterface->delete($id);

        return ApiResponseClass::sendResponse('Product Delete Successful','',204);
    }
}
