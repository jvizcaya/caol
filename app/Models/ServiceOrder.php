<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cao_os';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'co_os';

    /**
     * Get the invoices associated with the servide order.
     */
    public function invoices()
    {
        return $this->hasMany('App\Models\Invoice', 'co_os');
    }

    

}
