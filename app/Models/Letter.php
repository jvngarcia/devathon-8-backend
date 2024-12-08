<?php

/**
 * Letter model
 *
 * PHP version 8
 *
 * @category Model
 * @package  Model\Letetr
 * @author   Darío Jesús Ramírez Romero <dariojesusramirez@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/jvngarcia/devathon-8-backend.git
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Letter model
 * 
 * @category Model
 * @package  Model\Letter
 * @author   Darío Jesús Ramírez Romero <dariojesusramirez@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/jvngarcia/devathon-8-backend.git
 */
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
    'read',
    'image_url'
  ];

  /**
   * The attributes that should be cast.
   * 
   * @var array
   */

  protected $casts = [
    'read' => 'boolean',
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
