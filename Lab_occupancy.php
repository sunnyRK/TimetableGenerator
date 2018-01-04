<?php

	include('connect.php');
	require('PHPExcel.php');

	$phpExcel = new PHPExcel;

	// Set default font to Arial
	$phpExcel->getDefaultStyle()->getFont()->setName('Arial');

	// Set default font size to 12
	$phpExcel->getDefaultStyle()->getFont()->setSize(12);
	$phpExcel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$phpExcel->getDefaultStyle()->getAlignment()->setWrapText(true);
	// Set spreadsheet properties – title, creator and description
	$phpExcel ->getProperties()->setTitle("Product list");
	$phpExcel ->getProperties()->setCreator("Voja Janjic");
	$phpExcel ->getProperties()->setDescription("PHP Excel spreadsheet testing.");

	// Create the PHPExcel spreadsheet writer object
	// We will create xlsx file (Excel 2007 and above)
	$writer = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");

	$sheet = $phpExcel ->getActiveSheet();

	$sheet->getColumnDimension('A')->setAutoSize(true);
	$sheet->getColumnDimension('B')->setAutoSize(true);
	$sheet->getColumnDimension('C')->setAutoSize(true);
	$sheet->getColumnDimension('D')->setAutoSize(true);
	$sheet->getColumnDimension('E')->setAutoSize(true);
	$sheet->getColumnDimension('F')->setAutoSize(true);
	$sheet->getColumnDimension('G')->setAutoSize(true);

	
	

	$sheet ->mergeCells('A1:P1');
	$sheet ->getCell('A1')->setValue('PARUL INSTITUTE OF ENGINEERING & TECHNOLOGY (DEGREE- 1ST SHIFT)');
	$sheet ->mergeCells('A2:P2');
	$sheet ->getCell('A2')->setValue('Computer Science & Engineering  Department');
	$sheet ->mergeCells('A3:P3');
	$sheet ->getCell('A3')->setValue('LAB OCCUPANCY FOR AY :2017-2018');

	$sheet ->mergeCells('A4:A5');
	$sheet ->getCell('B4')->setValue('Lab');
	$labSheet=6;
	for($i=1;$i<=10;$i++)
	{
		$sheet ->getCell('A'.$labSheet++)->setValue('Lab-'.$i);
	}
	$char = 'B';
	$char2 = 'D';
	for($i=1;$i<6;$i++)
	{
		$temp1 = $char.'4';
		$temp2 = $char2.'4';
		$sheet ->mergeCells($temp1.":".$temp2);
		$char2++;
		$char2++;
		$char2++;
	
		switch($i)
		{
			case 1:$sheet ->getCell($char.'4')->setValue('Monday');
					break;
			
			case 2:$sheet ->getCell($char.'4')->setValue('Tuesday');
					break;
					
			
			case 3:$sheet ->getCell($char.'4')->setValue('Wednesday');
					break;
					
			case 4:$sheet ->getCell($char.'4')->setValue('Thursday');
					break;
					
			case 5:$sheet ->getCell($char.'4')->setValue('Friday');
					break;
		}
		
		$sheet ->getCell($char.'5')->setValue('09:30 TO'.PHP_EOL.'11:30');
		$char++;			
		$sheet ->getCell($char.'5')->setValue('12:15 TO'.PHP_EOL.'02:15');	
		$char++;			
		$sheet ->getCell($char.'5')->setValue('02:30 TO'.PHP_EOL.'04:30');	
		$char++;
		
	}
	$var = 'B';
	$labNo = 5;
	for($i=1;$i<6;$i++)
	{
		for($j=1;$j<6;$j+=2)
		{
			$getLabDay = mysqli_query($con,"SELECT * from `timetable` WHERE `Day`='".$i."' and `Lab`='".$j."';");
			while($data = mysqli_fetch_assoc($getLabDay))
			{
				$id = $data['Id'];
				$faculty = $data['faculty_name'];	
				$f_short_name = $data['f_short_name'];
				$batch_no = $data['Batch_no'];
				$subject = $data['Subject'];
				$flag = $data['Flag'];
				$subject_sname = $data['subject_sname'];
				$sem = $data['sem'];
				$class_no = $data['Class_no'];
				$lab_no = $data['Lab_no'];
				$day = $data['Day'];
				$lecture = $data['Lecture'];
				$lab = $data['Lab'];
				$entry_no = $labNo + $lab_no;
				$sheet ->getCell($var.$entry_no)->setValue($sem.$batch_no." : ".$subject_sname." : ".$f_short_name."(".$class_no.")");
			}
			$sheet->getColumnDimension($var)->setAutoSize(true);
			$var++;
			
		}
	}	
		
	$writer->save('Lab_occupancy.xlsx'); 
	ob_end_clean();
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="file.xlsx"');
	header('Cache-Control: max-age=0');
	$writer->save('php://output'); 

?>

<!DOCTYPE html>
<html>
<head>
	<title>Timetable</title>
</head>
<body>


</body>
</html>