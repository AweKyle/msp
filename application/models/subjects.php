<?php
//header("Content-Type: text/html; Charset = utf-8");
//error_reporting('E_ALL, ~E_NOICE');
require_once 'includes/dbconn.php';
require_once 'scripts/func.php';
require 'teachers.php';

function addSubject() {

    /* Вариант 1
      if($_POST['subj_semester'] === "")
      {
      alert("Не выбран семестр");
      }
      elseif($_POST['subject'] === "")
      {
      alert("Введите предмет");
      }
      elseif($_POST['specializat_id'] === NULL)
      {
      alert("Не выбрана специализация");
      }
      else
      {
      $c = DB::getConn();
      $subj_semester = $_POST['subj_semester'];
      $subj_course = round($subj_semester/2);

      $subject = $_POST['subject'];
      if(sizeof($_POST['specializat_id']) > 1)
      {
      $specializat_id = implode(",", $_POST['specializat_id']);
      }
      else
      {
      $specializat_id = $_POST['specializat_id'][0];
      }
      try
      {
      $add_subject = $c->prepare("INSERT INTO `rating_system`.`subjects`
      (`subject_name`, `course`, `semester`, `specialization_id`)
      VALUES
      (:subj_name, :subj_course, :subj_semester, :subj_specializat)");
      $add_subject->execute(array(":subj_name"=>$subject, ":subj_course"=>$subj_course,
      ":subj_semester"=>$subj_semester, ":subj_specializat"=>$specializat_id));
      }
      catch(PDOException $exc)
      {
      print $exc->getMessage();
      }
     */

    /* Вариант 2
     */

    if (!isset($_POST['lecturers']) OR $_POST['lecturers'] === "") {
        alert("Не выбран преподаватель");
    } elseif (!isset($_POST['lecturers']) OR $_POST['subject'] === "") {
        alert("Введите предмет");
    } else {
        $c = DB::getConn();
        $lecturer = $_POST['lecturers'];
        $subject = $_POST['subject'];
        try {
            $add_subject = $c->prepare("INSERT INTO `rating_system`.`subjects` 
                                        (`subject_name`, `lecturer_id`) 
                                        VALUES 
                                        (:subj_name, :lecturer)");
            $add_subject->execute(array(":subj_name" => $subject, ":lecturer" => $lecturer));
        } catch (PDOException $exc) {
            print $exc->getMessage();
        }
        if ($add_subject) {
            alert("success");
            $c = null;
        } else {
            alert("err");
            $c = null;
        }
    }
}

//addSubject();

function selectSubjects() {
    $lecturers = selectLecturer(true);
    $size = sizeof($lecturers['id']);
    $c = DB::getConn();
    $subjects = array();
    $j = 0;
    for ($i = 0; $i < $size; ++$i) {
        $subjects_list = $c->query("SELECT `subject_id`, `subject_name` 
                                        FROM `rating_system`.`subjects` 
                                        WHERE `lecturer_id` = '" . $lecturers['id'][$i] . "'");
        if ($subjects_list->rowCount() > 0) {
            while ($subject = $subjects_list->fetch(PDO::FETCH_ASSOC)) {
                $subjects['id'][$j] = $subject['subject_id'];
                $subjects['name'][$j] = $subject['subject_name'];
                $subjects['lecturer'][$j] = $lecturers['lecturer_name'][$i];
                $j++;
            }
        }
    }
    return $subjects;
}

function subjectEdt() {
    $c = DB::getConn();
    if (!isset($_POST['subject_id']) OR $_POST['subject_id'] === '') {
        alert('Вы должны выбрать предмет, который хотите изменить');
    } elseif ((!isset($_POST['subject_name']) && !isset($_POST['lecturer_id'])) OR ($_POST['subject_name'] === '' && $_POST['lecturer_id'] === '')) {
        alert('Выход без изменений');
    }
    $subject_id = $_POST['subject_id'];
    if ($_POST['subject_name'] !== '') {
        $subject_name = $_POST['subject_name'];
        $edit = $c->prepare("UPDATE `rating_system`.`subjects` 
                                SET `subject_name` = :subject_name 
                                WHERE `subject_id` = :subject_id");
        $edit->execute(array(":subject_name"=>$subject_name, ":subject_id"=>$subject_id));
    }
    if ($_POST['lecturer_id'] !== '') {
        $lecturer_id = $_POST['lecturer_id'];
        $edit = $c->prepare("UPDATE `rating_system`.`subjects` 
                                SET `lecturer_id` = :lecturer_id 
                                WHERE `subject_id` = :subject_id");
        $edit->execute(array(":lecturer_id"=>$lecturer_id, ":subject_id"=>$subject_id));
    }
    $c = NULL;
    if (isset($edit) && $edit === TRUE) {
        alert('success');
    } else {
        alert('err');
    }
}

function subjectDelete()
{
    if (!isset($_POST['subject_id']) OR $_POST['subject_id'] === '') {
        alert('Вы должны выбрать предмет, который хотите удалить');
    } else {
        $c = DB::getConn();
        $subject_id = $_POST['subject_id'];
        $delete = $c->prepare("DELETE FROM `rating_system`.`subjects` 
                                WHERE `subject_id` = :subject_id");
        $delete->execute(array(":subject_id"=>$subject_id));
    }
    if ($delete) {
        alert('success');
    } else {
        alert('err');
    }
}
?>