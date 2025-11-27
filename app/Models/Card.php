<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = ['column_id', 'title', 'description', 'position'];
    
    protected static function booted()
    {
        static::creating(function ($card) {
            if (is_null($card->position)) {
                $card->position = static::where('column_id', $card->column_id)->max('position') + 1 ?? 0;
            }
        });
    }
    
    public function column()
    {
        return $this->belongsTo(Column::class);
    }
    
    public function scopeOrdered($query)
    {
        return $query->orderBy('position');
    }
    
    public function move($newPosition, $newColumnId = null)
    {
        $oldPosition = $this->position;
        $oldColumnId = $this->column_id;
        $newColumnId = $newColumnId ?? $oldColumnId;
        
        if ($newColumnId === $oldColumnId) {
            // Moving within same column
            if ($newPosition === $oldPosition) {
                return;
            }
            
            if ($newPosition < $oldPosition) {
                // Moving up - shift others down
                static::where('column_id', $oldColumnId)
                    ->whereBetween('position', [$newPosition, $oldPosition - 1])
                    ->increment('position');
            } else {
                // Moving down - shift others up
                static::where('column_id', $oldColumnId)
                    ->whereBetween('position', [$oldPosition + 1, $newPosition])
                    ->decrement('position');
            }
            
            $this->update(['position' => $newPosition]);
        } else {
            // Moving to different column
            // Shift cards in old column
            static::where('column_id', $oldColumnId)
                ->where('position', '>', $oldPosition)
                ->decrement('position');
            
            // Shift cards in new column
            static::where('column_id', $newColumnId)
                ->where('position', '>=', $newPosition)
                ->increment('position');
            
            // Update card
            $this->update([
                'column_id' => $newColumnId,
                'position' => $newPosition
            ]);
        }
    }
}
