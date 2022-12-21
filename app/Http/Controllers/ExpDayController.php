<?php

namespace App\Http\Controllers;

use App\Models\ExpDay;
use Illuminate\Http\Request;

class ExpDayController extends Controller
{
    public function store(Request $request)
    {
        $result = ExpDay::query()->create([
            'day' => $request->day,
            'from_hour' => $request->from_hour,
            'to_hour' => $request->to_hour,
            'notes' => $request->notes
        ]);
    }
}
