<html>
	<head>
		<style>
		p.inline {display: inline-block;}
		span { font-size: 13px;}
		</style>
		<style type="text/css" media="print">
		    @page 
		    {
		        size: auto;   /* auto is the initial value */
		        margin: 0mm;  /* this affects the margin in the printer settings */

		    }
		</style>
	</head>
	<body onload="window.print();">
		<div style="margin-left: 5%">
			<?php

			include '../barcode/barcode128.php';

			$barcodeStart = $_POST['barcodeStart'];
			$barcodeEnd = $_POST['barcodeEnd'];

			for($i=$barcodeStart;$i<=$barcodeEnd;$i++){

				echo "<p class='inline'>
				<span >
					<b>".bar128(stripcslashes($i))."</b>
				<span>
				</p>&nbsp&nbsp&nbsp&nbsp";
			}

			?>
		</div>
	</body>
</html>