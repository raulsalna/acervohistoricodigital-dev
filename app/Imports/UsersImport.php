<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'username'=> $row['nombre_de_usuario'],
            'cat_profile_id'=> $row['cat_profile_id'],
            'name'=> $row['name'],
            'firstName' => $row['firstname'],
            'secondName' => $row['secondname'],
            'isActive' => $row['isactive'],
        ]);
    }
}
