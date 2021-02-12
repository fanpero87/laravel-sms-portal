<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersPhoneNumber extends Model
{
    use HasFactory;

    /* This command tells the Model what table should use */
    protected $table= "users_phone_number";
    
    /* This command define which field of the table 
    you want to make mass assignable */
    protected $fillable = [
        'phone_number'
    ];
}
