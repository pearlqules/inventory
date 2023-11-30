<?php
include('../../config/connect.php');
include('../h.php');

date_default_timezone_set('Asia/Bangkok');
$date = date("Ymd");	 

$sql_company =" SELECT * FROM company ";
$result_company = mysqli_query($conn,$sql_company);

$sql_tools =" SELECT * FROM tools ";
$result_tools = mysqli_query($conn,$sql_tools);

$tools_ck = array();
for($t=0; $t< mysqli_num_rows($result_tools); ++$t ){ //นับว่ามีกี่ค่า 
    $tools_ck[]=''; //แล้วเก็บค่าใน [array] เป็นค่าว่าง   
}

$sql_service =" SELECT * FROM service ";
$result_service = mysqli_query($conn,$sql_service);

$sql_monitor =" SELECT * FROM monitor ";
$result_monitor = mysqli_query($conn,$sql_monitor);

$monitor_ck = array(); //บอกว่า array() is array เก็บค่าmonitor
for($i=0; $i< mysqli_num_rows($result_monitor); ++$i ){ //นับว่ามีกี่ค่า 
    $monitor_ck[]=''; //แล้วเก็บค่าใน [array] เป็นค่าว่าง   
}

$sql_data="SELECT id_data  FROM data_bsm_esm ORDER BY id_data DESC";
$result_data = mysqli_query($conn,$sql_data);
$row_data=mysqli_fetch_array($result_data);

$id_dt =  $row_data['id_data'] ;
$id_dt1 = $id_dt + 1;
  

?>
<style>
    body{ 
        background-image: url("../../img/hero-banner-img-01@2x.jpg");
        background-repeat: no-repeat;
        background-size:  1600px 900px; 
        padding-top: 40px;
}
form{
    height:400px;
    overflow-y:auto;
}
.text_list{
    color: #ffffff;
}
</style>
<div class="container">
<div class="col-md-12">
<div class="topnav">

    <div class="row ">
        <img src="../../img/logopttdigital.png" align="left" height="70" width="200">
    </div>
    <h5><a class="active" href="../">
            <font color="#ff621e">Home</font>
        </a>
        <a><font color="#ffffff">/</font></a>
        <a href="bsm_esm.php">
            <font color="#ff621e">BSM&ESM</font>
        </a>
        <a><font color="#ffffff">/</font></a>
        <a>
            <font color="#707070">Insert Data</font>
        </a>
    </h5>

</div>
<br><br>

