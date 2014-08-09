<!DOCTYPE html>
<html>
<head>
	<title></title>
<script type="text/javascript">
function f()
{
	var form = document.getElementById("checkForm")
	document.forms["checkForm"].submit();
}
function check()
{
	if (confirm("Вы уверены, что хотите удалить?"))
	{
		window.onload = f();
	}
	else
	{
		return false;
	}	
}
function check_box()
{
	if(check_dell.checked)
	{
		check();
	}
	else
	{
		return false;
		//document.forms["checkForm"].submit();
	}
}
</script>
</head>
<body>
<form method="GET" action="" id="checkForm">
	<input type="checkbox" id="check_dell" />
	<input type="text" name="txt" />
	<input type ="button" onclick="check_box();" value="send" />
</form>
</body>
</html>


<?php
print "<br />";
if(isset($_GET['txt']))
{
	print $_GET['txt'];
}
else
{
	print "waiting check";
}
//if(isset($_POST['confirm_del']) && $_POST['stud_id_on_del'])
?>