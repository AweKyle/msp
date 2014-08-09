<?php
$uploadfile = "tmp/file.xls";
move_uploaded_file($_FILES['somename']['tmp_name'], $uploadfile);
if(file_exists($uploadfile))
{
	require_once "PHPExcel.php"; //подключаем наш фреймворк
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
			if(preg_match("/(\d{0,2})\sкурс\s\d{0,2}\((1)\)\sгруппа/", $ar_colls[1], $s_group))
			{
				$row[0][0] = $s_group[1];
				$row[$i][] = $s_group[2];
				break;
			}
			else
			{
				if(preg_match("/\d{0,2}\sкурс\s\d{0,2}\((\d)\)\sгруппа/", $ar_colls[1], $s_group))
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
	print_r($row);
	print "<br />" . $row[0][0];
	print "<hr>";
	$res = array();
	$res[0][0] = $row[0][0];
	$size = sizeof($row);
	for($i = 1; $i < $size; $i++)
	{
		//$res = asort($row[$i]);
		$res[$i] = array_reverse($row[$i]);
	}
}
print_r($res);
?>