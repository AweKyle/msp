<style type="text/css">
	.form {
		text-align: center;
	}
</style>
<div class="form">
	<p>Для входа введите свои учетные данные</p>
	<form method="POST" action="/msp/modules/user.php">
		<p><input type="text" name="login" placeholder="Введите логин" size="25" maxlength="30" /></p>
		<p><input type="password" name="password" placeholder="Введите пароль" size="25" maxlength="30" /></p>		
		<p><input type="submit" value="Вход" /></p>
	</form>
	<a class="fancybox fancybox.iframe" href="/msp/view/register.php">Зарегистрироваться</a>
</div>