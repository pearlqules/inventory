<?php 
include('../../config/connect.php'); 

date_default_timezone_set('Asia/Bangkok');
$date = date("Ymd");	 
//เป็นฟังก์ชันสำหรับเลี่ยงการใช้ตัวอักขระพิเศษในคำสั่ง sql เช่น เครื่องหมาย " เครื่องหมาย ' เป็นต้น เพื่อให้ได้คำสั่ง sql ที่ปลอดภัยสำหรับการ query

//echo "<pre>";
//print_r(implode(",",$_POST["monitor_ck"]));
//echo "</pre>";
//exit(); 
$mnt = array();
$mnt = $_POST['monitor_ck'];

$tls = array();
$tls = $_POST['tools_ck'];

$id_data = mysqli_real_escape_string($conn,$_POST["id_data"]);
$os = mysqli_real_escape_string($conn,$_POST["os"]);
$status = mysqli_real_escape_string($conn,$_POST["status"]);
$enddate = mysqli_real_escape_string($conn,$_POST["enddate"]);

foreach($tls as $input_tls => $tools){
  $tools ;

}

$dashboard = mysqli_real_escape_string($conn,$_POST["dashboard"]);
$installdate = mysqli_real_escape_string($conn,$_POST["installdate"]);
$updatedate = mysqli_real_escape_string($conn,$_POST["updatedate"]);
$service = mysqli_real_escape_string($conn,$_POST["service"]);

foreach($mnt as $input_mnt => $mnt_input){
  $mnt_input ;

}
   
$emailalertto = mysqli_real_escape_string($conn,$_POST["emailalertto"]);
$enddate = mysqli_real_escape_string($conn,$_POST["enddate"]);
$remark = mysqli_real_escape_string($conn,$_POST["remark"]);
$serviceowner = mysqli_real_escape_string($conn,$_POST["serviceowner"]);
$contactpoint = mysqli_real_escape_string($conn,$_POST["contactpoint"]);
$potno = mysqli_real_escape_string($conn,$_POST["potno"]);
$jobcode = mysqli_real_escape_string($conn,$_POST["jobcode"]);
$nameproduct = mysqli_real_escape_string($conn,$_POST["nameproduct"]);
$appsubportteam = mysqli_real_escape_string($conn,$_POST["appsubportteam"]);
$supportsubteam = mysqli_real_escape_string($conn,$_POST["supportsubteam"]);
$pdpa = mysqli_real_escape_string($conn,$_POST["pdpa"]);
$critical = mysqli_real_escape_string($conn,$_POST["critical"]);
$versionproduct = mysqli_real_escape_string($conn,$_POST["versionproduct"]);
$venderproduct = mysqli_real_escape_string($conn,$_POST["venderproduct"]); 



$sql_edit_data ="UPDATE  data_bsm_esm SET    
    os ='$os', 
    status ='$status', 
    enddate = '$enddate',
    tools = '$tools',
    dashboard = '$dashboard',
    installdate = '$installdate',
    updatedate = '$updatedate',
    service = '$service' ,
    monitor = '$mnt_input',
    emailalertto = '$emailalertto',
    remark = '$remark' ,
    serviceowner = '$serviceowner' ,
    contactpoint = '$contactpoint' ,
    potno = '$potno' ,
    jobcode = '$jobcode' ,
    nameproduct = '$nameproduct',
    appsubportteam = '$appsubportteam',
    supportsubteam = '$supportsubteam' ,
    pdpa = '$pdpa', 
    critical = '$critical',
    versionproduct = '$versionproduct',
    venderproduct = '$venderproduct'
    WHERE id_data ='$id_data' "; 

$result_edit_data = mysqli_query($conn,$sql_edit_data) ;

mysqli_close($conn); 
//echo $sql_add_data;

	// javascript แสดงการ upload file
	if($result_edit_data){
        echo "<script type='text/javascript'>";
        echo "alert('Edit Successful');";
        echo "window.location = 'bsm_esm.php'; ";
        echo "</script>";
        }
        else{
        echo "<script type='text/javascript'>";
        echo "alert('Edit Failed');";
        echo "window.history.back() = 'bsm_esm.php'; ";
        echo "</script>";
      }
 


   
?>
  