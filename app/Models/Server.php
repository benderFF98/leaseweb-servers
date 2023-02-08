<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $fillable = ['model', 'ram', 'hdd', 'location', 'price'];

    public function getPriceAttribute(): string
    {
        $price = $this->attributes['price'];
        return "€" . number_format((float)$price,  2, '.', '');
    }

    public function scopeStorage($query, $storage)
    {
        if (!$storage) {
            return $query;
        }

        return $query->where('hdd', 'LIKE', '%' . $storage . '%');
    }

    public function scopeRam($query, $ram)
    {
        if (!$ram) {
            return $query;
        }

        return $query->where('ram', 'LIKE', '%' . $ram . '%');
    }

    public function scopeLocation($query, $location)
    {
        if (!$location) {
            return $query;
        }

        return $query->where('location', 'LIKE', '%' . $location . '%');
    }
}
