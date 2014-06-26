<?php

class OrderMealList extends Eloquent
{
    protected $table = 'order_meal_list';

    public function mealTable()
    {
        return $this->belongsTo('MealTable', 'meal_id','id');
    }
} 