<?php

namespace Newpixel\StaticPageCRUD\App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class StaticPage extends Model
{
    use CrudTrait;
    use Sluggable, SluggableScopeHelpers;
    use SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'static_pages';
    public static $displayZones = [null => '-', 'header' => 'Antet', 'footer' => 'Subsol', 'headerfooter' => 'Antet si subsol'];
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['name', 'display_in_menu', 'details', 'meta', 'active', 'slug', 'parent_id', 'lft', 'rgt', 'depth'];
    protected $fakeColumns = ['meta'];
    // protected $hidden = [];
    protected $dates = ['deleted_at'];

    protected $casts = [
        'meta' => 'object',
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function sluggable()
    {
        return [
            'slug' => ['source' => 'slug_or_name'],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */
    public function getSlugOrNameAttribute()
    {
        ($this->slug != '') ? $slug = $this->slug : $slug = $this->name;

        return $slug;
    }

    public function getOpenButton()
    {
        return '<a class="btn btn-default btn-xs" href="'.url($this->link).'" target="_blank"><i class="fa fa-eye"></i></a>';
    }

    public function getLinkAttribute()
    {
        return url('/static/'.$this->slug.'.html');
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
