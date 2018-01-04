<?php

	include('connect.php');
	require('PHPExcel.php');

	$phpExcel = new PHPExcel;
	if(isset($_POST['name']))
	{
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

	$sheet ->mergeCells('A1:G1');
	$sheet ->getCell('A1')->setValue('TIME TABLE – DEGREE COURSE – A.Y. 2017-18');

	$sheet ->getCell('A2')->setValue('TIME');
	$sheet ->getCell('B2')->setValue('MONDAY');
	$sheet ->getCell('C2')->setValue('TUESDAY');
	$sheet ->getCell('D2')->setValue('WEDNESDAY');
	$sheet ->getCell('E2')->setValue('THURSDAY');
	$sheet ->getCell('F2')->setValue('FRIDAY');
	$sheet ->getCell('G2')->setValue('SATURDAY');

	$sheet ->getCell('A3')->setValue('09:30 to 10:30');
	$sheet ->getCell('A4')->setValue('10:30 to 11:30');
	$sheet ->getCell('A5')->setValue('11:30 to 12:15');
	$sheet ->getCell('A6')->setValue('12:15 to 01:15');
	$sheet ->getCell('A7')->setValue('01:15 to 02:15');
	$sheet ->getCell('A8')->setValue('02:15 to 02:30');
	$sheet ->getCell('A9')->setValue('02:30 to 03:30');
	$sheet ->getCell('A10')->setValue('03:30 to 04:30');

	$sheet ->mergeCells('B5:G5');
	$sheet ->getCell('B5')->setValue('RECESS');
	$sheet ->mergeCells('B8:G8');
	$sheet ->getCell('B8')->setValue('RECESS');

	
		$getSem=$_POST['semester'];
		$getClassName = $_POST['batch'];
	
	$i=1;
	$day_char = 'B';
	for($i=1;$i<7;$i++)
	{
		$getClass = mysqli_query($con,"SELECT * from `timetable` WHERE `Batch_no` like '".$getClassName."%' and `sem` = '".$getSem."' and `Day` = '".$i."' ORDER BY `Batch_no`;");
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
	}
	$writer->save('Class.xlsx'); 
	ob_end_clean();
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="file.xlsx"');
	header('Cache-Control: max-age=0');
	$writer->save('php://output'); 
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Timetable</title>
</head>
<body>

<form action="classTT.php" method="post">
	<select name="batch">
	  <option value="B1" >B1</option>
	  <option value="B2">B2</option>
	  <option value="B3">B3</option>
	</select>
	<select name="semester">
	  <option value="3" >3</option>
	  <option value="5">5</option>
	  <option value="8">8</option>
	</select>
	<BUTTON type="submit" name="name">Submit</BUTTON>
</form>

</body>
</html>