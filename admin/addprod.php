<?php
	
	if ( isset( $_GET['submit'] ) ) {
			if ( trim( $_GET['p_name'] ) == '' ) {
				$errors[] = 'Enter product name';
			}
			if ( trim( $_GET['p_quantity'] ) == '' ) {
				$errors[] = 'Enter product quantity';
			}
			if ( trim( $_GET['p_country'] ) == '' ) {
				$errors[] = 'Enter product origin country';
			}
			if ( trim( $_GET['p_price'] ) == '' ) {
				$errors[] = 'Enter product price';
			}
			if ( trim( $_GET['p_category'] ) == '' ) {
				$errors[] = 'Enter product category';
			}
			if ($errors) {
				header('Location: /admin.php');
			} else {
					echo array_shift($errors);
			}
		}

?>