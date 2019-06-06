<?php

class Pagination
{
	function btn_primary($_str_query, $_page, $_max_item, $_js_function_name, $pdo) {
		$_count_row = 0;
		foreach ($pdo->query($_str_query) as $row) {
			$_count_row++;
		}
		if ($_count_row > 0) {
			if ($_page + 1 == 1) {
				echo '<button class="btn btn-sm btn-primary active">1</button>';
			} else {
				echo '<button class="btn btn-sm btn-primary" onclick="' . $_js_function_name . '(\'1\');">1</button>';
			}
			echo ' ';
			if ($_page + 1 > 2) {
				echo ' ... ';
			}
			$_btn = (int) (($_count_row / $_max_item) + 1);
			for ($i = 1; $i <= $_btn; $i++) {
				if (!($i >= ($_page + 4) or $i <= ($_page - 2))) {
					if ($i != 1 and $i != $_btn) {
						?>
						<button <?php
						if ($i == $_page + 1) {
							echo 'class="btn btn-sm btn-primary active"';
						} else {
							echo 'class="btn btn-sm btn-primary" onclick="' . $_js_function_name . '(\'' . $i . '\');"';
						}
						?>><?php echo $i; ?></button>

						<?php
					}
				}
			}
			if (($_page + 1 < $_btn - 2) and ( $_right_dot == 0)) {
				echo ' ... ';
			}
			if ($_btn != 1) {
				if (($_page + 1) == $_btn) {
					echo '<button class="btn btn-sm btn-primary active">' . $_btn . '</button>';
				} else {
					echo '<button class="btn btn-sm btn-primary" onclick="' . $_js_function_name . '(\'' . $_btn . '\');">' . $_btn . '</button>';
				}
			}
			echo ' ';
		}
	}

}
