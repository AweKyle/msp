<?php
require_once 'includes/header.php';
require_once 'includes/func.php';
require_once 'includes/dbconn.php';
date_default_timezone_set('Europe/Moscow');

function selectStud()
{
	$c = DB::getConn();
	$selectQuery = $c->query("SELECT `student_name`, `student_surname`, `student_patronymic` 
					  FROM `rating_system`.`students`");
	$stud = array();
	$i = 0;
	while($res = $selectQuery->fetch(PDO::FETCH_ASSOC))
	{
		$stud['studsurname'][$i] = $res['student_surname'];
		$stud['studname'][$i] = $res['student_name'];
		$stud['studpatr'][$i] = $res['student_patronymic'];
		$i++;
	}
	return $stud;
}

$test = selectStud();

var_dump($test);
print "<br /><hr>";
$sizei =sizeof($test['studsurname']);
print "<table>";
$str = "<table border = '1'>";

for($i = 0; $i < $sizei; $i++)
{
	$str .= "<tr><td>" . $test['studsurname'][$i] . "</td><td>" . $test['studname'][$i] . "</td><td>" . $test['studpatr'][$i] . "</td></tr>";
}

/*
foreach($test as $first)
{
	foreach($first as $key=>$value)
	{
		echo "<dt>$key</dt><dd>$value</dd>";
	}
}
*/

$str .= "</table>";
var_dump($str);
/*
ob_end_clean();
require_once 'tcpdf_min/tcpdf.php';

$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false); 
$pdf->setPrintHeader(false); 
$pdf->setPrintFooter(false); 
$pdf->SetMargins(20, 25, 25); 
//$pdf->AddPage();
$pdf->SetXY(90, 10);
$pdf->SetDrawColor(0, 0, 200);
$pdf->SetTextColor(0, 200, 0);
//$pdf->Cell(30, 6, $str, 1, 1, 'C'); 
//$pdf->Output('doc.pdf', 'I');

$pdf->AddPage();
$pdf->SetFont('arial', '', 9);
$pdf->writeHTML($str, true, false, true, false, '');
$pdf->Output('test.pdf', 'I');
*/
?>
<!doctype html>
<html>
<head>
	<script type = "text/javascript" src = "jquery-2.0.2.min.js"></script>
	<script type="text/javascript">
	</script>
</head>
<body>
	<!-- 
	<label id="lal"><li>Добавить специальность</li></label>
	<label><li onMouseOver="this.style.color='#0000ff'" onMouseOut="this.style.color='#000'">Добавить кафедру</li></label>
	<label><li>Добавить специализацию</li></label>
	<label><li>Добавить студентов</li></label>
	<label><li>Добавить предмет</li></label>
	<input type="button" id="btn1" value="BUTTON" /> 
	-->
</body>
</html>