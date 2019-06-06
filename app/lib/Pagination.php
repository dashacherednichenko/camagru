<?php
defined('SECRET_KEY') or die('No direct access allowed.');
class Pagination
{
	function btn_primary($_all_photos, $_page, $_max_item, $_js_func, $pdo) {
		$_count_row = 0;
		foreach ($pdo->query($_all_photos) as $row) {
			$_count_row++;
		}
		if ($_count_row > 0) {
			echo ($_page + 1 == 1) ? '<button class="active">1</button>' : '<button onclick="' . $_js_func . '(\'1\');">1</button>';
			if ($_page + 1 > 2) {
				echo '...';
			}
			$countpages = ($_count_row / $_max_item);
			if (is_int($countpages) == true)
				$_btn = (int) ($countpages);
			else
				$_btn = (int) ($countpages + 1);
			for ($i = 1; $i <= $_btn; $i++) {
				if (!($i >= ($_page + 4) or $i <= ($_page - 2))) {
					if ($i != 1 and $i != $_btn) {
						?>
						<button <?php
						echo ($i == $_page + 1) ? 'class="active"' : ' onclick="' . $_js_func . '(\'' . $i . '\');"';
						?>><?php echo $i; ?></button>
						<?php
					}
				}
			}
			if ($_page + 1 < $_btn - 2) {
				echo '...';
			}
			if ($_btn != 1) {
				if (($_page + 1) == $_btn) {
					echo '<button class="active">' . $_btn . '</button>';
				} else {
					echo '<button onclick="' . $_js_func . '(\'' . $_btn . '\');">' . $_btn . '</button>';
				}
			}
		}
	}

}
