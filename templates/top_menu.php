<!DOCTYPE html>
<html>
<style type="text/css">
	.top_ul {
		list-style: none;
		display: inline-flex;
		float: right;
		margin-top: 0px;
	}
	.top_li {
		padding-top: 11px;
		padding-right: 35px;
	}
	.top_li:last-child {
		border-left: 1px solid #b5d7d6;
		margin-left: 20px;
		padding: 0px;
	}
	.lock {
		width: 40px;
		margin-left: 5px;
	}
	.lock:hover {
		background-color: cadetblue;
		border-radius: 7px;
	}
	.inp_search {
		border-radius: 4px;
		height: 18px;
		font-style: italic;

	}
	.select-box {
		width: 155px;
		height: 24px;
		/* font: 22px normal Arial, Helvetica, sans-serif; */
		font-style: italic;
		color: #777;
		border: 1px solid #c5c5c5;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		border-radius: 3px;
		padding: 2px 0 5px 10px;
	}
	.btn {
		height: 24px;
		width: 70px;
	}
	.lol {
		height: 46px;
		background-color: black;
		margin: -8px 0 0 0;
		padding-right: 5px;
	}
</style>
<div class="top_menu">
	<div class="lol">
		<form method="post" action="" id="fast_search_form">
			<ul class="top_ul">
				<li class="top_li">
					<select name="year" class="select-box">
						<option value="all" selected="" disabled="">Год</option>
						<option value="all">Не имеет значения</option>
						<?php
						$max_y = date('y');
						$start = 9;
						 while ($start != $max_y) {
						 	$start++;
							echo "<option value='20'" . $start . ">20" . $start . "</option>";
						}
						?>
					</select>
				</li>
				<li class="top_li">
					<select name="period" class="select-box">
						<option value="all" selected="" disabled="">Период</option>
						<option value="all">Не имеет значения</option>
						<option>Зимняя сессия</option>
						<option>Летняя сессия</option>
					</select>
				</li>
				<li class="top_li">
					<select name="course" class="select-box">
						<option value="all" selected="" disabled="">Курс</option>
						<?php
						for ($i = 1; $i < 6; ++$i) {
							echo "<option value=" . $i . ">" . $i . " курс</option>";
						}
						?>
					</select>
				</li>
				<li class="top_li">
					<select name="group" class="select-box">
						<option value="all"  disabled="">Группа</option>
					</select>
				</li>
				<li class="top_li">
					<input type="text" class="inp_search" size="40" name="student" value="" placeholder="Ф.И.О. студента" />
				</li>
				<li class="top_li">
					<input type="submit" name="search" value="Поиск" class="btn" />
				</li>
				<li class="top_li">
					<a href="#" class="sign_up">
						<img src="/msp/img/lock.png" class="img lock" />
					</a>
				</li>
			</ul>
		</form>
	</div>
</div>
</html>