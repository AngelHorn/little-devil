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
            'price' => 'required|min:1',
            'class_id' => 'required'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes()) {
            // Create a new blog post
//            $user = Auth::user();
            $mealModel =new MealTable;
            $mealModel->name = Input::get('name');
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
        return View::make('admin/blogs/create_edit', compact('post', 'title'));
    }

    public function postEdit($meal)
    {

        // Declare the rules for the form validation
        $rules = array(
            'name' => 'required|min:3',
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
            $mealModel->price = Input::get('price');
            $mealModel->class_id = Input::get('class_id');

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

    public function getData()
    {
        $mealClass = MealTable::select(array('meal_table.name', 'meal_table.price', 'meal_table.updated_at', 'meal_table.id', 'meal_table.class_id'));

        return Datatables::of($mealClass)

            ->edit_column('class', '{{ DB::table(\'meal_class\')->where(\'id\', \'=\', $class_id)->pluck(\'name\') }}')

            ->remove_column('class_id')->remove_column('id')

            ->add_column('actions', '<a href="{{{ URL::to(\'admin/meals/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >编辑</a>
                <a href="{{{ URL::to(\'admin/meals/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">删除</a>
            ')


            ->make();
    }
} 