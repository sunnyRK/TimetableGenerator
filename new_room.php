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

	
	$sheet ->getCell('A1')->setValue('PIET-CSE');
	$address = 'At.Waghodia,'.PHP_EOL.'Dist'.PHP_EOL.' Vadodara';
	$sheet ->getCell('A2')->setValue($address);

	$sheet ->mergeCells('B1:L1');
	$sheet ->getCell('B1')->setValue('QUALITY RECORDS');

	$sheet ->mergeCells('B2:L2');
	$sheet ->getCell('B2')->setValue('QR-751-3.2 CLASS ROOM OCCUPANCY(2017-18)');
	
	$sheet ->mergeCells('A3:L3');
	$sheet ->getCell('A3')->setValue('CSE DEPARTMENT');

	$sheet ->getCell('A5')->setValue('Room No.');
	$sheet ->mergeCells('A6:A11');
	$sheet ->getCell('A6')->setValue('Monday');
	$sheet ->mergeCells('A12:A17');
	$sheet ->getCell('A12')->setValue('Tuesday');
	$sheet ->mergeCells('A18:A23');
	$sheet ->getCell('A18')->setValue('Wednesday');
	$sheet ->mergeCells('A24:A29');
	$sheet ->getCell('A24')->setValue('Thursday');
	$sheet ->mergeCells('A30:A35');
	$sheet ->getCell('A30')->setValue('Friday');
	
	$j = 'B';
	$getClassNO = mysqli_query($con,"SELECT `Class_no` from `timetable` ORDER BY `Class_no`;");
	while($data = mysqli_fetch_assoc($getClassNO))
	{
		$class_no = $data['Class_no'];
		$sheet ->getCell($j.'5')->setValue($class_no);
		
		
		for($i=1;$i<7;$i++)
		{
			$var = 6*$i;
			$getClass = mysqli_query($con,"SELECT * from `timetable` WHERE `Class_no` = '".$class_no."' and `Day` = '".$i."';");
			while($data = mysqli_fetch_assoc($getClass))
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
				$entry_no = $var + ($lecture - 1);
				$sheet ->getCell($j.$entry_no)->setValue($sem.$batch_no." : ".$subject_sname." : ".$f_short_name."(".$class_no.")");
			}
		}
		$j++;
	}
	
	/*

	$i=1;
	$day_char = 'B';
	for($i=1;$i<7;$i++)
	{
		$getClass = mysqli_query($con,"SELECT * from `timetable` WHERE `faculty_name` = 'Lokesh Sahu' and `Day` = '".$i."';");
		while($data = mysqli_fetch_assoc($getClass))
		{
			$row_no = 2;
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
				$row_no += $lecture;
				if($lecture >2)
				{
					if($lecture>4)
					{
						$row_no+=2;
					}
					else
					{
						$row_no+=1;
					}
				}
				$sheet ->getCell($day_char.$row_no)->setValue($sem.$batch_no." : ".$subject_sname." : ".$f_short_name."(".$class_no.")");
			}
			else
			{
				$row_no += $lab;
				if($lab >2)
				{
					if($lab>4)
					{
						$row_no+=2;
					}
					else
					{
						$row_no+=1;
					}
				}
				$temp1=$day_char.$row_no++;
				$temp2=$day_char.$row_no;
				$predata = $sheet ->getCell($temp1)->getValue();
				if($predata!="")
				{
					$predata= $predata.PHP_EOL; 
				}
				$sheet ->mergeCells($temp1.":".$temp2);
				$sheet ->getCell($temp1)->setValue($predata.$sem.$batch_no." : ".$subject_sname." : ".$f_short_name."(L-".$lab_no.")");
			}
		}
		$day_char++;
	}*/
	$writer->save('new_room.xlsx'); 
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