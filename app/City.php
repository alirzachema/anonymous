<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class City
 *
 * @package App
 * @property string $name
*/
class City extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        City::observe(new \App\Observers\UserActionsObserver);
    }
    
    public function companies() {
        return $this->hasMany(Company::class, 'city_id');
    }
}
