<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $fillable = [
        'start', 'end', 'project_id'
    ];
	
	/**
	 * The "booted" method of the model.
	 *
	 * @return void
	 */
	protected static function booted()
	{
		static::creating(function (Entry $entry) {
			$entry->start = now();
		});
	}
	
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
