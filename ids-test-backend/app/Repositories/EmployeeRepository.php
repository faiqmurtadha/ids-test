<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Interfaces\EmployeeRepositoryInterface;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function index(){
        return Employee::all();
    }

    public function getById($id){
       return Employee::findOrFail($id);
    }

    public function store(array $data){
       return Employee::create($data);
    }

    public function update(array $data,$id){
       return Employee::whereId($id)->update($data);
    }
    
    public function delete($id){
       Employee::destroy($id);
    }
}
