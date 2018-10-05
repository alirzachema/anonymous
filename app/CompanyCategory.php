<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CompanyCategory
 *
 * @package App
 * @property string $name
 * @property text $description
 * @property string $photo
*/
class CompanyCategory extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'photo'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        CompanyCategory::observe(new \App\Observers\UserActionsObserver);
    }
    
}
