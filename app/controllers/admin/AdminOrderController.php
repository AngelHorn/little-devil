<?php

class AdminOrderController extends AdminController
{
    public function getIndex()
    {
        // Show the page
        return View::make('admin/order/index')
            ->with('title', '订单管理');
    }

    public function getEdit($order)
    {
        $order = OrderList::find($order);
        $order->statusname = $this->transformStatus($order->status);
        return View::make('admin/order/create_edit')
            ->with('title', '查看/更新状态')
            ->with('order', $order);
//        return View::make('admin/blogs/create_edit', compact('post', 'title'));
    }

    public function postEdit($order)
    {

        // Declare the rules for the form validation
        $rules = array(
            'status' => 'required|min:1|max:5',
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes()) {

            // Update the blog post data
            $orderList = OrderList::find($order);
            $orderList->status = Input::get('status');

            // Was the blog post updated?
            if ($orderList->save()) {
                // Redirect to the new blog post page
                return Redirect::to('admin/order/' . $orderList->id . '/edit')->with('success', "提交成功");
            }

            // Redirect to the blogs post management page
            return Redirect::to('admin/order/' . $orderList->id . '/edit')->with('error', "提交失败");
        }

        // Form validation failed
        return Redirect::to('admin/order/' . $order . '/edit')->withInput()->withErrors($validator);
    }

    public function getData()
    {
        $mealClass = OrderList::select(array('status', 'id', 'name', 'address', 'created_at'));

        return Datatables::of($mealClass)

            ->edit_column('number', '{{ DB::table(\'meal_table\')->where(\'class_id\', \'=\', $id)->count() }}')

            ->add_column('actions', '<a href="{{{ URL::to(\'admin/order/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >查看/更新信息</a>
            ')
            ->edit_column('status', '@if($status == 1)
                        <span class="text-danger">订单已生成, 等待确认</span>
                        @elseif($status == 2)
                        <span class="text-primary">订单已确认, 正在配餐</span>
                        @elseif($status == 3)
                        <span class="text-primary">正在配送中</span>
                        @elseif($status == 4)
                        <span class="text-success">交易已完成</span>
                        @elseif($status == 5)
                        <span class="text-info">交易已取消</span>
                        @endif')

            ->remove_column('id')

            ->make();
    }

    public function postNewOrder()
    {
        echo OrderList::where('status', 1)->count();
    }
} 