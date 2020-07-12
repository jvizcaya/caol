<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Invoice;

class PerformanceController extends Controller
{
    /**
     * Show the user list with role consultant.
     *
     * @param null
     * @return View
     */
    public function index()
    {
            $users = User::with('salary')->role()->loadInvoices()->get();

            return view('welcome', compact('users'));
    }
}
