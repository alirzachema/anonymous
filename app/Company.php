<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;

/**
 * Class Company
 *
 * @package App
 * @property string $company_logo
 * @property string $name
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $country
*/
class Company extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    protected $fillable = ['company_logo', 'name', 'address', 'country', 'city_id', 'state_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Company::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCityIdAttribute($input)
    {
        $this->attributes['city_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setStateIdAttribute($input)
    {
        $this->attributes['state_id'] = $input ? $input : null;
    }
    
    public function categories()
    {
        return $this->belongsToMany(CompanyCategory::class, 'company_company_category')->withTrashed();
    }
    
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id')->withTrashed();
    }
    
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id')->withTrashed();
    }
    
}
