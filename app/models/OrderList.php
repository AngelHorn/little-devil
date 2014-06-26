<?php

class OrderList extends Eloquent
{
    protected $table = 'order_list';

    public function orderMealList()
    {
        return $this->hasMany('OrderMealList', 'order_id');
    }
} 