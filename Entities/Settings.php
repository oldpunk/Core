<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{

    public $fillable = ['name', 'value'];
    public $timestamps = false;
    private $params = [];

    public function updateParams(array $params)
    {
        foreach ($params as $key=>$value) {
            $item = $this->firstOrCreate(['name'=>$key]);
            $item->value = $value;
            $item->save();
        }
    }

    public function getAllParams()
    {
        if(!$this->params){
            $list = $this->newQuery()->get(['*'])->toArray();

            foreach ($list as $item) {
                $this->params[$item['name']] = $item['value'];
            }
        }

        return $this->params;
    }

    public function get($name)
    {
        if(!$this->params){
            $this->getAllParams();
        }

        return array_get($this->params, $name, '');
    }
}
