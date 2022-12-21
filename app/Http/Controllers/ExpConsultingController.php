<?php

namespace App\Http\Controllers;

use App\Models\ExpConsulting;
use Illuminate\Http\Request;

class ExpConsultingController extends Controller
{
    public function store(Request $request)
    {
        $result = ExpConsulting::query()->where('id',ExpConsulting::user()->id)->create([
            'Co' => $request -> Consulting_name
          ]);
    }
}
