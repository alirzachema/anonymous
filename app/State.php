<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class State
 *
 * @package App
 * @property string $name
*/
class State extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        State::observe(new \App\Observers\UserActionsObserver);
    }
    
    public function companies() {
        return $this->hasMany(Company::class, 'state_id');
    }
}
