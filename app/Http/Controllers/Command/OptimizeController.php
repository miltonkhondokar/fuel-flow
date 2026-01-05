<?php

namespace App\Http\Controllers\Command;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use RealRashid\SweetAlert\Facades\Alert;

class OptimizeController extends Controller
{
    public function clear()
    {
        Artisan::call('optimize:clear');
        Alert::success('Success', 'Cache cleared and optimized!')->persistent('OK');
        return redirect()->back();
    }
}