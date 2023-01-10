<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as MongoModel;

class Student extends MongoModel
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'students';

    protected $fillable = [ 'name', 'last_name', 'age', 'email', 'course'];
}
