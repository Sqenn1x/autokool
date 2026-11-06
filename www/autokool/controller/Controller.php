<?php
class Controller
{
    public static function StartSite()
    {
        $courses = array_slice(Course::getAllCourses(), 0, 3);
        $instructors = array_slice(Instructor::getAllInstructors(), 0, 3);
        render('home', ['title' => 'Avaleht', 'courses' => $courses, 'instructors' => $instructors]);
    }

    public static function AllCourses()
    {
        $current = $_GET['category'] ?? null;
        $courses = Course::getAllCourses($current ?: null);
        $categories = Course::getCategories();
        render('courses', ['title' => 'Kursused', 'courses' => $courses, 'categories' => $categories, 'current' => $current]);
    }

    public static function CourseByID($id)
    {
        $course = Course::getCourseByID($id);
        if (!$course || !$course['active']) {
            self::error404();
            return;
        }
        render('course', ['title' => $course['title'], 'course' => $course]);
    }

    public static function AllInstructors()
    {
        $instructors = Instructor::getAllInstructors();
        render('instructors', ['title' => 'Instruktorid', 'instructors' => $instructors]);
    }

    public static function Contact()
    {
        render('contact', ['title' => 'Kontakt']);
    }

    public static function error404()
    {
        http_response_code(404);
        render('404', ['title' => 'Ei leitud']);
    }

    // ------------------------- REGISTREERUMINE KURSUSELE
    public static function bookingForm()
    {
        $old = ['course_id' => (int)($_GET['course'] ?? 0), 'name' => '', 'email' => '', 'phone' => '', 'message' => ''];
        $courses = Course::getAllCourses();
        $errors = [];
        render('booking', ['title' => 'Registreeru kursusele', 'courses' => $courses, 'old' => $old, 'errors' => $errors]);
    }

    public static function bookingAnswer()
    {
        csrf_check();
        $old = [
            'course_id' => (int)($_POST['course_id'] ?? 0),
            'name' => trim($_POST['name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'phone' => trim($_POST['phone'] ?? ''),
            'message' => trim($_POST['message'] ?? ''),
        ];
        $errors = Booking::validate($old);
        if (!$errors && !Booking::bookingCreate($old)) {
            $errors[] = 'Registreerumine ebaõnnestus, proovi hiljem uuesti.';
        }
        if ($errors) {
            $courses = Course::getAllCourses();
            render('booking', ['title' => 'Registreeru kursusele', 'courses' => $courses, 'old' => $old, 'errors' => $errors]);
            return;
        }
        render('thanks', ['title' => 'Aitäh!']);
    }
}
