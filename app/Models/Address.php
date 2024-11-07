<?php
/**
 * Address model
 *
 * PHP version 8
 *
 * @category Model
 * @package  Model\Address
 * @author   Juan José Romero <claseinfojuanjose@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/jvngarcia/devathon-8-backend.git
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    /**
    * The attributes that are mass assignable.
    *
    * @var array<string>
    */
    protected $fillable = [
        'address'
    ];

    /**
     * @var string
     */
    protected $primaryKey = 'id';
}
