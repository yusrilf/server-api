<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];
    protected $table ='project';
    protected $fillable =[
        'id_user',
        'judul',
        'kebutuhan',
        'biaya',
        'lampiran',
        'created_at',
        'updated_at'];

}
