<?php

/**
 * Операции со структурой факультета. Добавление/удаление специальности, кафедры и специализации.
 * Выборка из базы данных `rating_system`. Таблицы `speciality`, `department`, `specialization`.
 * На данный момент необходимо реализовать удаление и редактирование записей.
 * @author Nikolay Voronin <kyle.voronin@gmail.com>
 */
//header("Content-Type: text/html; Charset = utf-8");
error_reporting('E_ALL, ~E_NOICE');
require_once 'includes/dbconn.php';
require_once 'scripts/func.php';

/**
 * Класс, объединяющий в себе все действия, связанные со специальностью
 */
class Speciality {

    /**
     * @var string speciality name
     */
    //private $speciality = '';

    /**
     * @var int speciality identificator
     */
    //private $speciality_id = '';

    /**
     * @param string $speciality Название специальности
     * @param int $speciality_id ID специальности
     * @param string $action Принимает значения edt или del. Определяет действия над специальностью
     */
    function __construct($speciality_id = null, $action = null) {
        //$this->speciality = $speciality;

        if (null !== $speciality_id && null !== $action) {
            $this->speciality_id = $speciality_id;
            if ($action === 'edt') {
                $this->specialityEdt($speciality_id);
                if ($this->specialityEdt($speciality_id) === true) {
                    alert('success');
                } else {
                    alert('err');
                }
            } elseif ($action === 'del') {
                $this->specialityDel($speciality_id);
                if ($this->specialityDel($speciality_id) === true) {
                    alert('success');
                } else {
                    alert('err');
                }
            }
        }
    }

