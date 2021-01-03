<!DOCTYPE html>
<html lang="en">
	<?php
	include 'head.php';
	?>

	<body>

		<!------------------------------------------------------------ navbar call -------------------------------------------------------------->
		<?php
		require 'connect.php';
		include 'navbar_execution.php';
		?>

		<h3 id="titleSearch">Import Executions from file</h3>

		<form  enctype="multipart/form-data" class="well" id="formExecutionExcel" action="importExecution.php" method="POST">
			<h3>Load a file</h3>

			<div class="container">
				<div class="form-groupcontractID col-lg-4">
					<label for="loadedFile">Load a CSV file: </label>
					<input type="file" name="loadedFile" />
				</div>
			</div>

			<input type="submit" class="btn btn-primary pull-right" value="Load execution file">
		</form>

		<form class="well" id="formExecutionFile" action="actionImportExecution.php" method="POST">
			<div class="container">
				<?php
				if (isset($_FILES['loadedFile']['name'])) {

					$extensions_valides = array('csv');
					$extension_upload = strtolower(  substr(  strrchr($_FILES['loadedFile']['name'], '.')  ,1)  );
					if (in_array($extension_upload, $extensions_valides)) {
						require_once '../Classes/PHPExcel/IOFactory.php';
						
						$nom = 'C:\wamp\www\REMIT\execution\dataCSV/'.date('Ymd').'_originalDATA.csv';
						$resultat = move_uploaded_file($_FILES['loadedFile']['tmp_name'],$nom);
						if ($resultat) echo "Succes load";

						// Chargement du fichier Excel
						$objPHPExcel = PHPExcel_IOFactory::load('C:\wamp\www\REMIT\execution\dataCSV/'.date('Ymd').'_originalDATA.csv');

						/**
						 * recuperation de la premiere feuille du fichier Excel
						 * @var PHPExcel_Worksheet $sheet
						 */

						$sheet = $objPHPExcel -> getSheet(0);


						echo '<table border="1">';

						// On boucle sur les lignes

						foreach ($sheet->getRowIterator() as $row) {
							$cellIterator = $row -> getCellIterator();
							$cellIterator -> setIterateOnlyExistingCells(false);
							echo '<tr>';

							// On boucle sur les cellule de la ligne
							foreach ($cellIterator as $cell) {
								echo '<td>';
								// Convert any rich text cells to plain text
								if ($cell -> getDataType() == PHPExcel_Cell_DataType::TYPE_INLINE) {
									print_r($cell -> getValue() -> getPlainText());
								}
								// Remove any newline characters in string cells
								if ($cell -> getDataType() == PHPExcel_Cell_DataType::TYPE_STRING) {
									print_r(str_replace("\n", "", $cell -> getValue()));
								}
								echo '</td>';
							}

							echo '</tr>';
						}
						echo '</table>';
					}

				}
			?>
			</div>

			<input type="submit" class="btn btn-primary pull-right" value="Load executions of table">
		</form>

	</body>
</html>