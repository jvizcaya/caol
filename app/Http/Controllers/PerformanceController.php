<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
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
        //$invoices = '';



        $users = User::with('salary')
                      ->whereHas('permissions', function (Builder $query) {
                          $query->whereIn('co_tipo_usuario', [0,1,2])
                                ->where('co_sistema', 1)
                                ->where('in_ativo', 'S');
                      })->with(['invoices' => function ($query) {
                          $query->selectRaw('YEAR(data_emissao) as year')
                                  ->selectRaw('MONTH(data_emissao) as month')
                                  ->selectraw('SUM(total - ((total_imp_inc / 100) * cao_fatura.total)) as income')
                                  //->selectraw('SUM(total) as income')
                                  ->groupBy('cao_os.co_usuario', 'year', 'month');
                      }])->get();

        //return $users;
        //if(request()->filled(['q', 'values']))
        //{
              /*$invoices = Invoice::select('*')
                    ->selectraw('cao_fatura.total - ((cao_fatura.total_imp_inc / 100) * cao_fatura.total ) as income')
                    ->whereHas('service_order', function (Builder $query){
                      $query->where('co_usuario', 'carlos.arruda')
                            ->whereYear('data_emissao', 2007)
                            ->whereMonth('data_emissao', 1);
              })->get();*/
  //print_r($invoices->count());
              //print_r($invoices->sum('income'));
        //}*/

        

        return view('welcome', compact('users'));
    }
}
