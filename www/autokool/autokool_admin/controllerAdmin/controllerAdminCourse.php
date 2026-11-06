<?php
class controllerAdminCourse
{
    //list Courses
    public static function courseList()
    {
        $arr = modelAdminCourse::getCourseList();
        include_once __DIR__ . '/../viewAdmin/courseList.php';
    }

    public static function courseAddForm()
    {
        include_once __DIR__ . '/../viewAdmin/courseAddForm.php';
    }

    public static function courseAddResult()
    {
        csrf_check();
        $test = modelAdminCourse::getCourseAdd();
        include_once __DIR__ . '/../viewAdmin/courseAddForm.php';
    }

    public static function courseEditForm($id)
    {
        $detail = modelAdminCourse::getCourseDetail($id);
        if (!$detail) {
            controllerAdmin::error404();
            return;
        }
        include_once __DIR__ . '/../viewAdmin/courseEditForm.php';
    }

    public static function courseEditResult($id)
    {
        csrf_check();
        $test = modelAdminCourse::getCourseEdit($id);
        include_once __DIR__ . '/../viewAdmin/courseEditForm.php';
    }

    public static function courseDeleteForm($id)
    {
        $detail = modelAdminCourse::getCourseDetail($id);
        if (!$detail) {
            controllerAdmin::error404();
            return;
        }
        include_once __DIR__ . '/../viewAdmin/courseDeleteForm.php';
    }

    public static function courseDeleteResult($id)
    {
        csrf_check();
        $test = modelAdminCourse::getCourseDelete($id);
        include_once __DIR__ . '/../viewAdmin/courseDeleteForm.php';
    }

}//class
