<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = ['img_url','firstName','lastName','email','mobile','password','otp','status','role'];
    protected $attributes = ['otp' => '0'];
    protected $hidden = ['password', 'otp'];

}
