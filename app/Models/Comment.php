<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Comment extends Model
{
    // php artisan make:model Comment -mf
    //마이그레이션 팩토리 자동생성 옵션
    use HasFactory;

    //둘중에 하나만 있어도 됨 
    protected $fillable = [
        "text", "user_id", 'image'
    ]; //가능한 항목 적는것

    // protected $guard = []; //사용 불가능한 것 적어주는것 

    public function writer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function getImagePathAttribute()
    {
        return 'storage/images/' . $this->image;
    }
}