<h3 class="text-center text_list"><b>Fill In</b></h3>
<br>
    <form action="bsm_esm_insert_db.php"  method="post" enctype="multipart/form-data">  
    <!--กรณีใส่รูปใช้ enctype="multipart/form-data"-->
    <!-- class="form-control  col-8 mr-3 mt-3 mb-3" -->
    <div class="form-inline">
         </div>
         <div class="form-inline">
            <input type="text" name="id_data" value="<?php echo $id_dt1;?> " class="form-control" 
             pattern="{5}" readonly>
         </div>
        <br>    
        <div class="text_list">
            <label>Company *</label>
            <select name="company" class="form-control" required>
                <?php foreach($result_company as $resultc){?>
                    <option value="" disabled selected hidden>-- Choose Company --</option>
              <option value="<?php echo $resultc["company_name"];?>">
                <?php echo $resultc["company_name"]; ?>
              </option>
              <?php } ?>
            </select>
        </div> 
        <br> 
        <div class="text_list">
            <label>System Name *</label>
            <input type="text" name="systemname" class="form-control"  class="form-control" required>
        </div>
        <br>
        <div class="text_list">
            <label>Server Name *</label>
            <input type="text" name="servername" class="form-control" required>
        </div>
        <br>
        <div class="text_list">
            <label>IP *</label>
            <input type="text" name="ip" class="form-control" required>
        </div>
        <br>
        <div class="text_list">
            <label>OS</label>
            <input type="text" name="os" class="form-control"  >
        </div>
        <br>
        <div class="text_list">
            <label>Status *</label> 
            <input name="status" type="radio" value="active" class="mx-2 mb-2" onclick="stt(this);" CHECKED > Active &nbsp;  
            <input name="status" type="radio" value="inactive" onclick="stt(this);">  &nbsp; Inactive    
        </div>
        <script type="text/javascript">
            function stt(myRadio) {
                if(myRadio.value == "true")
                {
                document.getElementById("date_radio").disabled = false  ;
                }
                else
                {
                document.getElementById("date_radio").disabled = true;
                }
            }
            </script>
        <br>
        <div class="text_list"> 
            <label>End Date</label>
            <input type="date" name="enddate" class="form-control" id="date_radio">
        </div>
        <br>
        <div class="text_list">
            <label>Tools *</label> 
            <?php $whm=0; while($row_tools = mysqli_fetch_assoc($result_tools)) {  ?> 
                <input type="checkbox" class="selecttools"  onclick='chm()' 
                name="tools_ck[<?php echo $whm; ?>]" value="<?php echo $row_tools["tools_name"] ;?>"> 
                <label> <?php echo $row_tools["tools_name"]; ?> &nbsp;&nbsp;&nbsp; </label>
            <?php   ++$whm;  } ?>

            <script>
                onclick = 'chm()'

                function chm() {
                let box = 0;
                for (f of document.getElementsByClassName("selecttools")) {

                if (f.checked) {
                box++;
                }
                }
                }
            </script>
        </div>
        <br>
        <div class="text_list">
            <label>Service *</label>
            <select name="service" class="form-control" required>
                <?php foreach($result_service as $results){?>
                    <option value="" disabled selected hidden>-- Choose Service --</option>
              <option value="<?php echo $results["service_name"];?>">
                <?php echo $results["service_name"]; ?>
              </option>
              <?php } ?>
            </select>
        </div>
        <br>
        <div class="text_list">
            <label>Dashboard</label>
            <input name="dashboard" type="radio" value="Yes" class="mx-2 mb-2">Yes  &nbsp; 
            <input name="dashboard" type="radio" value="No" CHECKED>  &nbsp;   No  
        </div>
        <br>
        <div class="text_list">
            <label>Install Date *</label>
            <input type="date" name="installdate" class="form-control" value="<?php echo date('Y-m-d');?>" required>
        </div>
        <br>
        <div class="text_list">
            <label>Update Date *</label>
            <input type="date" name="updatedate" class="form-control" value="<?php echo date('Y-m-d');?>"  required>
        </div>
        <br>
        <div class="text_list">
            <label>Monitor*</label>&nbsp;&nbsp;&nbsp;&nbsp;
            <?php $wh=0; while($row_monitor = mysqli_fetch_assoc($result_monitor)) {  ?> 
                <input type="checkbox" class="selectmonitor"  onclick='ch()' 
                name="monitor_ck[<?php echo $wh; ?>]" value="<?php echo $row_monitor["monitor_name"] ;?>"> 
                <label> <?php echo $row_monitor["monitor_name"]; ?> &nbsp;&nbsp;&nbsp; </label>
            <?php   ++$wh;  } ?>

            <script>
                onclick = 'ch()'

                function ch() {
                let box = 0;
                for (f of document.getElementsByClassName("selectmonitor")) {

                if (f.checked) {
                box++;
                }
                /*if (box >= 4) {
                for (a of document.getElementsByClassName("selectmonitor")) {
                if (!a.checked) {
                a.disabled = true;
                }
                }
                } else {
                for (a of document.getElementsByClassName("selectmonitor")) {
                a.disabled = false;
                }
                }*/
                }
                }
            </script>
                
        </div>
        <br>
        <div class="text_list">
            <label>e-mail to</label>
            <input type="text" name="emailalertto" class="form-control"  >
        </div>
        <br>
        <div class="text_list">
            <label>Remark</label>
            <input type="text" name="remark" class="form-control"  >
        </div>
        <br>
        <div class="text_list">
            <label>Service Owner</label>
            <input type="text" name="serviceowner" class="form-control"  >
        </div>
        <br>
        <div class="text_list">
            <label>Contact Point</label>
            <input type="text" name="contactpoint" class="form-control"  >
        </div>
        <br>
        <div class="text_list">
            <label>Pot no.</label>
            <input type="text" name="potno" class="form-control"  >
        </div>
        <br>
        <div class="text_list">
            <label>Job Code</label>
            <input type="text" name="jobcode" class="form-control"  >
        </div>
        <br>
        <div class="text_list">
            <label>Product Name </label>
            <input type="text" name="nameproduct" class="form-control"  >
        </div>
        <br>
        <div class="text_list">
            <label>App Support Team</label>
            <input type="text" name="appsubportteam" class="form-control"  >
        </div>
        <br>
        <div class="text_list">
            <label>Support Subteam</label>
            <input type="text" name="supportsubteam" class="form-control"  >
        </div>
        <br>
        <div class="text_list">
            <label>PDPA</label> 
            <input name="pdpa" type="radio" value="yes" class="mx-2 mb-2">    Yes &nbsp;  
            <input name="pdpa" type="radio" value="no" CHECKED>  &nbsp; No       
        </div>
        <br>
        <div class="text_list">
            <label>Critical</label> 
            <input name="critical" type="radio" value="yes" class="mx-2 mb-2">   Yes &nbsp;  
            <input name="critical" type="radio" value="no" CHECKED>  &nbsp; No      
        </div>
        <br>
        <div class="text_list">
            <label>Version Product</label>
            <input type="text" name="versionproduct" class="form-control"  >
        </div>
        <br>
        <div class="text_list">
            <label>Vender Product </label>
            <input type="text" name="venderproduct" class="form-control"  >
        </div>
        <br>
        <input type="submit" value="Save" name="save_data" class=" btn btn-primary">
        <input type="reset" value="Reset" class=" btn btn-danger">

    </form>
    <br>
    <br>
</div>
</div>

 
