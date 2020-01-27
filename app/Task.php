<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    const STATUS = [
        1 => [ 'label' => '未着手', 'class' => 'label-danger' ],
        2 => [ 'label' => '着手中', 'class' => 'label-info' ],
        3 => [ 'label' => '完了', 'class' => '' ],
    ];

    //アクセサ

    //数字を状態に
    public function getStatusLabelAttribute()
    {
        $status = $this->attributes['status'];

        if(!isset(self::STATUS[$status])) {
            return '';
        }

        return self::STATUS[$status]['label'];

    }

    //数字によって色を変更
    public function getStatusClassAttribute()
    {
        $status = $this->attributes['status'];

        if(!isset(self::STATUS[$status])) {
            return '';
        }

        return self::STATUS[$status]['class'];

    }

    //期限日の値を変更
    public function getFormattedDueDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['due_date'])
            ->format('Y/m/d');
    }

}
