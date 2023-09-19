<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ListModel extends Model
{
    use HasFactory;
    protected $table = 'lists';
    protected $fillable = ['name'];

public function listData():HasMany{
    return $this->hasMany(ListData::class);
}
}
