<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutorialPost extends Model
{
    use HasFactory;

    public function tutorials()
    {
        return $this->belongsTo(Tutorial::class);
    }
    public function sections()
    {
        return $this->belongsTo(TutorialSection::class);
    }
}
