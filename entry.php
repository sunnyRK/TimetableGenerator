<?php 
include("connect.php");
?>
<html>
<body>
</body>

<form method="post" action="process.php">
<label>Department</label>
<select name="dept">
<option value="CSE">CSE</option>
<option value="IT">IT</option>
</select>
<br><br>
<label>Faculty name</label>
<input type="text" list="Name" name="faculty_name"/>
<datalist id="Name">
  <option value="Lokesh Sahu">
  <option value="Raviraj Chauhan">
  <option value="Ankit Chauhan">
  <option value="Harshal Shah">
  
</datalist>
<br><br>
<label>Faculty short name</label>
<input type="text" List="FSname" name="f_short_name"/>
<datalist id="FSname">
  <option value="LS">
  <option value="RC">
  <option value="AC">
  <option value="HS">
</datalist>
<br><br>

<label>Batch no</label>
<select name="Batch_no">
<option value="B1">B1</option>
<option value="B2">B2</option>
<option value="B3">B3</option>
</select>
<br><br>
<label>Subject</label>
<input type="text" List="Subjectname" name="Subject"/>
<datalist id="Subjectname">
  <option value="Big Data">
  <option value="Artifical Intelligence">
  <option value="Internet of Things">
  <option value="Python">
  
</datalist>
<br><br>
<label>Subject Short Name</label>
<input type="text" List="Sname" name="Subject_sname"/>
<datalist id="Sname">
  <option value="BD">
  <option value="AI">
  <option value="IoT">
  <option value="Python">
</datalist>
<br><br>

<label>Flag</label>
<select name="Flag">
<option value="0">0</option>
<option value="1">1</option>
</select>

<br><br>

<label>Sem</label>
<select name="sem">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>

</select>

<br><br>
<label>Class No</label>
<input type="text" name="Class_no"/>
<br><br>
<label>Lab No</label>
<select name="Lab_no">
<option value="0">-</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
</select>

<br><br>
<label>Day</label>
<select name="Day">
<option value="1">Monday</option>
<option value="2">Tuesday</option>
<option value="3">Wednesday</option>
<option value="4">Thursday</option>
<option value="5">Friday</option>
<option value="6">Saturday</option>
</select>
<br><br>
<label>Lecture</label>
<select name="Lecture">
<option value="">-</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
</select>
<br><br>
<label>Lab</label>
<select name="Lab">
<option value="">-</option>
<option value="1">1</option>
<option value="3">2</option>
<option value="5">3</option>
</select>
<br><br>

<input type="submit" >






</form>
</html>
