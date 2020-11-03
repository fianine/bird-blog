<?php

namespace App\Traits;

use Carbon\Carbon;

trait Timezone {
    public function getArticleTimezone($attribute, $format = 'd F Y H:i') {
        $timezone = 'Asia/Jakarta';
        if(Carbon::parse($this->{$attribute}) instanceof Carbon) {
            $data = Carbon::parse($this->{$attribute})->timezone($timezone);
        } else {
            return '-';
        }
        return $data->format($format);
    }
}