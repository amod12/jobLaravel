<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory; 

    // protected $fillable = ['title', 'company', 'location', 'website', 'email', 'description', 'tags'];

    // here data is filtered according to query and send to as items
    public function scopeFilter($query, array $filters) {
        // dd($filters);
        if($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
            // means the tags in url can be like something tagNeeded something
        }

        if($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }

    // Relationship To User
    // item belongs to user
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
