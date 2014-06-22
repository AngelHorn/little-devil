<?php

/**
 * Created by PhpStorm.
 * User: zhaoyunpeng
 * Date: 14-6-21
 * Time: 下午7:25
 */
class MealClass extends Eloquent
{
    protected $table = "meal_class";

    public function meals()
    {
        return $this->hasMany('MealTable','class_id');
    }
} 