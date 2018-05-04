<?php

namespace App;

use App\Models\BaseModel;

class Actions extends BaseModel {

    //
    const ACTION_OPEN = 'Open';
    const ACTION_CLOSE = 'Closed';

    public function m_owner() {
        return $this->hasOne(User::class, 'email', 'owner');
    }

    public function days($incoming) {
        return $incoming <= 1 ? " day" : " days";
    }

    public function get_actual_duration($format = true) {
        if (isset($this->actual_duration)) {
            $actual = $this->actual_duration;
        } else {
            $actual = ceil(((strtotime(date('Ymd'))) - (strtotime($this->identified))) / 86400);
        }
        $style = '';
        if ($this->status == self::ACTION_OPEN) {
            if ($actual > $this->target_duration) {
                $style = "info2";
            }
            if ($actual <= $this->target_duration) {
                $style = "warning"; 
            }
        }
        if ($this->status == self::ACTION_CLOSE) {
            if ($actual > $this->target_duration) {
                $style="danger";
            }
            if ($actual <= $this->target_duration || $actual == "<1") {
                $style="success";
            }
        }
        $actual < 1 ? $actual = "< 1" : $actual = $actual;
        if(!$format)
            return $actual . $this->days($actual);
        return '<span class="label label-'.$style.'">'. $actual . $this->days($actual) . '</span>';
    }

}
