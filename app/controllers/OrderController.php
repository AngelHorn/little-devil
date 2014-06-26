<?php


class OrderController extends BaseController
{
    public function __construct()
    {
        $this->order = Session::get('cart');
    }

    public function postCheckorder()
    {
        echo json_encode($this->order);
    }

    public function postAddToOrder()
    {
        $validator = Validator::make(
            array(
                'tel' => Input::get('tel'),
                'address' => Input::get('address')
            ),
            array(
                'tel' => 'required|min:1|max:20',
                'address' => 'required|min:6|max:60'
            )
        );
        if ($validator->fails()) {
            die('手机号码或地址不符合规则');
        }
        $uid = isset(Auth::user()->id) ? Auth::user()->id : null;
        $orderList = new OrderList();
        $orderList->uid = $uid;
        $orderList->status = 1;
        $orderList->price = $this->order['total'];
        $orderList->tel = Input::get('tel');
        $orderList->address = Input::get('address');
        if (!$orderList->save()) {
            die('提交订单失败, 可能是缺少数据或服务器出错, 如无法解决请联系客服');
        }
        $order_id = $orderList->id;
        $mealList = array();
        foreach ($this->order['meals'] as $meal_id => $meal) {
            array_push($mealList, array(
                'order_id' => $order_id,
                'uid' => isset(Auth::user()->id) ? Auth::user()->id : null,
                'meal_id' => $meal_id,
                'number' => $meal['number']
            ));
        };
        if (count($mealList) > 0) {
            OrderMealList::insert($mealList);
            Session::put('cart', array('meals' => array(), 'total' => 0, 'subtotal' => 0));
            echo 'success';
        } else {
            OrderList::destroy($order_id);//rollback OrderList if no data
            die('提交订单失败, 可能是订单数据为空或服务器出错, 如无法解决请联系客服');
        }
    }

    public function postDeleteFromorder()
    {
        $meal_id = Input::get('id');
        //empty order
        if ($meal_id == 'all') {
            $this->order = array('meals' => array(), 'total' => 0, 'subtotal' => 0);
        } elseif (isset($this->order['meals'][$meal_id])) {
            $this->order['total'] = $this->order['subtotal'] =
                $this->order['total'] - $this->order['meals'][$meal_id]['number'] * $this->order['meals'][$meal_id]['price'];
            unset($this->order['meals'][$meal_id]);
        }
        echo json_encode($this->order);
    }

    public function __destruct()
    {
        Session::put('order', $this->order);
    }
} 