    /**
     * Функция добавления специальности
     * @var string $spec название специальности. Получаем из view/add_speciality.php 
     */
    public function addSpeciality() {
        if (trim($_POST['speciality']) !== '' && null !== isset($_POST['speciality'])) {
            $c = DB::getConn();
            $spec = $_POST['speciality'];
            try {
                $add_speciality = $c->prepare("INSERT INTO `rating_system`.`speciality` (`speciality_name`)
											   VALUES (:speciality)");
                $add_speciality->execute(array(":speciality" => $spec));
            } catch (PDOException $exc) {
                print $exc->getMessage();
            }

            if ($add_speciality) {
                return alert("success");
                $c = null;
            } else {
                alert("err");
                $c = null;
            }
        } else {
            alert("Не задана специальность");
        }
    }

    /**
     * Функция выборки из таблицы `speciality`
     * @return bool
     */
    public function selSpeciality() {
        $c = DB::getConn();
        try {
            $sel_spec = $c->query("SELECT * FROM `rating_system`.`speciality`");
        } catch (PDOException $exc) {
            print $exc->getMessage();
        }

        if ($sel_spec->rowCount() > 0) {
            while ($special = $sel_spec->fetch(PDO::FETCH_ASSOC)) {
                $speciality_id = $special['speciality_id'];
                $speciality_name = $special['speciality_name'];
                print '<option value=' . $speciality_id . '>' . $speciality_name . '</option>';
            }
            /*
              $speciality = array();
              $i = 0;
              while ($special = $sel_spec->fetch(PDO::FETCH_ASSOC))
              {
              $speciality['id'][$i] = $special['speciality_id'];
              $speciality['speciality_name'][$i] = $special['speciality_name'];
              $i++;
              }
              return $speciality;
             */
            return true;
            $c = null;
        } else {
            return null;
        }
    }

    /**
     * Функция редактирования специальности
     * @param int $speciality_id ID специальности
     * @return bool
     */
    private function specialityEdt($speciality_id) {
        if (isset($_POST['speciality_name']) && null !== $_POST['speciality_name']) {
            $c = DB::getConn();
            $speciality_name = $_POST['speciality_name'];
            $edit = $c->prepare("UPDATE `rating_system`.`speciality` SET `speciality_name` = :speciality_name
									WHERE `speciality_id` = :speciality_id");
            $edit->execute(array("speciality_name" => $speciality_name, "speciality_id" => $speciality_id));
            if ($edit === true) {
                return true;
                $c = null;
            } else {
                return false;
                $c = null;
            }
        } else {
            return false;
        }
    }

    /**
     * Функция удаления специальности
     * @param int $speciality_id ID специальности
     * @return bool
     */
    private function specialityDel($speciality_id) {
        $c = DB::getConn();
        $delete = $c->exec("DELETE FROM `rating_system`.`speciality`
							WHERE `speciality_id` = '$speciality_id'");
        if ($delete) {
            return true;
            $c = null;
        } else {
            return false;
            $c = null;
        }
    }

}

/**
 * Класс, объединяющий в себе все действия, связанные с кафедрой
 */
class Department {

    /**
     * @param string $department Название кафедры
     * @param int $department_id ID кафедры
     * @param string $action Принимает значения edt или del. Определяет действия над кафедрой
     */
    function __construct($department_id = null, $action = null) {
        //$this->department = $department;

        if (null !== $department_id && null !== $action) {
            $this->department_id = $department_id;
            if ($action === 'edt') {
                $this->departmentEdt($department_id);
                if ($this->departmentEdt($department_id) == true) {
                    echo $this->departmentEdt($department_id);
                    var_dump($this->departmentEdt($department_id));
                    //alert('success');
                } else {
                    echo $this->departmentEdt($department_id);
                    var_dump($this->departmentEdt($department_id));
                    //alert('err');
                }
            } elseif ($action === 'del') {
                $this->departmentDel($department_id);
                if ($this->departmentDel($department_id) == true) {
                    alert('success');
                } else {
                    alert('err');
                }
            }
        }
    }

    /**
     * Функция добавления кафедры
     * @var string $department : название кафедры. Получаем из view/add_department.php
     * @var integer $speciality_id : id специальности
     */
    public function addDepartment() {
        if (null == $_POST['department'] && null !== isset($_POST['department'])) {
            alert("Не задана кафедра");
        } elseif ($_POST['speciality_id'] == null && null !== isset($_POST['speciality_id'])) {
            alert("Не задана специальность");
        } else {
            $c = DB::getConn();
            $department = $_POST['department'];
            $speciality_id = $_POST['speciality_id'];
            try {
                $add_department = $c->prepare("INSERT INTO `rating_system`.`department` (`speciality_id`, `department_name`) 
						VALUES (:special_id, :dept_name)");
                $add_department->execute(array(":special_id" => $speciality_id, ":dept_name" => $department));
            } catch (PDOException $exc) {
                print $exc->getMessage();
            }

            if ($add_department) {
                return alert("success");
                $c = null;
            } else {
                return alert("err");
                $c = null;
            }
        }
    }

    /**
     * Функция выборки из таблицы `department`
     */
    public function selDepartment() {
        $c = DB::getConn();
        try {
            $sel_spec = $c->query("SELECT * FROM `rating_system`.`speciality`");
        } catch (PDOException $exc) {
            print $exc->getMessage();
        }
        if ($sel_spec->rowCount() > 0) {
            while ($special = $sel_spec->fetch(PDO::FETCH_ASSOC)) {
                $speciality_id = $special['speciality_id'];
                $speciality_name = str_replace(' ', '&nbsp;', $special['speciality_name']);
                try {
                    $sel_dept = $c->prepare("SELECT * FROM `rating_system`.`department` 
						WHERE `speciality_id` = :speciality_id");
                    $sel_dept->execute(array(":speciality_id" => $speciality_id));
                } catch (PDOException $exc) {
                    print $exc->getMessage();
                }
                if ($sel_dept->rowCount() > 0) {
                    print '<optgroup label = ' . $speciality_name . '>';
                    while ($res_department = $sel_dept->fetch(PDO::FETCH_ASSOC)) {
                        $dept_id = $res_department['department_id'];
                        $dept_name = $res_department['department_name'];
                        print '<option value=' . $dept_id . '>' . $dept_name . '</option>';
                    }
                    print '</optgroup>';
                }
            }
            $c = null;
        }
    }

    /**
     * Редактирование кафедры
     * @param int $department_id ID кафедры
     */
    private function departmentEdt($department_id) {
        $c = DB::getConn();
        if (isset($_POST['department_name']) && $_POST['department_name'] != '') {
            $department_name = $_POST['department_name'];
            $edit = $c->prepare("UPDATE `rating_system`.`department` SET `department_name` = :department_name
									WHERE `department_id` = :department_id");
            $edit->execute(array("department_name" => $department_name, "department_id" => $department_id));
        }
        if (isset($_POST['speciality_id']) && $_POST['speciality_id'] !== '') {
            $speciality_id = $_POST['speciality_id'];
            $edit = $c->prepare("UPDATE `rating_system`.`department` SET `speciality_id` = :speciality_id
									WHERE `department_id` = :department_id");
            $edit->execute(array("department_id" => $department_id, "speciality_id" => $speciality_id));
        }
        if (isset($edit) && $edit === true) {
            return 'true';
            $c = null;
        } elseif ($edit === false) {
            return 'false';
            $c = null;
        }
    }

    /**
     * Удаление кафедры
     * @param int $department_id ID кафедры
     */
    private function departmentDel($department_id) {
        $c = DB::getConn();
        $delete = $c->exec("DELETE FROM `rating_system`.`department`
							WHERE `department_id` = '$department_id'");
        if ($delete) {
            return true;
            $c = null;
        } else {
            return false;
            $c = null;
        }
    }

}

/**
 * Класс, объединяющий в себе все действия, связанные со специализацией
 */
class Specialization {

    private $specialization_id = '';

    /**
     * @param string $department Название специализации
     * @param int $department_id ID специализации
     * @param string $action Принимает значения edt или del. Определяет действия над специализацией
     */
    function __construct($specialization_id = null, $action = null) {
        if (null !== $specialization_id && null !== $action) {
            $this->specialization_id = $specialization_id;
            if ($action === 'edt') {
                $this->specializationEdt($specialization_id);
                if ($this->specializationEdt($specialization_id) === true) {
                    alert('success');
                } else {
                    alert('err');
                }
            } elseif ($action === 'del') {
                $this->specializationDel($specialization_id);
                if ($this->specializationDel($specialization_id) === true) {
                    alert('success');
                } else {
                    alert('err');
                }
            }
        }
    }

    /**
     * Функция добавления специализации
     * @var string $specializat_name : название специализации. Получаем из view/add_specialization.php
     * @var int $department_id : id специализации
     */
    public function addSpecialization() {
        switch (null) {
            case ($_POST['specialization']):
                alert("Не задана специализация");
                break;

            case ($_POST['department_id']):
                alert("Не задана кафедра");
                break;
            default :
                $c = DB::getConn();
                $department_id = $_POST['department_id'];
                $specializat_name = $_POST['specialization'];
                try {
                    $add_specializat = $c->prepare("INSERT INTO `rating_system`.`specialization` (`department_id`, `specialization_name`) 
													VALUES (:dept_id, :spec_name)");
                    $add_specializat->execute(array(":dept_id" => $department_id, ":spec_name" => $specializat_name));
                } catch (PDOException $exc) {
                    print $exc->getMessage();
                }

                if ($add_specializat) {
                    return alert("success");
                    $c = null;
                } else {
                    return alert("err");
                    $c = null;
                }
                break;
        }
    }

    /**
     * Функция выборки из таблицы `specialization`
     */
    public function selSpecialization() {
        $c = DB::getConn();
        try {
            $sel_department = $c->query("SELECT * FROM `rating_system`.`department`");
        } catch (PDOException $exc) {
            print $exc->getMessage();
        }

        if ($sel_department->rowCount() > 0) {
            while ($depart = $sel_department->fetch(PDO::FETCH_ASSOC)) {
                $department_id = $depart['department_id'];
                $department_name = str_replace(' ', '&nbsp', $depart['department_name']);
                try {
                    $sel_specz = $c->prepare("SELECT * FROM `rating_system`.`specialization` 
						WHERE `department_id` = :department_id");
                    $sel_specz->execute(array("department_id"=>$department_id));
                } catch (PDOException $exc) {
                    print $exc->getMessage();
                }

                if ($sel_specz->rowCount() > 0) {
                    print "<optgroup label = " . $department_name . ">";
                    while ($res_specz = $sel_specz->fetch(PDO::FETCH_ASSOC)) {
                        $specz_id = $res_specz['specialization_id'];
                        $specz_name = $res_specz['specialization_name'];
                        print "<option value=" . $specz_id . ">" . $specz_name . "</option>";
                    }
                    print "</optgroup>";
                }
            }
            $c = null;
        }
    }

    /**
     * Редактирование специализации
     * @param int $specialization_id ID специализации
     */
    private function specializationEdt($specialization_id) {
        $c = DB::getConn();
        if (isset($_POST['specialization_name']) && null !== $_POST['specialization_name']) {
            $specialization_name = $_POST['specialization_name'];
            $edit = $c->prepare("UPDATE `rating_system`.`specialization` SET `specialization_name` = :specialization_name
									WHERE `specialization_id` = :specialization_id");
            $edit->execute(array("specialization_name" => $specialization_name, "specialization_id" => $specialization_id));
        }
        if (isset($_POST['department_id'])) {
            $department_id = $_POST['department_id'];
            $edit = $c->prepare("UPDATE `rating_system`.`specialization` SET `department_id` = :department_id
									WHERE `specialization_id` = :specialization_id");
            $edit->execute(array("department_id" => $department_id, "specialization_id" => $specialization_id));
        }
        if (isset($edit) && $edit === true) {
            return true;
            $c = null;
        } elseif ($edit === false) {
            return false;
            $c = null;
        }
    }

    /**
     * Удаление специализации
     * @param int $specialization_id ID специализации
     */
    private function specializationDel($specialization_id) {
        $c = DB::getConn();
        $delete = $c->exec("DELETE FROM `rating_system`.`specialization`
							WHERE `specialization_id` = '$specialization_id'");
        if ($delete) {
            return true;
            $c = null;
        } else {
            return false;
            $c = null;
        }
    }

}

/**
 * Вызов функций добавления
 */
switch (TRUE) {
    case (isset($_POST['speciality'])):
        $speciality = new Speciality();
        $speciality->addSpeciality();
        break;

    case (isset($_POST['department'])):
        $department = new Department();
        $department->addDepartment();
        break;
    case (isset($_POST['specialization'])):
        $specialization = new Specialization();
        $specialization->addSpecialization();
        break;
}

if (isset($_POST['department_edt'])) {
    $department = new Department($_POST['department_id'], 'edt');
}
?>