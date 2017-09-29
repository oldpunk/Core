<?php

namespace Modules\Core\Repositories;


use Modules\Core\Entities\Modules;
use Modules\Core\Entities\User;

class ModulesRepository
{
    private $model;

    public function __construct(Modules $modules)
    {
        $this->model = $modules;
    }

    public function getAllModules()
    {
        $items = Modules::orderBy('title')->get();

        return $this->getList($items);
    }

    public function getUserModules(User $user)
    {
        if($user->is_admin()){
            $items = $this->getAllModules();
        }else{
            $items = $this->getList($user->modules);
        }

        return $items;
    }

    public function sections($short = false)
    {
        $items = [
            'modules' => ['name' => 'Модули', 'icon' => 'icon-home'],
            'dic' => ['name' => 'Справочники', 'icon' => 'icon-notebook'],
            'structure' => ['name' => 'Структура сайта', 'icon' => 'icon-diamond'],
            'accesses' => ['name' => 'Права доступа', 'icon' => 'icon-user'],
            'tools' => ['name' => 'Инструменты', 'icon' => 'icon-settings'],
        ];

        if($short){
            foreach ($items as &$item){
                $item = $item['name'];
            }
        }

        return $items;
    }

    private function getList($items)
    {
        $modules = [];
        foreach ($items as $item){
            $modules[$item->section][] = $item;
        }

        return $modules;
    }
}