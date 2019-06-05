<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;

class UserExportController extends Controller
{
    public function __invoke()
    {
        (new UsersExport())->queue('users.xlsx');

        return response('Job Creado', Response::HTTP_OK, ['Content-Type' => 'text/plain']);

        // return Excel::download(new UsersExport, 'users.xlsx');
    }
}
