<?php

session_start();
/* * ********************
  Добавление студентов.
 * ********************* */
require_once 'includes/dbconn.php';
require_once 'scripts/func.php';

function add_stud() {
    if (isset($_POST['status']) && $_POST['status'] === "true" && file_exists("tmp/students.txt")) {
        $c = DB::getConn();
        $studList = array();
        $variable = file_get_contents("tmp/students.txt");
        $studList = unserialize($variable);
        //print_r($studList);
        //print "<hr>";
        $groupCount = sizeof($studList);
        $course = $studList[0][0];
        for ($i = 1; $i < $groupCount; ++$i) {
            $studCount = sizeof($studList[$i]);
            for ($j = 0; $j < $studCount; ++$j) {
                if (!preg_match("/\d/", $studList[$i][$j])) {
                    $student = $studList[$i][$j];
                } else {
                    $sub_group = $studList[$i][$j];
                    $student = $studList[$i][$j];
                }
                if ($student != "" && $sub_group != "") {
                    $stud_subgrp = $student . "::" . $sub_group;
                }
                preg_match("/(\D+)::(\d)/", $stud_subgrp, $match);
                //print $match[1] . " " . $match[2] . "<br />";
                if ($match[1] !== null && $match[2] !== null) {
                    $addStud = $c->prepare("INSERT INTO `rating_system`.`students` 
                                                                (`student`, `stud_course`, `stud_group`, `stud_subgroup`, `start_year`, `end_year`)
                                                                VALUES (:stud, :course, :group, :sub_group, :s_year, :e_year)");
                    $addStud->execute(array(":stud" => $match[1], ":course" => $course, ":group" => $i, ":sub_group" => $match[2], ":s_year" => $studList[0][1], "e_year" => $studList[0][2]));
                }
            }
        }
        if ($addStud == 1) {
            $c = null;
            unlink("tmp/students.txt");
            return alert("success");
        } else {
            $c = null;
            unlink("tmp/students.txt");
        }
    } elseif (isset($_POST['status']) && !file_exists("tmp/students.txt")) {
        print "Нет файла";
        return alert("success");
    } elseif (isset($_POST['status']) && $_POST['status'] === "false" && file_exists("tmp/students.txt")) {
        unlink("tmp/students.txt");
        return alert("success");
    } elseif (!isset($_POST['status']) && isset($_SESSION['s_count']) && $_SESSION['s_count'] != 0) {
        $c = DB::getConn();
        $stud_count = $_SESSION['s_count'];
        for ($i = 1; $i < $stud_count; ++$i) {
            $student = $_POST['student' . $i];
            /*
              $name = $_POST['st_name' . $i];
              $patr = $_POST['st_patronymic' . $i];
             */
            $spec_id = $_POST['st_speciality' . $i];
            $course = $_SESSION['add_stud_course'];
            $group = $_POST['st_group' . $i];
            $s_group = $_POST['st_subgroup' . $i];
            $s_year = $_SESSION['start_year'];
            $e_year = $_SESSION['end_year'];
            //print $student . " " . $spec_id . " " . $course . " " . $group . "<br />";
            try {
                $add_stud = $c->prepare("INSERT INTO `rating_system`.`students` 
										 (`student`, `stud_course`, `stud_group`, `stud_subgroup`, `start_year`, `end_year`)
										 VALUES 
										 (:student, :course, :group, :sub_group, :s_year, :e_year)");
                $add_stud->execute(array(":student" => $student, ":course" => $course, ":group" => $group, ":sub_group" => $s_group, ":s_year" => $s_year, "e_year" => $e_year));
            } catch (PDOException $exc) {
                print $exc->getMessage();
            }
            unset($_SESSION['s_count'], $group, $course, $spec_id, $student);
        }
        if ($add_stud) {
            $c = null;
            return alert("success");
        } else {
            return alert("err");
        }
    }
}

//add_stud();

function deleteStud($stud_id) {
    if ($stud_id === null && !isset($_POST['confirm_del'])) {
        return true;
    } else {
        $c = DB::getConn();
    }
}

function selectStud() {
    if (isset($_POST['s_course']) && $_POST['s_course'] != "") {
        $c = DB::getConn();
        $course = $_POST['s_course'];
        $selectStud = $c->query("SELECT * FROM `students` WHERE `stud_course` = '$course'");
        require_once 'subjects.php';
        ?>
        Укажите предмет и дату проведения аттестации
        <br />
        <select>
            <?php
            $subj = selectSubjects();
            $size = sizeof($subj['id']);
            for ($i = 0; $i < $size; ++$i)
            {
                ?>
                <option value="<?php echo $subj['id'][$i] ?>">
                <?php echo $subj['name'][$i] ?>
                </option>
                <?php
            }
            ?>
        </select>
        <input type="text" placeholder="Дата проведения аттестации" />
        <br />
        <?php
        echo "<table border =\"1\">";
        while ($stud = $selectStud->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <tr>   
                <td>
            <?php
            //print $stud['student'] . "<br />";
            print $stud['student'];
            ?>
                </td>
                <td>
                    <input type="text" value="" placeholder="mark" style="width: 40px;" />
                </td>
            </tr>
            <?php
        }
        echo "</table>";
    } elseif (isset($_POST['s_stud']) && $_POST['s_stud'] != "") {
        $c = DB::getConn();
        $stud_surname = $_POST['s_stud'];
        //print $stud_surname;
        $selectStud = $c->query("SELECT * FROM `students` WHERE `student` LIKE '$stud_surname%\ %'");
        while ($stud = $selectStud->fetch(PDO::FETCH_ASSOC)) {
            print $stud['student'] . ' ' . $stud['stud_course'] . ' курс ' . $stud['stud_group'] . ' группа ' . $stud['stud_subgroup'] . ' подгруппа' . '<br />';
        }
    }
}

selectStud();
?>