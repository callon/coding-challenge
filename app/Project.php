<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name'];
	
	protected $appends =[
		'total_time_spent'
	];
	
	public function getTotalTimeSpentAttribute()
	{
		$timeSpentInSeconds = $this->entries()->sum('time_spent');
		return now()
			->setTime(0,0,0)
			->addSeconds($timeSpentInSeconds)
			->format('H:i:s');
	}

    public function entries()
    {
        return $this->hasMany(Entry::class);
    }
}
