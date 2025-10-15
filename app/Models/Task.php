<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  use HasFactory;

  protected $table = 'tasks';
  protected $primaryKey = 'task_id';

  protected $fillable = [
    'user_id',
    'title',
    'description',
    'status',
    'deadline',
    'created_by',
  ];

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id', 'user_id');
  }
}
