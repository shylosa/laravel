<?php

namespace App;

use Doctrine\DBAL\Driver\PDOException;
use Illuminate\Database\Eloquent\Model;

abstract class AppModel extends Model
{
    public static function sidebarCount(){

        $count = ['categories' => null, 'projects' => null, 'tags' => null, 'users' => null];

        foreach ($count as $table => $amount) {
            try {
                $count[$table] = \DB::table($table)
                    ->get()
                    ->count();
            } catch (PDOException $e) {
                echo 'Подключение не удалось: ' . $e->getMessage();
            }

        }

        return $count;
    }
}
