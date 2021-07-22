<?php
$First_name=$_POST['first_name'];
$Last_name=$_POST['last_name'];
$Email=$_POST['email'];
$Register_no=$_POST['reg'];
$From=$_POST['start_date'];
$To=$_POST['end_date'];
$Reason=$_POST['reason'];

if(!empty($First_name)||!empty($Last_name)||!empty($Email)||!empty($Register_no)||!empty($From)||!empty($To)||!empty($Reason))
{
	$host="localhost";
	$dbUsername="root";
	$dbname="OD-FORM";
	$dbPassword="";
	$conn=new mysqli($host,$dbUsername,$dbPassword,$dbname);
	if(mysqli_connect_error()){
		die('Connect Error( '. mysqli_connect_errno().')'.mysqli_connect_error());
	}
	else{
		$SELECT="SELECT email from table1 Where email= ? Limit 1";
		$INSERT="INSERT Into table1(First_name,Last_name,Register_no,Email,From,To,Reason) VALUES(?,?,?,?,?,?,?)";
		$stmt=$conn->prepare($SELECT);
		$stmt->bind_param("s",$email);
		$stmt->execute();
		$stmt->bind_result($email);
		$stmt->store_result();
		$stmt->fetch();
            $rnum = $stmt->num_rows;
            if ($rnum == 0) {
                $stmt->close();
                $stmt = $conn->prepare($Insert);
                $stmt->bind_param($First_name, $Last_name, $Register_no, $Email, $From, $To,$Reason);
                if ($stmt->execute()) {
                    echo "New record inserted sucessfully.";
                }
                else {
                    echo $stmt->error;
                }
	         }
	          $stmt->close();
         }   $conn->close();

}else{
	echo"All fields are required";
	die();
}
?>