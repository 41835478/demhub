<?php namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use App\Models\Content;

// class InfoResource extends Model
class InfoResource extends Content
{
  /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	// protected $table = 'info_resources';

  protected static $singleTableType = 'infoResource';
}
