<?php

namespace App;

use Carbon\Carbon;
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
		
		static::saving(function(Entry $entry){
			if(empty($entry->end)){
				$entry->time_spent = 0;
			} else {
				$start = new Carbon($entry->start);
				$end = new Carbon($entry->end);
				$entry->time_spent = $start->diffInSeconds($end);
			}
		});
	}
	
	public function getTimeSpentAttribute()
	{
		if(empty($this->attributes['end'])){
			return 'Still running..';
		}
		
		return now()
			->setTime(0,0,0)
			->addSeconds($this->attributes['time_spent'])
			->format('H:i:s');
	}
	
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
