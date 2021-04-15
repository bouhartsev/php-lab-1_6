<?php
    $name = '';
    $group_number = '';
    $about = '';
    $a_value = '';
    $b_value = '';
    $c_value = '';
    $type_of_calc = '';
    $ans_your = '';
    $ans_right = '';
    $email = '';
    $email_check = false;
    $email_result = false;
    $view = '';
    $test_result = '';
    $post_or_get = 'POST';
    $message = '';

    function calcMin($a, $b, $c) {
        $result = 0;
        if ($b<$a && $b<=$c) $result = $b;
        else if ($c<$a && $c<$b) $result = $c;
        else $result = $a;
        return $result;
    }

    function calcPerimeter($a, $b, $c) {
        $result = 0;
        $result = $a + $b + $c;
        return $result;
    }

    function calcSquare($a, $b, $c) {
        $result = 0;
        $p = calcPerimeter($a, $b, $c)/2;
        $result = round(sqrt($p*($p-$a)($p-$b)($p-$c)),2);
        return $result;
    }

    function calcAverage($a, $b, $c) {
        $result = 0;
        $result = calcPerimeter($a, $b, $c)/3;
        return $result;
    }

    function calcMax($a, $b, $c) {
        $result = 0;
        if ($b>$a && $b>=$c) $result = $b;
        else if ($c>$a && $c>$b) $result = $c;
        else $result = $a;
        return $result;
    }

    function calcProduct($a, $b, $c) {
        $result = 0;
        $result = $a*$b*$c;
        return $result;
    }

    function calc($type) {
        global $a_value, $b_value, $c_value;

        $result = 0;

        switch($type) {
            case 'Найти минимум':
                $result = calcMin($a_value, $b_value, $c_value);
                break;
            case 'Площадь треугольника':
                $result = calcSquare($a_value, $b_value, $c_value);
                break;
            case 'Периметр треугольника':
                $result = calcPerimeter($a_value, $b_value, $c_value);
                break;
            case 'Среднее арифметическое':
                $result = calcAverage($a_value, $b_value, $c_value);
                break;
            case 'Найти максимум':
                $result = calcMax($a_value, $b_value, $c_value);
                break;
            case 'Произведение чисел':
                $result = calcProduct($a_value, $b_value, $c_value);
                break;
        }

        return $result;
    }

    function checkSet() {
        global $name, 
        $group_number, 
        $about, 
        $a_value, 
        $b_value, 
        $c_value, 
        $type_of_calc, 
        $ans_your, 
        $ans_right, 
        $email, 
        $email_check, 
        $view, 
        $test_result,
        $post_or_get,
        $message;

        if (isset($_POST['fullname'])) {
            $name = $_POST['fullname'];
            $group_number = $_POST['number'];
            $about = $_POST['about'];
            $a_value = $_POST['A'];
            $b_value = $_POST['B'];
            $c_value = $_POST['C'];
            $type_of_calc = $_POST['type_of_calc'];
            $ans_your = $_POST['answer_your'];
            $ans_right = calc($type_of_calc);
            $email_check = $_POST['checkemail'];
            $email = $_POST['email'];
            $view = $_POST['view'];

            $post_or_get = 'GET';

            if ($ans_your==$ans_right) $test_result = 'Тест пройден';
            else $test_result = 'Тест не пройден';

            $message = '<div class="wrapper">'
                .'ФИО: '.$name.'<br>'
                .'Номер группы: '.$group_number.'<br>'
                .'Немного о себе: '.$about.'<br>'
                .'Значение А: '.$a_value.'<br>'
                .'Значение B: '.$b_value.'<br>'
                .'Значение C: '.$c_value.'<br>'
                .'Метод вычисления: '.$type_of_calc.'<br>'
                .'Ваш ответ: '.$ans_your.'<br>'
                .'Правильный ответ: '.$ans_right.'<br>'
                .'Результат: '.$test_result.'<br>';
            if ($email!='') $message .= 'Результат отправлен на почту '.$email.'<br>';
            $message .= '</div>';
        }
        else {
            if (isset($_GET['fullname'])) $name = $_GET['fullname'];
            if (isset($_GET['number'])) $group_number = $_GET['number'];
            if (isset($_GET['checkemail'])) $email_check = $_GET['checkemail'];
            if (isset($_GET['email'])) $email = $_GET['email'];
            if (isset($_GET['view'])) $view = $_GET['view'];
            $a_value = rand(0, 100);
            $b_value = rand(0, 100);
            $c_value = rand(0, 100);

            $post_or_get = 'POST';
        }
    }

    function send_mail() {
        global $message, $email;
        include 'send.php';
    }

    checkSet();
    if ($email_check==true && $email!='' && $post_or_get=='GET') send_mail();
    include 'home.html';
?>