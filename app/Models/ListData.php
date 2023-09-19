<?php

namespace App\Models;

use App\Models\ListModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ListData extends Model
{
    use HasFactory;
    protected $table = 'list_datas';
    protected $fillable = ['list_id','resume_id'];

    public function resumes():BelongsTo{
        return $this->belongsTo(Resume::class);
    }
    public function lists():BelongsTo{
        return $this->belongsTo(ListModel::class);
    }

}
