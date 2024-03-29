<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Gallery;

class TravelPackage extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'location',
        'about',
        'featured_event',
        'language',
        'foods',
        'departure_date',
        'duration',
        'type',
        'price'
    ];

    protected $hidden = [];

    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'travel_package_id', 'id');
    }

    public function getAllData()
    {
        $data = TravelPackage::all();
        return $data;
    }

    public function insertData($data = [])
    {
        TravelPackage::insert($data);
        $data = TravelPackage::getPdo()->lastInsertId();
        return $data;
    }

    public function getData($id = 1)
    {
        $data = TravelPackage::where($this->primaryKey, $id)->first();
        return $data;
    }
}
