<?php

class BaseController extends Controller
{

    /**
     * Initializer.
     *
     * @access   public
     * @return \BaseController
     */
    public function __construct()
    {
//        $this->beforeFilter('csrf', array('on' => 'post'));
    }

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

    protected function transformStatus($status)
    {
        switch ($status) {
            case 1:
                return '订单已生成, 等待确认';
            case 2:
                return '订单已确认, 正在配餐';
            case 3:
                return '正在配送中';
            case 4:
                return '交易已完成';
            case 5:
                return '交易已取消';
        }
    }

}