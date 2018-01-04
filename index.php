<?php
	
	include('connect.php');
	require('PHPExcel.php');

	
	$phpExcel = new PHPExcel;

	// Set default font to Arial
	$phpExcel->getDefaultStyle()->getFont()->setName('Arial');

	// Set default font size to 12
	$phpExcel->getDefaultStyle()->getFont()->setSize(12);
	$phpExcel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

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

	$sheet->getColumnDimension('A')->setAutoSize(true);
	$sheet->getColumnDimension('B')->setAutoSize(true);
	$sheet->getColumnDimension('C')->setAutoSize(true);
	$sheet->getColumnDimension('D')->setAutoSize(true);
	$sheet->getColumnDimension('E')->setAutoSize(true);
	$sheet->getColumnDimension('F')->setAutoSize(true);
	$sheet->getColumnDimension('G')->setAutoSize(true);
	$sheet->getColumnDimension('H')->setAutoSize(true);
	$sheet->getColumnDimension('I')->setAutoSize(true);
	$sheet->getColumnDimension('J')->setAutoSize(true);
	$sheet->getColumnDimension('K')->setAutoSize(true);
	$sheet->getColumnDimension('L')->setAutoSize(true);
	$sheet->getColumnDimension('M')->setAutoSize(true);
	$sheet->getColumnDimension('N')->setAutoSize(true);
	$sheet->getColumnDimension('O')->setAutoSize(true);
	$sheet->getColumnDimension('P')->setAutoSize(true);
	$sheet->getColumnDimension('Q')->setAutoSize(true);
	$sheet->getColumnDimension('R')->setAutoSize(true);
	$sheet->getColumnDimension('S')->setAutoSize(true);
	$sheet->getColumnDimension('T')->setAutoSize(true);
	$sheet->getColumnDimension('U')->setAutoSize(true);
	$sheet->getColumnDimension('V')->setAutoSize(true);
	$sheet->getColumnDimension('W')->setAutoSize(true);
	$sheet->getColumnDimension('X')->setAutoSize(true);
	$sheet->getColumnDimension('Y')->setAutoSize(true);
	$sheet->getColumnDimension('Z')->setAutoSize(true);
	$sheet->getColumnDimension('AA')->setAutoSize(true);
	$sheet->getColumnDimension('AB')->setAutoSize(true);
	$sheet->getColumnDimension('AC')->setAutoSize(true);
	$sheet->getColumnDimension('AD')->setAutoSize(true);
	$sheet->getColumnDimension('AE')->setAutoSize(true);
	// Set sheet title
	$sheet->setTitle('My product list');

	// Create spreadsheet header
	$sheet ->getCell('A1')->setValue('faculty_name');
	$sheet ->mergeCells('A1:A2');
	$sheet ->getCell('B1')->setValue('Monday');
	$sheet ->mergeCells('B1:G1');
	$sheet ->getCell('B2')->setValue('Lecture 1');
	$sheet ->getCell('C2')->setValue('Lecture 2');
	$sheet ->getCell('D2')->setValue('Lecture 3');
	$sheet ->getCell('E2')->setValue('Lecture 4');
	$sheet ->getCell('F2')->setValue('Lecture 5');
	$sheet ->getCell('G2')->setValue('Lecture 6');
	$sheet ->getCell('h1')->setValue('Tuesday');
	$sheet ->mergeCells('H1:M1');
	$sheet ->getCell('H2')->setValue('Lecture 1');
	$sheet ->getCell('I2')->setValue('Lecture 2');
	$sheet ->getCell('J2')->setValue('Lecture 3');
	$sheet ->getCell('K2')->setValue('Lecture 4');
	$sheet ->getCell('L2')->setValue('Lecture 5');
	$sheet ->getCell('M2')->setValue('Lecture 6');
	$sheet ->getCell('N1')->setValue('Wednesday');
	$sheet ->mergeCells('N1:S1');
	$sheet ->getCell('N2')->setValue('Lecture 1');
	$sheet ->getCell('O2')->setValue('Lecture 2');
	$sheet ->getCell('P2')->setValue('Lecture 3');
	$sheet ->getCell('Q2')->setValue('Lecture 4');
	$sheet ->getCell('R2')->setValue('Lecture 5');
	$sheet ->getCell('S2')->setValue('Lecture 6');
	$sheet ->getCell('T1')->setValue('Thursday');
	$sheet ->mergeCells('T1:Y1');
	$sheet ->getCell('T2')->setValue('Lecture 1');
	$sheet ->getCell('U2')->setValue('Lecture 2');
	$sheet ->getCell('V2')->setValue('Lecture 3');
	$sheet ->getCell('W2')->setValue('Lecture 4');
	$sheet ->getCell('X2')->setValue('Lecture 5');
	$sheet ->getCell('Y2')->setValue('Lecture 6');
	$sheet ->getCell('Z1')->setValue('Friday');
	$sheet ->mergeCells('Z1:AE1');
	$sheet ->getCell('Z2')->setValue('Lecture 1');
	$sheet ->getCell('AA2')->setValue('Lecture 2');
	$sheet ->getCell('AB2')->setValue('Lecture 3');
	$sheet ->getCell('AC2')->setValue('Lecture 4');
	$sheet ->getCell('AD2')->setValue('Lecture 5');
	$sheet ->getCell('AE2')->setValue('Lecture 6');

	// Make the header text bold and larger
	$sheet->getStyle('A1:AK1')->getFont()->setBold(true)->setSize(14);

	// Autosize the columns


	// Save the spreadsheet
	$writer->save('products.xlsx'); 
	/*ob_end_clean();
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="file.xlsx"');
	header('Cache-Control: max-age=0');
	$writer->save('php://output'); */

