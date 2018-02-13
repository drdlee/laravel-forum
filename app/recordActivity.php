<?php

namespace App;

trait recordActivity
{
    protected static function bootRecordActivity()
    {
        if(auth()->guest()) return;

        foreach (static::getAtivitiesToRecord() as $event){
            static::$event(function ($threadOrReply) use ($event){
                $threadOrReply->recordActivity($event);
            });
        }
    }

    protected static function getAtivitiesToRecord(){
        return ['created'];
    }

    protected function recordActivity($event){
            Activity::create([
                'user_id' => auth()->id(),
                'type' => $this->getActivityType($event),
                'subject_id' => $this->id,
                'subject_type' => get_class($this)
            ]);
        }

    protected function getActivityType($event){
        $type = strtolower((new \ReflectionClass($this))->getShortName());
        return "{$event}_{$type}";
    }
}
