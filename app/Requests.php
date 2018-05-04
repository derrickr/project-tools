<?php

namespace App;

use App\Models\BaseModel;
use Carbon\Carbon;
class Requests extends BaseModel
{
    const STATUS_NEW = 'New';
    const STATUS_FAST_TRACK = 'Fast Tracked';
    const STATUS_CANCEL = 'Cancelled';
    const STATUS_REJECT = 'Rejected';
    const STATUS_MOREINFO = 'More Info';
    const STATUS_ACCEPT = 'Accepted';
    const STATUS_SCHEDULE = 'Scheduled';
    const STATUS_MORETIME = 'More Time';
    const STATUS_APPROVED = 'Approved';
    const STATUS_COMPLETED = 'Completed';
    const STATUS_ANALYSED = 'Analysed';
    const STATUS_REOPEN = 'Reopened';
    const STATUS_COSTED = 'Costed';
    const STATUS_FAILTESTING = 'Failed Testing';
    const STATUS_FAILEDTESTING = 'Failed Testing';
    const STATUS_IMPLEMENTED = 'Implemented';
    const STATUS_REWORKING = 'Reworking';
    const STATUS_BACKINGOUT = 'Backing out';
    const STATUS_BACKEDOUT = 'Backed Out';
    const STATUS_PASS = 'Pass';
    
    public function m_requester(){
        return $this->hasOne(User::class,'email','requester');
    }
    public function setRequiredDateAttribute($value) {
        if ($value && $value instanceof Carbon) {
            $this->attributes['required_date'] = $value->format('Y-m-d');
            return;
        }
        if($value=datetimeToDBFormat($value))
        $this->attributes['required_date'] = $value->format('Y-m-d h:m:i');
    }
    public function setPlannedStartAttribute($value) {
        if ($value && $value instanceof Carbon) {
            $this->attributes['planned_start'] = $value;
            return;
        }
        if($value=datetimeToDBFormat($value))
        $this->attributes['planned_start'] = $value->format('Y-m-d');
    }
    public function setPlannedFinishAttribute($value) {
        if ($value && $value instanceof Carbon) {
            $this->attributes['planned_finish'] = $value;
            return;
        }
        if($value=datetimeToDBFormat($value))
        $this->attributes['planned_finish'] = $value->format('Y-m-d');
    }
    public function setSubmittedDateAttribute($value) {
        if ($value && $value instanceof Carbon) {
            $this->attributes['submitted_date'] = $value;
            return;
        }
        if($value=datetimeToDBFormat($value))
        $this->attributes['submitted_date'] = $value->format('Y-m-d h:m:i');
    }
    
    public function setSkillsAttribute($skills) {
        if ($skills && is_array($skills)) {
            $key_val_skills='';
            foreach ($skills as $key => $value) {
                $key_val_skills .= $key . "=" . $value . ",";
            }
            $skills = rtrim($key_val_skills, ',');
            $this->attributes['skills'] = $skills;
            return;
        }
        if(empty($skills)){
            $this->attributes['skills'] = null;
            return;
        }
        $this->attributes['skills'] = $skills;
    }
}