$faculty_list = mysqli_query($con,"SELECT DISTINCT `faculty_name` from `timetable`;");
$i=2;
while($name=mysqli_fetch_assoc($faculty_list))
{
	$i++;
	$faculty_name_unique = $name['faculty_name'];
	$sheet ->getCell('A'.$i)->setValue($faculty_name_unique);
	$faculty_detail = mysqli_query($con,"SELECT * FROM `timetable` WHERE `faculty_name`='".$faculty_name_unique."';");
	while($data = mysqli_fetch_assoc($faculty_detail))
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
		if($flag == 0)
		{
			$col="";
			$result = ($day-1)*6+$lecture;
			if($result>25)
			{
				$c=chr($result-26+65);
				$col = "A".$c;
				$sheet ->getCell($col.$i)->setValue($sem.$batch_no." : ".$subject_sname." : ".$f_short_name."(".$class_no.")");
			}
			else
			{
				$c = chr($result+65);
				$sheet ->getCell($c.$i)->setValue($sem.$batch_no." : ".$subject_sname." : ".$f_short_name."(".$class_no.")"	);
			}
		}
		else
		{
			$col="";
			$result = ($day-1)*6+$lab;
			if($result>25)
			{
				$c=chr($result-26+65);
				$col = "A".$c;
				$c++;
				$col2 = "A".$c;
				$sheet ->mergeCells($col.$i.":".$col2.$i);
				$sheet ->getCell($col.$i)->setValue($sem.$batch_no." : ".$subject_sname." : ".$f_short_name."(L-".$lab_no.")");
			}
			else
			{
				$col = chr($result+65);
				$c=$col;
				$c++;
				$col2 = $c;
				echo $col." ".$col2;
				$sheet ->mergeCells($col.$i.":".$col2.$i);
				$sheet ->getCell($col.$i)->setValue($sem.$batch_no." : ".$subject_sname." : ".$f_short_name."(L-".$lab_no.")");
			}
		}
	}

}



// $retrive = mysqli_query($con,"SELECT * FROM `timetable`;");
// $i=3;
// $c = A;
// 	while($data=mysqli_fetch_assoc($retrive))
// 	{
// 		$id = $data['Id'];
// 		$faculty = $data['faculty_name'];
// 		$f_short_name = $data['f_short_name'];
// 		$batch_no = $data['Batch_no'];
// 		$subject = $data['Subject'];
// 		$flag = $data['flag'];
// 		$class_no = $data['Class_no'];
// 		$lab_no = $data['Lab_no'];
// 		$day = $data['Day'];
// 		$lecture = $data['Lecture'];
// 		$lab = $data['Lab'];
// 		$sheet ->getCell('A'.$i)->setValue($faculty);
// 		if($flag == 0)
// 		{
// 			$col="";
// 			$result = ($day-1)*6+$lecture;
// 			if($result>25)
// 			{
// 				$c=chr($result-26+65);
// 				$col = "A".$c;
// 				$sheet ->getCell($col.$i)->setValue("7".$batch_no." : ".$subject." : ".$f_short_name."(".$class_no.")");
// 			}
// 			else
// 			{
// 				$c = chr($result+65);
// 				$sheet ->getCell($c.$i)->setValue("7".$batch_no." : ".$subject." : ".$f_short_name."(".$class_no.")"	);
// 			}
// 			echo $col."----------";
// 		}
// 		else
// 		{

// 		}
// 		echo $id;
// 		echo $faculty;
// 		echo $f_short_name;
// 		echo $batch_no;
// 		echo $subject;
// 		echo $flag;
// 		echo $class_no;
// 		echo $lab_no;
// 		echo $day;
// 		echo $lecture;
// 		echo $lab;
// 		$i++;
// 	}

		$writer->save('products.xlsx'); 
?>