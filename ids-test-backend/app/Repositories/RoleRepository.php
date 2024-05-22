<?php

namespace App\Repositories;

use App\Models\Role;
use App\Interfaces\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{
    public function index(){
        return Role::all();
    }

    public function getById($id){
       return Role::findOrFail($id);
    }

    public function store(array $data){
       return Role::create($data);
    }

    public function update(array $data,$id){
       return Role::whereId($id)->update($data);
    }
    
    public function delete($id){
       Role::destroy($id);
    }
}
