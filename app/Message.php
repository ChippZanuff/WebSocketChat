<?php
namespace app;


use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'id', 'user_id', 'message',
    ];
}