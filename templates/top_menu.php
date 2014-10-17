<!DOCTYPE html>
<html>
<div class="top_menu">
	<form method="post" action="" id="fast_search_form">
		<ul class="top_ul">
			<li>
				<select name="year">
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
			<li></li>
		</ul>
	</form>
</div>
</html>