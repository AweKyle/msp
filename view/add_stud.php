<?php
session_start();
?>
<!--
Варианты добавления студентов
-->
<form method="POST" action="" id="adding_type_form">
	<label onclick="AjaxFormRequest('result_div_id', 'adding_type_form', 'view/add_stud.php', 'POST')">
		<input type="radio" name="adding_type" value="manual" />
		Добавить студентов вручную
	</label>
	<label onclick="AjaxFormRequest('result_div_id', 'adding_type_form', 'view/add_stud.php', 'POST')">
		<input type="radio" name="adding_type" value="upl_file" />
		Загрузить список студентов из файла
	</label>
	<br />
</form>
<?php
if(isset($_POST['adding_type']) && $_POST['adding_type'] == "upl_file")
{
$year = date('Y');
$nextYear = date('Y')+1;
?>
	<form method="POST" action="read.php" enctype="multipart/form-data"> 
	<!--  <form method="POST" action="0.php" enctype="multipart/form-data">  -->
		<p>Укажите для какого учебного года будут добавлены студенты</p>
		<p>
			<input type="text" id="c_year" name="start_year" placeholder="<?php echo $year ?>" /> 
			<input type="text" id="c_year" name="end_year" placeholder="<?php echo $nextYear ?>" />
		</p>
		<input type = "file" name = "somename" />
		<input type = "submit" value = "Загрузить" />
	</form>
<?php
}
elseif(isset($_POST['adding_type']) && $_POST['adding_type'] == "manual")
{
	$year = date('Y');
	$nextYear = date('Y')+1;
?>
	<form method="POST" action="" id="students_count_form">
		<table>
			<th>Число студентов</th>
			<th>Курс:</th>
			<th>Академический год:</th>
			<tr>
				<td>
					<input type="text" id="stud_count" name="s_count" placeholder="Число студентов" />
				</td>
				<td>
					<select name="course" class="course">
						<option disabled>Выберите курс</option>
						<option selected value=""></option>
						<option value="1">Первый</option>
						<option value="2">Второй</option>
						<option value="3">Третий</option>
						<option value="4">Четвертый</option>
						<option value="5">Пятый</option>
				<!--	
						<optgroup label="Магистратура">
						<option value="1">Первый</option>
						<option value="2">Второй</option>
						</optgroup>
				-->
					</select>
				</td>
				<td align="center">
					<input type="text" id="c_year" name="start_year" placeholder="<?php echo $year ?>" /> 
					<input type="text" id="c_year" name="end_year" placeholder="<?php echo $nextYear ?>" />
				</td>
			</tr>
			<th colspan="3">
				<input type="button" onclick="AjaxFormRequest('result_div_id', 'students_count_form', 'view/add_stud.php', 'POST')" class="sbmt" value="Send" />	
			</th>
		</table>
	</form>
<?php
}
if(isset($_POST['course']) && $_POST['course'] == "")
{
	print "Вы должны указать курс и число добавляемых студентов";
	die();
}
elseif(isset($_POST['course']) && isset($_POST['start_year']) && isset($_POST['end_year']))
{
	$_SESSION['add_stud_course'] = $_POST['course'];
	$_SESSION['start_year'] = $_POST['start_year'];
	$_SESSION['end_year'] = $_POST['end_year'];
}
if(isset($_POST['s_count']) && is_numeric($_POST['s_count']))
{
	require_once '../faculty_struct.php';
	$_SESSION['s_count'] = $_POST['s_count'] + 1;
	if($_SESSION['add_stud_course'] < 3)
	{
		$spec = "Специальность";
	}
	else
	{
		$spec = "Специализация";
	}
?>
<form method="POST" action="students.php" id="add_students" style="margin-bottom: 5px; margin-left: 3px;">
	<br />
	<table id="stud_tbl" style="margin-bottom: 100px;">
		<th>№</th>
		<th>Фамилия и инициалы студента</th>
		<th><?php print $spec; ?></th>
		<th>Группа</th>
		<th>Подгруппа</th>
<?php
	for($i = 1; $i < $_SESSION['s_count']; $i++)
	{
?>
	 	<tr>
			<td>
				<?php echo $i ?>
			</td>
			<td>
				<input type='text' class='stud_info' name="student<?php echo $i ?>" placeholder='Фамилия и инициалы студента' />
			</td>
			<td>
				<select name="st_speciality<?php echo $i ?>" class="speciality_list">
					<option></option>
					<?php 
					if ($spec === "Специальность")
					{
						$speciality = new Speciality();
						$speciality->selSpeciality();
					}
					elseif ($spec === "Специализация")
					{
						$specialization = new Specialization();
						$specialization->selSpecialization();
					}
					?>
				</select>
			</td>
			<td>
				<input type='text' class='stud_info' style='width: 50px' name="st_group<?php echo $i ?>" placeholder='группа' pattern='\d[1-9]{0,1}' />
	    	</td>
			<td>
				<input type='text' class='stud_info' style='width: 50px' name="st_subgroup<?php echo $i ?>" placeholder='подгруппа' pattern='\d[1-9]{0,1}' />
	    	</td>
	    </tr>
<?php
	}
?>
		<tr>
			<td>
				<input type='submit' value='Ok'>
			</td>
		</tr>
		<tr>
			<td align="center" colspan="6">
				<hr>
			</td>
		</tr>
	</table>
</form>
<?php
}
/*else
{
	print "Укажите число добавляемых студентов и курс";
}*/
?>