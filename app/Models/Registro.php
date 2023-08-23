<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'registros';
    protected $fillable = ['type', 'message', 'is_identified', 'whistleblower_name', 'whistleblower_birth', 'deleted', 'created_at'];
}
