<?php
header("Content-Type:text/html; Charset=utf-8");
require "scripts/func.php";
$base_memory_usage = memory_get_usage();
function memoryUsage($n, $usage, $base_memory_usage)
{
	printf("Bytes diff: %d\n", $usage-$base_memory_usage);
	print "   Step: " . $n . "<br />";
}
memoryUsage(1, memory_get_usage(), $base_memory_usage);
echo memory_get_usage() . "<br>";
if(empty($_FILES['somename']['tmp_name']))
{
	alert("Файл не выбран");
}
else
{
	$uploadfile = "tmp/file.xls";
	move_uploaded_file($_FILES['somename']['tmp_name'], $uploadfile);
	if(file_exists($uploadfile))
	{
		require_once "lib/PHPExcel.php"; //подключаем наш фреймворк
		$filepath = "tmp/file.xls";
		$inputFileType = PHPExcel_IOFactory::identify($filepath);  // узнаем тип файла, excel может хранить файлы в разных форматах, xls, xlsx и другие
		$objReader = PHPExcel_IOFactory::createReader($inputFileType); // создаем объект для чтения файла
		$objPHPExcel = $objReader->load($filepath); // загружаем данные файла в объект
		$countList = $objPHPExcel->getSheetCount();

		$listsArr = $objPHPExcel->getSheetNames();
		$sheetName = array();		//массив имен листов
		foreach($listsArr as $val)
		{
			if(preg_match("/\d{0,2}\s(группа)/", $val))		//выбираем листы по шаблону № группы
			{
				$sheetName[] = $val;
			}
		}
		$sheetIndx = sizeof($sheetName);
		$row = array();		//массив, в который записываем все данные(!NULL) из выбранных листов
		for($i = 1; $i < $sheetIndx + 1; ++$i)
		{
			$objPHPExcel->setActiveSheetIndexByName($i . " группа");
			$group[$i] = array_reverse($objPHPExcel->getActiveSheet()->toArray());
			foreach($group[$i] as $ar_colls)
			{
				if(preg_match("/(\d{0,2})\sкурс\s\d{0,2}\s*\((1)\)\sгруппа/", $ar_colls[1], $s_group))
				{
					$row[0][0] = $s_group[1];
					$row[$i][] = $s_group[2];
					break;
				}
				else
				{
					if(preg_match("/\d{0,2}\sкурс\s\d{0,2}\s*\((\d)\)\sгруппа/", $ar_colls[1], $s_group))
					{
						$row[$i][] = $s_group[1];
					}
					elseif(preg_match("/\d/", $ar_colls[0]))
					{
						if($ar_colls[1] !== NULL)
						{
							$row[$i][] = $ar_colls[1];		
						}
					}
				}
			}
		}
	//memoryUsage(2, memory_get_usage(), $base_memory_usage);
	//echo memory_get_usage() . "<br>";
		unset($inputFileType, $objReader, $objPHPExcel, $countList, $listsArr, $val, $sheetName, $sheetName, $group);
	//memoryUsage(3, memory_get_usage(), $base_memory_usage);
	//echo memory_get_usage() . "<br>";
	//memoryUsage(4, memory_get_usage(), $base_memory_usage);
	//echo memory_get_usage() . "<br>";
	///	unset($row, $matches, $size, $k);
	//memoryUsage(5, memory_get_usage(), $base_memory_usage);
	//echo memory_get_usage() . "<br>";
		if(!empty($row))
		{
			$res = array();
			$res[0][0] = $row[0][0];
			$res[0][1] = $_POST['start_year'];
			$res[0][2] = $_POST['end_year'];
			$size = sizeof($row);
			for($i = 1; $i < $size; $i++)
			{
				//$res = asort($row[$i]);
				$res[$i] = array_reverse($row[$i]);
			}
			$students = serialize($res);
			if(file_exists("tmp/students.txt"))
			{
				unlink("tmp/students.txt");
			}
			file_put_contents("tmp/students.txt", $students);
			unset($students, $row, $s_group);
			$resSize = sizeof($res);
	//memoryUsage(6, memory_get_usage(), $base_memory_usage);
	//echo memory_get_usage() . "<br>";
		?>
	<html>
	<head>
		<link rel="stylesheet" type="text/css" href="styles/style.css">
		<script type = "text/javascript" src = "jquery-2.0.2.min.js"></script>
		<script type="text/javascript" src = "scripts/functions.js"></script>
	</head>
	<body>
		Пожалуйста, убедитесь в корректности списка студентов!
		<form method="POST" action="students.php" id="checkForm">
			<input type="hidden" value="true" name="status" id="stat" />
			<input type="button" onclick="check();" value="Подтвердить" />
		</form>
		<table border="1">
		<?php
		print "<th colspan=" . ++$resSize . ">" . $res[0][0] . " курс. Учебный год:" . $res[0][1] . "/" . $res[0][2] . "</th>";
		?>
		<tr>
		<?php
			require "faculty_struct.php";
			for($i = 1; $i < $resSize - 1; ++$i)
			{
				print "<td valign=\"TOP\">Группа " . $i . "<hr>";
				$studCount = sizeof($res[$i]);
				for($j = 0; $j < $studCount; ++$j)
				{
					print $res[$i][$j] . "<br />";
				}
				print "</td>";
			}
			unset($res, $resSize, $studCount);
	//memoryUsage(7, memory_get_usage(), $base_memory_usage);
	//echo memory_get_usage() . "<br>";
		?>	
		</tr>
		</table>
		<?php
		}
		unlink($uploadfile);
	}
	else
	{
		alert("err");
	}
}	
?>
	</body>
</html>