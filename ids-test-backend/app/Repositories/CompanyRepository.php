<?php

namespace App\Repositories;

use App\Models\Company;
use App\Interfaces\CompanyRepositoryInterface;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function index(){
        return Company::all();
    }

    public function getById($id){
       return Company::findOrFail($id);
    }

    public function store(array $data){
       return Company::create($data);
    }

    public function update(array $data,$id){
       return Company::whereId($id)->update($data);
    }
    
    public function delete($id){
       Company::destroy($id);
    }
}
