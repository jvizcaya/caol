<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cao_fatura';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'co_fatura';


    public function service_order()
    {
        return $this->belongsTo('App\Models\ServiceOrder', 'co_os');
    }


}
