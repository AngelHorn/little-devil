<?php

class SellController extends BaseController
{
    public function getIndex(){
//        echo MealClass::find(1)->meals()->get()->toJson();die;
        return View::make('sell.blog.index')
            ->with('classes',MealClass::get());
    }

} 