<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ticketModel;
use Illuminate\Http\Request;

class statisticController extends Controller
{
    public function statistic()
    {
        $data = ticketModel::where('TTV', 2)->sum('giave');
        dd($data);
    }
}
