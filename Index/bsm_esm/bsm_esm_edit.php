<?php   

$id_data = $_REQUEST["ID"]; 

include('../../config/connect.php'); 
include('../h.php');

 

$sql_company = "SELECT * FROM company";
$result_company = mysqli_query($conn,$sql_company);

$sql_tools = "SELECT * FROM tools";
$result_tools = mysqli_query($conn,$sql_tools);

$tools_ck = array(); //บอกว่า array() is array เก็บค่าmonitor
for($m=0; $m< mysqli_num_rows($result_tools); ++$m ){ //นับว่ามีกี่ค่า 
    $tools_ck[]=''; //แล้วเก็บค่าใน [array] เป็นค่าว่าง   
}

$sql_service = "SELECT * FROM service";
$result_service = mysqli_query($conn,$sql_service);

$sql_monitor = "SELECT * FROM monitor";
$result_monitor = mysqli_query($conn,$sql_monitor);

$monitor_ck = array(); //บอกว่า array() is array เก็บค่าmonitor
for($i=0; $i< mysqli_num_rows($result_monitor); ++$i ){ //นับว่ามีกี่ค่า 
    $monitor_ck[]=''; //แล้วเก็บค่าใน [array] เป็นค่าว่าง   
}

$sql_data_bsm_esm="SELECT * FROM data_bsm_esm WHERE id_data = '$id_data'";
$result_data_bsm_esm =mysqli_query($conn, $sql_data_bsm_esm);
while ($row_data_bsm_esm = mysqli_fetch_array($result_data_bsm_esm)) { 
    $mnt_ck = explode(",",$row_data_bsm_esm['monitor']);
    $tls_ck = explode(",",$row_data_bsm_esm['tools']);
?>
<style>
    body{ 
        background-image: url("../../img/hero-banner-img-01@2x.jpg");
        background-repeat: no-repeat;
        background-size:  1600px 720px; 
        padding-top: 40px;
}
form{
    height:400px;
    overflow-y:auto;
}
.text_list{
    color: #ffffff;
}
.align_bt{
    float:right;
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
            <font color="#707070">Edit Data</font>
        </a>
    </h5>

</div>
<br><br>


<h3 class="text-center text_list"><b>Edit Data</b></h3>
<br>
    <form action="bsm_esm_edit_db.php"  method="post" enctype="multipart/form-data">  
    <!--กรณีใส่รูปใช้ enctype="multipart/form-data"-->
    <!-- class="form-control  col-8 mr-3 mt-3 mb-3" --> 
        <br>
        <div class="form-inline">
            <input type="text" name="id_data" value="<?php echo $id_data;?> " class="form-control" 
             pattern="{5}"  readonly>
         </div>
        <br>    
        <div class="text_list">
        <label for="">Company</label>
        <input type="text" name="company" class="form-control" 
            value="<?php echo $row_data_bsm_esm['company'];?>" readonly>
        <!--
            <select name="id_resort" class="form-control" value="<?php  echo $row_data_bsm_esm['company']; ?>"  >  
                readonly<?php foreach($result_company as $results){?>  
                 <option value="<?php echo $results["company_name"];?>">
                <?php echo $results["company_name"]; ?> 
                </option>
                <?php } ?>
            </select> -->
        </div> 
        <br> 
        <div class="text_list">
            <label for="">Systemname</label>
            <input type="text" name="systemname" class="form-control"  class="form-control" 
            value="<?php echo $row_data_bsm_esm['systemname'];?>" readonly>
        </div>
        <br>
        <div class="text_list">
            <label for="">Servername</label>
            <input type="text" name="servername" class="form-control" 
            value="<?php echo $row_data_bsm_esm['servername'];?>"readonly>
        </div>
        <br>
        <div class="text_list">
            <label for="">IP</label>
            <input type="text" name="ip" class="form-control" 
            value="<?php echo $row_data_bsm_esm['ip'];?>" readonly>
        </div>
        <br>
        <div class="text_list">
            <label for="">OS</label>
            <input type="text" name="os" value="<?php echo $row_data_bsm_esm['os'];?>" class="form-control"  >
        </div>
        <br>
        <div class="text_list">
            <label for="">Status</label> &nbsp;&nbsp;
            <?php
                if($row_data_bsm_esm["status"] == "active"){
                    echo "<input type='radio' name='status' value='active' checked > Active &nbsp; ";
                    echo "<input type='radio' name='status' value='inactive'>&nbsp; Inactive";
                   
                }else{ 
                    echo "<input type='radio' name='status' value='active'>Active  &nbsp; ";
                    echo "<input type='radio' name='status' value='inactive' checked>&nbsp; Inactive";
                }
            ?>    
        </div>
        <br>
        <div class="text_list">
            <label for="">End Date</label>
            <input type="date" name="enddate" value="<?php echo $row_data_bsm_esm['enddate'];?>"  class="form-control"  >
        </div>
        <br>
        <div class="text_list" > 
            <label for="">Tools *</label>
            <?php  $whm=0; while($row_tools = mysqli_fetch_assoc($result_tools)) {  ?> 
                <input type="checkbox" class="selecttools"  onclick='chm()' name="tools_ck[<?php echo $whm; ?>]" 
                value="<?php echo $row_tools["tools_name"] ;?>"
                <?php if(in_array($row_tools["tools_name"],$tls_ck)) {echo "checked"; }?> >  
                <label> 
                <?php echo $row_tools["tools_name"] ;  ?> &nbsp;&nbsp;&nbsp; 
                 </label>
                
            <?php   ++$whm;  } ?>

            <script>
                onclick = 'chm()'

                function chm() {
                let box = 0;
                for (f of document.getElementsByClassName("selecttools")) {

                if (f.checked) {
                box++;
                }

                /*if (box >= 3) {
                for (a of document.getElementsByClassName("selecttools")) {
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
            <label for="">Service</label>
            <select name="service" class="form-control" > <!--อ้างถึงรหัส-->
                <option>  <?php  echo $row_data_bsm_esm['service']; ?> </option>
                <?php foreach($result_service as $r_service){?> <!--as is new name-->
                <option value="<?php  echo $r_service['service_name']; ?>" >
                <?php echo $r_service["service_name"]; ?> <!--ประกาศค่าที่ต้องการแสงดว่าอยู่ในคอลัมไหน-->
                </option>
                <?php } ?>
            </select> 
        </div>
        <br>
        <div class="text_list">
            <label for="">Dashboard</label> &nbsp;&nbsp;
            <?php
                if($row_data_bsm_esm["dashboard"] == "yes"){
                    echo "<input type='radio' name='dashboard' value='yes' checked > Yes &nbsp; ";
                    echo "<input type='radio' name='dashboard' value='no'>&nbsp; No";
                   
                }else{ 
                    echo "<input type='radio' name='dashboard' value='yes'>Yes  &nbsp; ";
                    echo "<input type='radio' name='dashboard' value='no' checked>&nbsp; No";
                }
            ?>    
        </div>
        <br>
        <div class="text_list">
            <label for="">Install Date</label>
            <input type="date" name="installdate" value="<?php echo $row_data_bsm_esm['installdate'];?>"  class="form-control"  >
        </div>
        <br>
        <div class="text_list">
            <label for="">Update Date</label>
            <input type="date" name="updatedate" value="<?php echo $row_data_bsm_esm['updatedate'];?>" class="form-control"  >
        </div>
        <br>
        <div class="text_list">
        <label for="">Monitor*</label>&nbsp;&nbsp;&nbsp;&nbsp;
            <?php  $wh=0; while($row_monitor = mysqli_fetch_assoc($result_monitor)) {  ?> 
                <input type="checkbox" class="selectmonitor"  onclick='ch()' name="monitor_ck[<?php echo $wh; ?>]" 
                value="<?php echo $row_monitor["monitor_name"] ;?>"
                <?php if(in_array($row_monitor["monitor_name"],$mnt_ck)) {echo "checked"; }?> >  
                <label> 
                <?php echo $row_monitor["monitor_name"] ;  ?> &nbsp;&nbsp;&nbsp; 
                 </label>
                
            <?php   ++$wh;  } ?>

            <script>
                onclick = 'ch()'

                function ch() {
                let box = 0;
                for (f of document.getElementsByClassName("selectmonitor")) {

                if (f.checked) {
                box++;
                }

                /*if (box >= 3) {
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
            <label for="">e-mail To</label>
            <input type="text" name="emailalertto" value="<?php echo $row_data_bsm_esm['emailalertto'];?>"  class="form-control"  >
        </div>
        <br>
        <div class="text_list">
            <label for="">Remark</label>
            <input type="text" name="remark" value="<?php echo $row_data_bsm_esm['remark'];?>" class="form-control"  >
        </div>
        <br>
        <div class="text_list">
            <label for="">Service Owner</label>
            <input type="text" name="serviceowner" value="<?php echo $row_data_bsm_esm['serviceowner'];?>" class="form-control"  >
        </div>
        <br>
        <div class="text_list">
            <label for="">Contact Point</label>
            <input type="text" name="contactpoint" value="<?php echo $row_data_bsm_esm['contactpoint'];?>" class="form-control"  >
        </div>
        <br>
        <div class="text_list">
            <label for="">Pot no.</label>
            <input type="text" name="potno" class="form-control" value="<?php echo $row_data_bsm_esm['potno'];?>" >
        </div>
        <br>
        <div class="text_list">
            <label for="">Job Code</label>
            <input type="text" name="jobcode" value="<?php echo $row_data_bsm_esm['jobcode'];?>" class="form-control"  >
        </div>
        <br>
        <div class="text_list">
            <label for="">Product Name </label>
            <input type="text" name="nameproduct" value="<?php echo $row_data_bsm_esm['nameproduct'];?>" class="form-control"  >
        </div>
        <br>
        <div class="text_list">
            <label for="">App Subport Team</label>
            <input type="text" name="appsubportteam" value="<?php echo $row_data_bsm_esm['appsubportteam'];?>" class="form-control"  >
        </div>
        <br>
        <div class="text_list">
            <label for="">Support Supteam</label>
            <input type="text" name="supportsubteam" value="<?php echo $row_data_bsm_esm['supportsubteam'];?>" class="form-control"  >
        </div>
        <br>
        <div class="text_list">
        <label for="">PDPA</label> &nbsp;&nbsp;&nbsp;&nbsp;
        <?php
                if($row_data_bsm_esm["pdpa"] == "yes"){
                    echo "<input type='radio' name='pdpa' value='yes' checked> &nbsp; Yes ";
                    echo "<input type='radio' name='pdpa' value='no'>&nbsp; No";
                   
                }else{ 
                    echo "<input type='radio' name='pdpa' value='yes'>Yes&nbsp; ";
                    echo "<input type='radio' name='pdpa' value='no' checked>&nbsp; No";
                }
        ?> 
        </div> 
        <br>
        <div class="text_list">
            <label for="">Critical</label> &nbsp;&nbsp;
            <?php
                if($row_data_bsm_esm["critical"] == "yes"){
                    echo "<input type='radio' name='critical' value='yes' checked > Yes &nbsp; ";
                    echo "<input type='radio' name='critical' value='no'>&nbsp; No";
                   
                }else{ 
                    echo "<input type='radio' name='critical' value='yes'>Yes  &nbsp; ";
                    echo "<input type='radio' name='critical' value='no' checked>&nbsp; No";
                }
            ?>    
        </div>
        <br>
        <div class="text_list">
            <label for="">Version Product</label>
            <input type="text" name="versionproduct" value="<?php echo $row_data_bsm_esm['versionproduct'];?>" class="form-control"  >
        </div>
        <br>
        <div class="text_list">
            <label for="">Vender Product </label>
            <input type="text" name="venderproduct" value="<?php echo $row_data_bsm_esm['venderproduct'];?>" class="form-control"  >
        </div>
        <br>
        <input type="submit" value="Save" class=" btn btn-primary ">
    </form>
<?php } ?>

    <br>
    <br>
    </div>
</div>
