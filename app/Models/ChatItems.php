<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ChatItems extends Model
{
    use HasFactory;
    protected $table = 'chat_items';
    public $timestamps = false;
    protected $hidden =['deleted_at'];
    protected $fillable=['user_id','role_id','title','model_id','created_at','updated_at','deleted_at','state','use_context'];
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
    public function role()
    {
        return $this->hasOne('App\Models\ChatRole','id','role_id');
    }
}
