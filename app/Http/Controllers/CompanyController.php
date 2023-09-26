<?php

namespace App\Http\Controllers;

use App\Models\CompanyAdd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    function index()
    {
        return view("companyAdd");
    }
    function store(Request $request)
    {
        $request->validate([
            'name'=> 'required'
        ]);

        $company = new CompanyAdd;
        $company->name =$request->name;
        $company->save();

        return redirect()->back()->with("success","Company add successfuly!!");
    }
    
}
