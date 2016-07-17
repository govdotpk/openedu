<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    //
    protected $table = 'feedback';

    protected $fillable = ['id', 'sender_num', 'receiver_num', 'gsm_network', 'time', 'text'];
}
