<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new User([
            'nombre' => $row['nombre'],
            'app' => $row['app'],
            'apm' => $row['apm'],
            'fn' => $row['fn'],
            'telefono' => $row['telefono'],
            'email' => $row['email'],
        ]);
    }
}