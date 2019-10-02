<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

abstract class AppModel extends Model
{
    public static function sidebarCount(){

        $count = ['categories' => null, 'projects' => null, 'tags' => null, 'users' => null];

        foreach ($count as $table => $amount) {
            $count[$table] = \DB::table($table)
                ->get()
                ->count();
            }

        return $count;
    }
}
