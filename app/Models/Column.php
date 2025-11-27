<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    protected $fillable = ['name', 'position'];
    
    protected static function booted()
    {
        static::creating(function ($column) {
            if (is_null($column->position)) {
                $column->position = static::max('position') + 1 ?? 0;
            }
        });
    }
    
    public function cards()
    {
        return $this->hasMany(Card::class)->orderBy('position');
    }
    
    public function scopeOrdered($query)
    {
        return $query->orderBy('position');
    }
    
    public function move($newPosition)
    {
        $oldPosition = $this->position;
        
        if ($newPosition === $oldPosition) {
            return;
        }
        
        if ($newPosition < $oldPosition) {
            // Moving up - shift others down
            static::whereBetween('position', [$newPosition, $oldPosition - 1])
                ->increment('position');
        } else {
            // Moving down - shift others up
            static::whereBetween('position', [$oldPosition + 1, $newPosition])
                ->decrement('position');
        }
        
        $this->update(['position' => $newPosition]);
    }
}
