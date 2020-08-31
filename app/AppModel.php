<?php

namespace App;

use DB;
use Doctrine\DBAL\Driver\PDOException;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AppModel
 * @package App
 */
abstract class AppModel extends Model
{
    /**
     * Count elements in sidebar
     *
     * @return array
     */
    public static function sidebarCount()
    {
        $count = [
            'categories' => null,
            'projects' => null,
            'tags' => null,
            'users' => null
        ];

        foreach ($count as $table => $amount) {
            try {
                $count[$table] = DB::table($table)->get()->count();
            } catch (PDOException $e) {
                echo __('Подключение не удалось: ') . $e->getMessage();
            }

        }

        return $count;
    }
}
