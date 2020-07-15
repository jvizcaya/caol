<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;

class PerformanceController extends Controller
{
    /**
     * Show the user list with role consultant.
     * @author Jorge Vizcaya <jorgevizcayaa@gmail.com>
     *
     * @param null
     * @return View
     */
    public function index()
    {
            $users =  User::select('co_usuario','no_usuario')->role()->whereHas('salary')
                            ->with('salary:co_usuario,brut_salario')->get();

            $invoices = User::select('co_usuario','no_usuario')->role()
                              ->with('salary')->loadInvoices()->get();

            return view('performance', compact(['users', 'invoices']));
    }
}
