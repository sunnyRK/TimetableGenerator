<?php
	
	include('connect.php');
	echo "Hello";

	require('PHPExcel.php');

	$phpExcel = new PHPExcel;

	// Set default font to Arial
	$phpExcel->getDefaultStyle()->getFont()->setName('Arial');

	// Set default font size to 12
	$phpExcel->getDefaultStyle()->getFont()->setSize(12);

	// Set spreadsheet properties – title, creator and description
	$phpExcel ->getProperties()->setTitle("Product list");
	$phpExcel ->getProperties()->setCreator("Voja Janjic");
	$phpExcel ->getProperties()->setDescription("PHP Excel spreadsheet testing.");

	// Create the PHPExcel spreadsheet writer object
	// We will create xlsx file (Excel 2007 and above)
	$writer = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");

	// When creating the writer object, the first sheet is also created
	// We will get the already created sheet
	$sheet = $phpExcel ->getActiveSheet();

	// Set sheet title
	$sheet->setTitle('My product list');

	// Create spreadsheet header
	$sheet ->getCell('A1')->setValue('faculty name');
	$sheet ->getCell('B1')->setValue('shortname');
	$sheet ->getCell('C1')->setValue('batch');
	$sheet ->getCell('D1')->setValue('subject');
	$sheet ->getCell('E1')->setValue('class_no');
	$sheet ->getCell('F1')->setValue('lab_no');
	$sheet ->getCell('G1')->setValue('day');

	// Make the header text bold and larger
	$sheet->getStyle('A1:H1')->getFont()->setBold(true)->setSize(14);

	$retrive = mysqli_query($con,"SELECT * FROM `timetable`;");
	$i = 2;
	while($data=mysqli_fetch_assoc($retrive))
	{
		$id = $data['Id'];
		$que = $data['faculty_name'];
		$f_short_name = $data['f_short_name'];
		$batch_no = $data['Batch_no'];
		$subject = $data['Subject'];
		$flag = $data['flag'];
		$class_no = $data['Class_no'];
		$lab_no = $data['Lab_no'];
		$day = $data['Day'];
		$lecture = $data['Lecture'];
		$lab = $data['Lab'];
		
		
			$sheet ->getCell('A'.$i)->setValue($que);
			$sheet ->getCell('B'.$i)->setValue($f_short_name);
			$sheet ->getCell('C'.$i)->setValue($batch_no);
			$sheet ->getCell('D'.$i)->setValue($subject);
			$sheet ->getCell('E'.$i)->setValue($class_no);
			$sheet ->getCell('F'.$i)->setValue($lab_no);
			$sheet ->getCell('G'.$i)->setValue($day);
			$i++;
	}
	

	// Autosize the columns
	$sheet->getColumnDimension('A')->setAutoSize(true);
	$sheet->getColumnDimension('B')->setAutoSize(true);
	$sheet->getColumnDimension('C')->setAutoSize(true);
	$sheet->getColumnDimension('D')->setAutoSize(true);
	$sheet->getColumnDimension('E')->setAutoSize(true);
	$sheet->getColumnDimension('F')->setAutoSize(true);
	$sheet->getColumnDimension('G')->setAutoSize(true);

	// Save the spreadsheet
	$writer->save('products.xlsx'); 
	/*ob_end_clean();
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="file.xlsx"');
	header('Cache-Control: max-age=0');
	$writer->save('php://output'); */



		
?>