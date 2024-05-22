<?php

namespace App\Http\Controllers\Api;

use App\Classes\ApiResponseClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Interfaces\CompanyRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    private CompanyRepositoryInterface $companyRepositoryInterface;

    public function __construct(CompanyRepositoryInterface $companyRepositoryInterface) {
        $this->companyRepositoryInterface = $companyRepositoryInterface;
    }

    public function index() {
        $data = $this->companyRepositoryInterface->index();

        return ApiResponseClass::sendResponse(CompanyResource::collection($data), '', 200);
    }

    public function store(StoreCompanyRequest $request) {
        $details = [
            'name' => $request->name
        ];
        DB::beginTransaction();
        try {
            $company = $this->companyRepositoryInterface->store($details);

            DB::commit();
            return ApiResponseClass::sendResponse(new CompanyResource($company), 'Company create successful', 201);
        } catch (\Exception $ex) {
           return ApiResponseClass::rollback($ex);
        }
    }

    public function show($id) {
        $company = $this->companyRepositoryInterface->getById($id);

        return ApiResponseClass::sendResponse(new CompanyResource($company), '', 200);
    }

    public function update(UpdateCompanyRequest $request, $id)
    {
        $updateDetails =[
            'name' => $request->name
        ];
        DB::beginTransaction();
        try{
             $product = $this->companyRepositoryInterface->update($updateDetails,$id);

             DB::commit();
             return ApiResponseClass::sendResponse('Product Update Successful','',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    public function destroy($id)
    {
         $this->companyRepositoryInterface->delete($id);

        return ApiResponseClass::sendResponse('Product Delete Successful','',204);
    }
}
