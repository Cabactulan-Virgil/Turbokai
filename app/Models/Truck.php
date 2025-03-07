<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Http\Controllers\TruckController;

class Truck extends Model
{

    public function deliveries()
{
    return $this->hasMany(Deleviries::class); // Assuming a one-to-many relationship with Delivery
}
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trucks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'truckNo',
        'model',
        'licensePlate',
        'expireDate',
        'renewalDate',
        'driverName',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'expireDate' => 'date',
        'renewalDate' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


}
