<?php include 'connect.php';
?>
<?php
 
// create a variable
$dept = $_POST['dept'];
$faculty_name = $_POST['faculty_name'];
$f_short_name = $_POST['f_short_name'];
$Batch_no = $_POST['Batch_no'];
$Subject = $_POST['Subject'];
$subject_sname = $_POST['Subject_sname'];
$Flag = $_POST['Flag'];
$sem = $_POST['sem'];
$Class_no = $_POST['Class_no'];
$Lab_no = $_POST['Lab_no'];
$Day = $_POST['Day'];
$Lecture = $_POST['Lecture'];
$Lab = $_POST['Lab'];
 
//Execute the query
 
mysqli_query($con,"INSERT INTO timetable(department,faculty_name,f_short_name,Batch_no,Subject,subject_sname,Flag,sem,Class_no,Lab_no,Day,Lecture,Lab)
				VALUES('Sdept','$faculty_name','$f_short_name','$Batch_no','$Subject','$subject_sname','$Flag','$sem','$Class_no','$Lab_no','$Day','$Lecture','$Lab')");
				
?>