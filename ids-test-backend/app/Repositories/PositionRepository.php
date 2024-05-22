<?php

namespace App\Repositories;

use App\Models\Position;
use App\Interfaces\PositionRepositoryInterface;

class PositionRepository implements PositionRepositoryInterface
{
    public function index(){
        return Position::all();
    }

    public function getById($id){
       return Position::findOrFail($id);
    }

    public function store(array $data){
       return Position::create($data);
    }

    public function update(array $data,$id){
       return Position::whereId($id)->update($data);
    }
    
    public function delete($id){
       Position::destroy($id);
    }
}
