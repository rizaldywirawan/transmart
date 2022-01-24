<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;


class UserTableController extends Controller
{
    public function index()
    {
        $users = User::with(['profile'])->get()->toArray();
        $user = DataTables::of($users)
                        ->addIndexColumn()
                        ->addColumn('name', 'pages.users.datatables.name')
                        ->addColumn('jobtitle', 'pages.users.datatables.job-title')
                        ->addColumn('phone', 'pages.users.datatables.phone')
                        ->addColumn('company', 'pages.users.datatables.company')
                        ->addColumn('action', 'pages.users.datatables.action')
                        ->rawColumns(
                            [
                                'name','jobtitle','phone','company' ,'action'
                            ]
                        )
                        ->make(true);

        return $user;
    }
}
