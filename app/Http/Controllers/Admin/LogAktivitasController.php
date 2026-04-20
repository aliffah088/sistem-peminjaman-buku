<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class LogAktivitasController extends Controller
{
    public function index()
    {
        $logs = [];

        return view('admin.log.index', compact('logs'));
    }
}