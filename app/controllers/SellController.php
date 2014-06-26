<?php

class SellController extends BaseController
{
    public function getIndex()
    {
        if (!Session::has('cart')) {
            Session::put('cart', array('meals' => array(), 'total' => 0, 'subtotal' => 0));
        }
        return View::make('sell.blog.index')
            ->with('classes', MealClass::get());
    }

    public function getDescription()
    {
        echo MealTable::where('id', Input::get('id'))->pluck('description');
    }

} 