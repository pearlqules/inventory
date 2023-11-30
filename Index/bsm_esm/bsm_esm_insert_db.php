<?php 
include('../../config/connect.php'); 
include('../h.php');

date_default_timezone_set('Asia/Bangkok');
$date = date("Ymd");	 
//เป็นฟังก์ชันสำหรับเลี่ยงการใช้ตัวอักขระพิเศษในคำสั่ง sql เช่น เครื่องหมาย " เครื่องหมาย ' เป็นต้น เพื่อให้ได้คำสั่ง sql ที่ปลอดภัยสำหรับการ query
 
//echo "<pre>";
//print_r(implode(",",$_POST["monitor_ck"]));
//echo "</pre>";
//exit();  

$id_data = mysqli_real_escape_string($conn,$_POST["id_data"]);//เราส่งมาเป็น ทethod post ก็ต้องpost
//$detail2 = $post['detail2']; 	จะเขียนแบบนี้ก็ได้ แต่อันบนไว้สำหรับตัวขนชระพิเศษรองรับ
$company = mysqli_real_escape_string($conn,$_POST["company"]);
$systemname = mysqli_real_escape_string($conn,$_POST["systemname"]);
$servername = mysqli_real_escape_string($conn,$_POST["servername"]);
$ip = mysqli_real_escape_string($conn,$_POST["ip"]);
$os = mysqli_real_escape_string($conn,$_POST["os"]);
$status = mysqli_real_escape_string($conn,$_POST["status"]);
$enddate = mysqli_real_escape_string($conn,$_POST["enddate"]);

$tools_ck = $_POST['tools_ck']; 
$tools = implode(",",$tools_ck);

$dashboard = mysqli_real_escape_string($conn,$_POST["dashboard"]);
$installdate = mysqli_real_escape_string($conn,$_POST["installdate"]);
$updatedate = mysqli_real_escape_string($conn,$_POST["updatedate"]);
$service = mysqli_real_escape_string($conn,$_POST["service"]);

$monitor_ck = $_POST['monitor_ck']; //รับมาเฉยๆ
$monitor = implode(",",$monitor_ck);
/*$mnt = $_POST["monitor_ck"]; 
$monitor = implode(",",$mnt);
$monitor = implode(",",$_POST["monitor_ck"]);*/
//echo $monitor;  

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

$sql_data_check = "SELECT systemname,servername,ip FROM data_bsm_esm 
                  WHERE (systemname = '$systemname') and (servername = '$servername') and (ip = '$ip')";
$result_data_check = mysqli_query($conn,$sql_data_check);
$count = mysqli_num_rows($result_data_check);

   if($count >0){
      echo "<script>";
      echo "alert('Server Name,Service Name and ip is Duplicate');";
      echo "window.history.back();";
      echo "</script>";
   }else{
   $sql_add_data ="INSERT INTO data_bsm_esm(`id_data`, `company`, `systemname`, `servername`, `ip`, `os`, `status`, 
   `enddate`, `tools`, `dashboard`, `installdate`, `updatedate`, `service`, `monitor`, `emailalertto`, `remark`, 
   `serviceowner`, `contactpoint`, `potno`, `jobcode`, `nameproduct`, `appsubportteam`, `supportsubteam`, `pdpa`, 
   `critical`, `versionproduct`, `venderproduct`) 
   VALUES('$id_data', '$company', '$systemname', '$servername', '$ip', '$os', '$status', '$enddate', '$tools', '$dashboard', 
   '$installdate', '$updatedate', '$service', '$monitor', '$emailalertto', '$remark', '$serviceowner', '$contactpoint', 
   '$potno', '$jobcode', '$nameproduct', '$appsubportteam', '$supportsubteam', '$pdpa', '$critical', '$versionproduct', 
   '$venderproduct')";
   //echo $sql_add_data;
   $result_add_data = mysqli_query($conn,$sql_add_data)or die ("Error in query: $sql_add_data" . mysqli_error());
   }
   //echo $sql_add_data;
	// javascript แสดงการ upload file
	/*if($result_add_data){
        echo "script type='text/javascript'>";
        echo "alert('Insert Successful');";
        echo "window.location = 'bsm_esm_insert.php'; ";
        echo "/script>";
        }
        else{
        echo "script type='text/javascript'>";
        echo "alert('Insert Failed');";
        echo "window.history.back() = 'bsm_esm_insert.php'; ";
        echo "/script>";
      }*/

$sql_email = "SELECT * FROM data_bsm_esm WHERE id_data='$id_data'";
$result_email = mysqli_query($conn,$sql_email);
$row_email = mysqli_fetch_array($result_email);

 //Include required PHPMailer files
 require 'includes/PHPMailer.php';
 require 'includes/SMTP.php';
 require 'includes/Exception.php';
//Define name spaces
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;
//Create instance of PHPMailer
 $mail = new PHPMailer();
//Set mailer to use smtp
 $mail->isSMTP();
//Define smtp host
 $mail->Host = "smtp.gmail.com";
//Enable smtp authentication
 $mail->SMTPAuth = true;
//Set smtp encryption type (ssl/tls)
 $mail->SMTPSecure = "tls";
//Port to connect smtp
 $mail->Port = "587";
//Set gmail username
 $mail->Username = "ttgds.vkm@gmail.com"; //Your Gmail Email Address Here
//Set gmail password
 $mail->Password = "yebwqchofkpmvliq"; //Your Gmail Password Here
//Email subject
 $mail->Subject = "[New]Inventory BSM&ESM"; //Test email using PHPMailer
//Set sender email
 $mail->setFrom('ttgds.vkm@gmail.com'); //Sender Email who will send email
//Enable HTML
 $mail->isHTML(true);
//Attachment
 // $mail->addAttachment('img/attachment.png');
//Email body
 $mail->Body = "<h3> New Inventory BSM&ESM No. $row_email[id_data] </h3></br>
 <p> Have a new data of BSM&ESM detail as below <br>
 Company: $row_email[company] <br>
 System Name: $row_email[systemname] <br>
 Server Name: $row_email[servername] <br>
 IP: $row_email[ip] <br>
 OS: $row_email[os] <br>
 Status: $row_email[status] <br>
 End Date: $row_email[enddate] <br>
 Tools: $row_email[tools] <br>
 Service: $row_email[service] <br>
 Install Date: $row_email[installdate] <br>
 Update Date: $row_email[updatedate] <br>
 Monitor:$row_email[monitor] <br>
 Remark:$row_email[remark] <br>
 <br>
 The amount of BSM&ESM is $row_email[id_data] <br> Best regards </p> ";
//Add recipient
 $mail->addAddress('zsirapat.k@pttdigital.com','zprachayaporn.p@pttdigital.com'); //Email of the person who will receive email
//Finally send email
 if ( $mail->send() ) {
    echo "<script type='text/javascript'>";
      echo "alert('The information you added has been send email to the relevant person.');";
      echo "window.location = 'bsm_esm_insert.php'; ";
      echo "</script>"; 
      // echo "ส่งสำเร็จ";
 }else{
      echo "<script type='text/javascript'>";
      echo "alert('Failed'{$mail->ErrorInfo});";
      echo "window.history.back() = 'bsm_esm_insert.php'; ";
      echo "</script>";
    //echo "ส่งไม่สำเร็จ: "{$mail->ErrorInfo};
 }
//Closing smtp connection
 $mail->smtpClose();
?>
  