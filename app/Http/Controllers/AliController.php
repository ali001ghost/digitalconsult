<?php

namespace App\Http\Controllers;

use App\Models\ali;
use Illuminate\Http\Request;

class AliController extends Controller
{

    public function store(Request $request)
    {
        ali::query()->create(
            [
               'name'=>$request->name,

            ]
        );
    }
}
