<?php

class AdminClassesController extends AdminController
{
    public function __construct(Post $post)
    {
        parent::__construct();
    }

    public function getIndex()
    {
        // Show the page
        return View::make('admin/classes/index')
            ->with('title', '分类管理');
    }

    public function getCreate()
    {
        return View::make('admin/classes/create_edit')
            ->with('title', '添加分类');
    }

    public function postCreate()
    {
        // Declare the rules for the form validation
        $rules = array(
            'name' => 'required|min:2',
            'name_en' => 'required|min:3|max:32'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes()) {
            // Create a new blog post
            $user = Auth::user();

            // Update the blog post data
            // Update the blog post data
            $classModel = new MealClass;
            $classModel->name = Input::get('name');
            $classModel->name_en = Input::get('name_en');

            // Was the blog post created?
            if ($classModel->save()) {
                // Redirect to the new blog post page
                return Redirect::to('admin/classes/' . $classModel->id . '/edit')->with('success', "提交成功");
            }

            // Redirect to the blog post create page
            return Redirect::to('admin/classes/create')->with('error', "提交失败");
        }

        // Form validation failed
        return Redirect::to('admin/classes/create')->withInput()->withErrors($validator);
    }

    public function getEdit($class)
    {
        return View::make('admin/classes/create_edit')
            ->with('title', '编辑分类')
            ->with('class', MealClass::find($class));
//        return View::make('admin/blogs/create_edit', compact('post', 'title'));
    }

    public function postEdit($class)
    {

        // Declare the rules for the form validation
        $rules = array(
            'name' => 'required|min:2',
            'name_en' => 'required|min:3|max:32'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes()) {

            // Update the blog post data
            $classModel = MealClass::find($class);
            $classModel->name = Input::get('name');
            $classModel->name_en = Input::get('name_en');
            if ($_FILES['background']['error'] == 0) {
                $classModel->background = $this->putClassBackground();
            }

            // Was the blog post updated?
            if ($classModel->save()) {
                // Redirect to the new blog post page
                return Redirect::to('admin/classes/' . $classModel->id . '/edit')->with('success', "提交成功");
            }

            // Redirect to the blogs post management page
            return Redirect::to('admin/classes/' . $classModel->id . '/edit')->with('error', "提交失败");
        }

        // Form validation failed
        return Redirect::to('admin/classes/' . $class . '/edit')->withInput()->withErrors($validator);
    }

    public function putClassBackground()
    {
        $temp = explode('.', $_FILES['background']['name']);
        $new_name = Input::get('name_en') . '.' . end($temp);
        $new_path = './assets/img/class-background/' . $new_name;
        move_uploaded_file($_FILES['background']['tmp_name'], $new_path);
        return $new_name;
    }

    public function getData()
    {
        $mealClass = MealClass::select(array('meal_class.id', 'meal_class.name', 'meal_class.updated_at'));

        return Datatables::of($mealClass)

            ->edit_column('number', '{{ DB::table(\'meal_table\')->where(\'class_id\', \'=\', $id)->count() }}')

            ->add_column('actions', '<a href="{{{ URL::to(\'admin/classes/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >编辑</a>
                <a href="{{{ URL::to(\'admin/classes/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">删除</a>
            ')

            ->remove_column('id')

            ->make();
    }
} 