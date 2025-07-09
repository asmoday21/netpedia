<?php

namespace App\Http\Controllers;

use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;

class ExportController extends Controller
{
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
