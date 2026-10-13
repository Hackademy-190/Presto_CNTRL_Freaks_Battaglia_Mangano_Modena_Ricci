<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['title', 'description', 'price', 'user_id', 'category_id'])]
class Advertisement extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function setAccepted($value)
    {
        $this->is_accepted = $value;
        $this->save();
        return true;
    }
    
    public static function toBeRevisedCount()
    {
        return Advertisement::where('is_accepted', null)->count();
    }
}
