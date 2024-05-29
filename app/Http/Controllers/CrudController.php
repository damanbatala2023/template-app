<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redis;



class CrudController extends Controller
{
    public function getRecordForm(Request $request)
    {
        $users = User::all();
        return view('page.record', compact('users'));
    }

    public function getCreateForm()
    {
        return view('page.create');
    }
    public function postCreateForm()
    {
        
    }
}
