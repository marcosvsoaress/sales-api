<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderModel extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'client_id',
        'status'
    ];

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
