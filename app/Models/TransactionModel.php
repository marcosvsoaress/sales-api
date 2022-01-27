<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionModel extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'total',
        'method_payment',
        'transaction_id',
        'status',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transactions';

    /**
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItemsModel::class, 'order_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function client(): HasOne
    {
        return $this->hasOne(ClientModel::class, 'id', 'client_id');
    }

}
