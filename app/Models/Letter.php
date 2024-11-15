<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
  use HasFactory;

  /** 
   * The attributes that are mass assignable.
   * 
   * @var array<string>
   */

  protected $fillable = [
    'sender',
    'subject',
    'content',
    'created_at',
    'read',
    'image'
  ];

  /**
   * The model's default values for attributes.
   * 
   * @var array
   */

  protected $attributes = [
    'read' => false,
  ];
}
