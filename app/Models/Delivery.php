<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    public function truck()
    {
        return $this->belongsTo(Truck::class, 'truck_id');
    }
    public function client()
{
    return $this->belongsTo(Client::class, 'client_id');
}

    use HasFactory;

    // Define the table name (if it's not the plural form of the model name)
    protected $table = 'deliveries'; 

    // Set the primary key (optional, as Laravel assumes 'id' by default)
    protected $primaryKey = 'id';

    // Ensure that the primary key is unsigned if it's in your table schema
    protected $keyType = 'string'; // or 'int' based on your actual column type, 'bigint' is usually unsigned

    // Enable auto-increment for the primary key
    public $incrementing = true;

    // Set the fillable columns (to allow mass assignment)
    protected $fillable = [
        'doNo',
        'dimension',
        'pulloutDate',
        'vanNo',
        'client',
        'driver',
        'licensePlate',
        'cargoDetails',
        'location',
        'returnDate',
        'status',
        'truckingFee',
        'truck_id',
        'created_at',
        'updated_at',
    ];

    // Set the dates that should be treated as Carbon instances (useful for date columns)
    protected $dates = [
        'pulloutDate',
        'returnDate',
        'created_at',
        'updated_at',
    ];

    // Define the timestamp format (optional, adjust as needed)
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    // Optionally, if the timestamps are disabled in the table, set this to false
    public $timestamps = true;

    // Define the default attributes for new records (if applicable)
    protected $attributes = [
        'status' => 'pending', // example default value
    ];
}


