<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

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



}
