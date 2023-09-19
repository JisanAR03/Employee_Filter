<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resume extends Model
{
    use HasFactory;
    protected $fillable = ['last_engagement_date','name','current_position','current_company','prev_comps_with_pos','average_stay','work_experience','salary','location','notes','city','resume_link'];

    public function list_datas():HasMany{
        return $this->hasMany(ListData::class);
    }
}
