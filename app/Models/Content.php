<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nanigans\SingleTableInheritance\SingleTableInheritanceTrait;

class Content extends Model
{
    use SingleTableInheritanceTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contents';

    protected static $singleTableTypeField = 'subclass';

    protected static $singleTableSubclasses = [
        Article::class,
        InfoResource::class,
        // Thread::class,
        Publication::class
    ];

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
}
