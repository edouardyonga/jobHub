<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['company', 'user_id','title', 'email', 'website', 'tags',  'location', 'description', 'logo'];

    public function scopeFilter($query, array $filters)
    {
        if($filters['tag'] ?? false){
            $query->where('tags','like','%'. request('tag') .'%');
        }

        if ($filters['search'] ?? false) {
            $query->where('title','like','%'. request('search') .'%')
                    ->orwhere('description', 'like', '%'. request('search') .'%')
                    ->orwhere('company', 'like', '%'. request('search') .'%')
                    ->orwhere('location', 'like', '%'. request('search') .'%')
                    ->orwhere('website', 'like', '%'. request('search') .'%')
                    ->orwhere('tags','like','%'. request('tag') .'%');
        }
    }

    // Relationship To User
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
