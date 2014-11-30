<?php
//header("Content-Type:text/html; Charset=utf-8");
require_once 'includes/dbconn.php';
require_once 'scripts/func.php';

function get_from_url($url) {
    /*    $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $buffer = curl_exec($ch);
      curl_close($ch);
      preg_match_all("/<a href=\"\w+:\w+\(\d+\)\" >(.*)<\/a>/isU",$buffer,$match);
      return $match[1];
     */
    /* Заплатка(Резервный вариант)
     * В случае если в университете не будет работать cURL, список преподавателей получаем при помощи file_get_contents
     */
    /*     * **
     *
     * ** */
    if (false !== ($list = file_get_contents($url))) {
        preg_match_all("/<a href=\"\w+:\w+\(\d+\)\" >(.*)<\/a>/isU", $list, $match);
        return $match[1];
    }
}

function add_teachers($bool = false) {
    if ($bool == true) {
        $c = DB::getConn();
        if (!isset($_POST['t_surname'])) {
            $lecturers = selectLecturer(true);
            $iterat = 0;
            foreach (get_from_url('http://www.vsu.ru/persons/?dep=8000000000018746') as $lecturer) {
                if (empty($lecturers) OR !in_array($lecturer, $lecturers['lecturer_name']))
                {
                    $iterat++;
                    $add = $c->prepare("INSERT INTO `rating_system`.`lecturers` 
					       				(`lecturer`)
							     		VALUES (:teacher)");
                    $add->execute(array(":teacher" => $lecturer));
                    echo $lecturer . " добавлен<br />";
                }
            }
            if ($iterat !== 0) {
                echo "Преподаватели добавлены";
            } else {
                echo "Новых преподавателей нет";
            }
            $c = null;
        } else {
            $teacher = $_POST['t_surname'] . " " . $_POST['t_name'] . " " . $_POST['t_patr'];
            $add = $c->prepare("INSERT INTO `rating_system`.`lecturers` 
								(`lecturer`)
								VALUES (:teacher)");
            $add->execute(array(":teacher" => $teacher));
            if ($add) {
                alert("success");
            } else {
                alert("err");
            }
            $c = null;
        }
    }
}

//add_teachers(true);

function selectLecturer($show = false) {
    if ($show !== false) {
        $c = DB::getConn();
        $select = $c->query("SELECT * FROM `rating_system`.`lecturers`");
        if ($select->rowCount() > 0) {
            $teacher = array();
            $i = 0;
            while ($res = $select->fetch(PDO::FETCH_ASSOC)) {
                $teacher['id'][$i] = $res['lecturer_id'];
                $teacher['lecturer_name'][$i] = $res['lecturer'];
                $i++;
            }
        }
        return $teacher;
    }
}

function lecturerEdt() {
    if (!isset($_POST['lecturer_id']) OR $_POST['lecturer_id'] === '') {
        alert('Не выбран преподаватель');
    } elseif (!isset($_POST['lecturer']) OR $_POST['lecturer'] === '') {
        alert('Выход без изменений');
    } else {
        $c = DB::getConn();
        $lecturer_id = $_POST['lecturer_id'];
        $lecturer = $_POST['lecturer'];
        $edit = $c->prepare("UPDATE `rating_system`.`lecturers` 
                                SET `lecturer` = :lecturer 
                                WHERE `lecturer_id` = :lecturer_id");
        $edit->execute(array(":lecturer" => $lecturer, ":lecturer_id" => $lecturer_id));
        $c = NULL;
        if ($edit) {
            alert('success');
        } else {
            alert('err');
        }
    }
}

function lecturerDelete() {
    if (!isset($_POST['lecturer_id']) OR $_POST['lecturer_id'] === '') {
        alert('Не выбран преподаватель');
    } else {
        $c = DB::getConn();
        $lecturer_id = $_POST['lecturer_id'];
        $delete = $c->prepare("DELETE FROM `rating_system`.`lecturers` 
                                WHERE `lecturer_id` = :lecturer_id");
        $delete->execute(array(":lecturer_id" => $lecturer_id));
        $c = NULL;
        if ($delete) {
            alert('success');
        } else {
            alert('err');
        }
    }
}
?>