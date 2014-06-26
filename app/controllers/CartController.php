<?php


class CartController extends BaseController
{
    public function __construct()
    {
        $this->cart = Session::get('cart');
    }

    public function postCheckCart()
    {
        echo json_encode($this->cart);
    }

    public function postAddToCart()
    {
        $meal_id = Input::get('id');
        $number = Input::get('number') > 0 ? Input::get('number') : 1;
        $option = Input::get('option');
        if (isset($this->cart['meals'][$meal_id])) {
            if ($option == 'add') {
                $number_sum = $number;
                $this->cart['meals'][$meal_id]['number'] = $this->cart['meals'][$meal_id]['number'] + $number;
            } elseif ($option == 'total') {
                $number_sum = $number - $this->cart['meals'][$meal_id]['number'];
                $this->cart['meals'][$meal_id]['number'] = $number;
            } else {
                die('呵呵');
            }
            $this->cart['total'] = $this->cart['subtotal'] = $this->cart['total'] + $this->cart['meals'][$meal_id]['price'] * $number_sum;
        } else {
            $meal = MealTable::where('id', $meal_id)->first();
            $this->cart['meals'][$meal_id]['price'] = $meal->price;
            $this->cart['meals'][$meal_id]['name'] = $meal->name;
            $this->cart['meals'][$meal_id]['name_en'] = $meal->name_en;
            $this->cart['meals'][$meal_id]['number'] = $number;
            $this->cart['total'] = $this->cart['subtotal'] =
                $this->cart['total'] + $this->cart['meals'][$meal_id]['price'] * $number;
        }
        echo json_encode($this->cart);
    }

    public function postDeleteFromCart()
    {
        $meal_id = Input::get('id');
        //empty cart
        if ($meal_id == 'all') {
            $this->cart = array('meals' => array(), 'total' => 0, 'subtotal' => 0);
        } elseif (isset($this->cart['meals'][$meal_id])) {
            $this->cart['total'] = $this->cart['subtotal'] =
                $this->cart['total'] - $this->cart['meals'][$meal_id]['number'] * $this->cart['meals'][$meal_id]['price'];
            unset($this->cart['meals'][$meal_id]);
        }
        echo json_encode($this->cart);
    }

    public function __destruct()
    {
        Session::put('cart', $this->cart);
    }
} 