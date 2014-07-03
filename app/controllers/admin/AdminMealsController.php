<?php

class AdminMealsController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getIndex()
    {
        // Show the page
        return View::make('admin/meals/index')
            ->with('title', '餐点管理');
    }

    public function getCreate()
    {
        return View::make('admin/meals/create_edit')
            ->with('title', '添加餐点')
            ->with('classes', MealClass::get());
    }

    public function postCreate()
    {
        // Declare the rules for the form validation
        $rules = array(
            'name' => 'required|min:3',
            'name_en' => 'required|min:3',
            'price' => 'required|min:1',
            'class_id' => 'required'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes()) {
            // Create a new blog post
//            $user = Auth::user();
            $mealModel = new MealTable;
            $mealModel->name = Input::get('name');
            $mealModel->name_en = Input::get('name_en');
            $mealModel->price = Input::get('price');
            $mealModel->class_id = Input::get('class_id');

            // Was the blog post created?
            if ($mealModel->save()) {
                // Redirect to the new blog post page
                return Redirect::to('admin/meals/' . $mealModel->id . '/edit')->with('success', "提交成功");
            }

            // Redirect to the blog post create page
            return Redirect::to('admin/meals/create')->with('error', "提交失败");
        }

        // Form validation failed
        return Redirect::to('admin/meals/create')->withInput()->withErrors($validator);
    }

    public function getEdit($meal)
    {
        return View::make('admin/meals/create_edit')
            ->with('title', '编辑餐点')
            ->with('classes', MealClass::get())
            ->with('meal', MealTable::find($meal));
//        return View::make('admin/blogs/create_edit', compact('post', 'title'));
    }

    public function postEdit($meal)
    {

        // Declare the rules for the form validation
        $rules = array(
            'name' => 'required|min:3',
            'name_en' => 'required|min:3',
            'price' => 'required|min:1',
            'class_id' => 'required'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes()) {
            // Update the blog post data
            $mealModel = MealTable::find($meal);
            $mealModel->name = Input::get('name');
            $mealModel->name_en = Input::get('name_en');
            $mealModel->price = Input::get('price');
            $mealModel->class_id = Input::get('class_id');

            if (is_object(Input::file('img'))) {
                $mealModel->img = $this->putMealImg($meal);
            }

            // Was the blog post updated?
            if ($mealModel->save()) {
                // Redirect to the new blog post page
                return Redirect::to('admin/meals/' . $mealModel->id . '/edit')->with('success', "提交成功");
            }

            // Redirect to the blogs post management page
            return Redirect::to('admin/meals/' . $mealModel->id . '/edit')->with('error', "提交失败");
        }

        // Form validation failed
        return Redirect::to('admin/meals/' . $meal . '/edit')->withInput()->withErrors($validator);
    }

    public function toggleStatus($meal)
    {
        $meal = MealTable::find($meal);;
        if ($meal->status == 2) {
            $meal->status = 1;
        } else {
            $meal->status = 2;
        }
        if ($meal->save()) {
            die('<script>alert("切换成功");parent.jQuery.colorbox.close();parent.oTable.fnReloadAjax();</script>');
        } else {
            die('<script>alert("切换失败, 可能数据重复提交");parent.jQuery.colorbox.close();parent.oTable.fnReloadAjax();</script>');
        }
    }

    public function toggleAllStatus($status)
    {
        $meals = DB::table('meal_table')->update(array('status' => $status));

        if ($meals >= 0) {
            die('<script>alert("切换成功");parent.jQuery.colorbox.close();parent.oTable.fnReloadAjax();</script>');
        } else {
            die('<script>alert("切换失败, 可能数据重复提交");parent.jQuery.colorbox.close();parent.oTable.fnReloadAjax();</script>');
        }
    }

    public function putMealImg($meal)
    {
        // 获取所有表单数据
        $data = Input::all();
        // 创建验证规则
        $rules = array(
            'img' => 'required|mimes:jpeg,gif,png,bmp,jpg',
        );
        // 自定义验证消息
        $messages = array(
            'img.required' => '请选择需要上传的图片。',
            'img.mimes' => '请上传 :values 格式的图片。',
        );
        // 开始验证
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {
            // 验证成功
            $image = Input::file('img');
            $ext = $image->guessClientExtension(); // 根据 mime 类型取得真实拓展名
            $fullname = $image->getClientOriginalName(); // 客户端文件名，包括客户端拓展名
            $hashname = md5($meal) . '.' . $ext; // 哈希处理过的文件名，包括真实拓展名
            // 图片信息入库
            $meal = MealTable::find($meal);
//            $oldImage = $meal->img;
            $meal->img = $hashname;
            $meal->save();
            // 存储不同尺寸的图片
            $img = Image::make($image->getRealPath());
            $img->resize(360, 300)->save(public_path('assets/img/meal-img/' . $hashname));
            // 删除旧头像
            return $hashname;
        } else {
            // 验证失败
            var_dump($data);
            return null;
        }
    }

    public function getData()
    {
        $mealClass =
            MealTable::select(
                array(
                    'meal_table.id',
                    'meal_table.name',
                    'meal_table.price',
                    'meal_table.updated_at',
                    'meal_table.class_id',
                    'meal_table.status'));
        return Datatables::of($mealClass)

            ->edit_column('class', '{{ DB::table(\'meal_class\')->where(\'id\', \'=\', $class_id)->pluck(\'name\') }}')

            ->add_column('actions', '@if($status==2)
                <a href="{{{ URL::to(\'admin/meals/\' . $id . \'/status\' ) }}}" class="btn btn-warning btn-xs iframe" >已关闭</a>
                @else
                <a href="{{{ URL::to(\'admin/meals/\' . $id . \'/status\' ) }}}" class="btn btn-success btn-xs iframe" >已在售</a>
                @endif' .
                '<a href="{{{ URL::to(\'admin/meals/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >编辑</a>
                <a href="{{{ URL::to(\'admin/meals/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">删除</a>
            ')
            ->remove_column('status')->remove_column('class_id')->remove_column('id')

            ->make();
    }
} 