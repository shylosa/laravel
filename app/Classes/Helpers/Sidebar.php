<?php

namespace App\Classes\Helpers;

use Doctrine\DBAL\Driver\Exception;
use Illuminate\Support\Facades\DB;

class Sidebar
{
    /**
     * @return array
     */
    public static function getSidebar(): array
    {
        $menu = config('adminlte.menu');
        $sidebar = [];
        foreach ($menu as $menuItem) {
            try {
                $menuItem['count'] = DB::table($menuItem['table'])->get()->count();
                $sidebar[] = $menuItem;
            } catch (Exception $e) {
                echo __('Подключение не удалось: ') . $e->getMessage();
            }
        }

        return $sidebar;
    }
}
