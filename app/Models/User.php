<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cao_usuario';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'co_usuario';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['ds_senha'];

    /**
     * Get the system permission associated with the user.
     */
    public function permissions()
    {
        return $this->hasMany('App\Models\Permission', 'co_usuario');
    }

    /**
     * Get the salary with the user.
     */
    public function salary()
    {
        return $this->hasOne('App\Models\Salary', 'co_usuario');
    }

    /**
     * Get all invoices for the user.
     */
    public function invoices()
    {
        return $this->hasManyThrough(
                      'App\Models\Invoice',
                      'App\Models\ServiceOrder',
                      'co_usuario',
                      'co_os',
                      'co_usuario',
                      'co_os'
                    );
    }

    /**
     * Scope a query to limit user bry role.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRole($query)
    {
          $query->whereHas('permissions', function (Builder $q) {
                  $q->whereIn('co_tipo_usuario', [0,1,2])
                      ->where('co_sistema', 1)
                      ->where('in_ativo', 'S');
          });


    }

    /**
     * Scope a query load user invoices.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
     public function scopeLoadInvoices($query)
     {
          if(request()->filled(['q', 'values'])){

            $query->whereIn('co_usuario', explode(',', request()->values))
                  ->with(['invoices' => function ($q) {
                    $q->selectRaw('YEAR(data_emissao) as year')
                     ->selectRaw('MONTH(data_emissao) as month')
                     ->selectraw('SUM(valor - ((total_imp_inc / 100) * valor)) as income')
                     ->selectraw('SUM((comissao_cn / 100) * (valor - (total_imp_inc / 100) * total )) as commission')
                     ->groupBy('cao_os.co_usuario', 'year', 'month');
                }]);
          }
     }


}
