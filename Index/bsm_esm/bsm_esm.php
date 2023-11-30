<?php
include('../../config/connect.php');
include('../h.php');

$sql_company = "SELECT * FROM company ";
$query_company = mysqli_query($conn,$sql_company) or die("Unable to connect to $sql_company"); 
//$query_company= mysqli_fetch_array($query);

while($cn = mysqli_fetch_object($query_company)){ //จะรีเทินแถวปัจจุบันของผลลัพธ์ออกมาเป็นอ๊อบเจ็ก
    //echo json_encode($t);
    $company_name[] = $cn->company_name; //เป็นการ point เวลาเราสร้าง object ขึ้นมา แล้วจะเรียกเมธอดข้างในก็จะใช้ ->

}

$sql_service = "SELECT * FROM service ";
$query_service = mysqli_query($conn,$sql_service) or die("Unable to connect to $sql_service");  

while($sn = mysqli_fetch_object($query_service)){ //จะรีเทินแถวปัจจุบันของผลลัพธ์ออกมาเป็นอ๊อบเจ็ก
    //echo json_encode($t);
    $service_name[] = $sn->service_name; //เป็นการ point เวลาเราสร้าง object ขึ้นมา แล้วจะเรียกเมธอดข้างในก็จะใช้ ->

}


$sql_monitor = "SELECT * FROM monitor ";
$query_monitor = mysqli_query($conn,$sql_monitor) or die("Unable to connect to $sql_monitor");  
while($mt = mysqli_fetch_object($query_monitor)){ //จะรีเทินแถวปัจจุบันของผลลัพธ์ออกมาเป็นอ๊อบเจ็ก
    //echo json_encode($t);
    $monitor_name[] = $mt->monitor_name; //เป็นการ point เวลาเราสร้าง object ขึ้นมา แล้วจะเรียกเมธอดข้างในก็จะใช้ ->

} 
$com_name=array(); 
$count=1;
?>  

<!DOCTYPE html>
<html lang="en">
<head>   
    <title>BSM&ESM</title>
</head>

<body>

<style>
body{ 
    background-image: url("../../img/img-03.png");
    background-repeat: no-repeat;
    background-size:  1600px 720px; 
    padding-top: 40px;
    background-attachment:fixed; 
}
.table_border {
    border: 2px solid;
    background: #ffffff;
    color: #707070;  
}
table {
    width: 100%; 
    border-spacing: 2; 
    border-collapse: collapse;
    border: 1px solid;   
}
.head {
    background-color: #f9ffff;
    color: #707070;
    font-size: 12px;
    text-align: left;
    vertical-align: text-top;
}
tr {
    border: 1px silver;
    text-align: left top;
    font-size: 11px; 
} 
th {
    column-width: 120px; 
}
.bd_bg{   
    padding-top: 1px; 
    padding-bottom: 1px; 
    padding-left: 3%;
}
.dropdown_list {
    width: 110px;
    border: none;
    border-bottom: 2px solid red;
    font-size: 13px;
} 
.data_table .btn{
    padding: 5px 10px;
    margin: 10px 3px 10px 0;
}   
/*
 * This combined file was created by the DataTables downloader builder:
 *   https://datatables.net/download
 *
 * To rebuild or modify this file with the latest versions of the included
 * software please visit:
 *   https://datatables.net/download/#bs5/jszip-2.5.0/dt-1.11.5/b-2.2.2/b-html5-2.2.2/b-print-2.2.2
 *
 * Included libraries:
 *  JSZip 2.5.0, DataTables 1.11.5, Buttons 2.2.2, HTML5 export 2.2.2, Print view 2.2.2
 */

 table.dataTable th.dt-left,table.dataTable td.dt-left{text-align:left}table.dataTable th.dt-center,table.dataTable td.dt-center,table.dataTable td.dataTables_empty{text-align:center}table.dataTable th.dt-right,table.dataTable td.dt-right{text-align:right}table.dataTable th.dt-justify,table.dataTable td.dt-justify{text-align:justify}table.dataTable th.dt-nowrap,table.dataTable td.dt-nowrap{white-space:nowrap}table.dataTable thead th.dt-head-left,table.dataTable thead td.dt-head-left,table.dataTable tfoot th.dt-head-left,table.dataTable tfoot td.dt-head-left{text-align:left}table.dataTable thead th.dt-head-center,table.dataTable thead td.dt-head-center,table.dataTable tfoot th.dt-head-center,table.dataTable tfoot td.dt-head-center{text-align:center}table.dataTable thead th.dt-head-right,table.dataTable thead td.dt-head-right,table.dataTable tfoot th.dt-head-right,table.dataTable tfoot td.dt-head-right{text-align:right}table.dataTable thead th.dt-head-justify,table.dataTable thead td.dt-head-justify,table.dataTable tfoot th.dt-head-justify,table.dataTable tfoot td.dt-head-justify{text-align:justify}table.dataTable thead th.dt-head-nowrap,table.dataTable thead td.dt-head-nowrap,table.dataTable tfoot th.dt-head-nowrap,table.dataTable tfoot td.dt-head-nowrap{white-space:nowrap}table.dataTable tbody th.dt-body-left,table.dataTable tbody td.dt-body-left{text-align:left}table.dataTable tbody th.dt-body-center,table.dataTable tbody td.dt-body-center{text-align:center}table.dataTable tbody th.dt-body-right,table.dataTable tbody td.dt-body-right{text-align:right}table.dataTable tbody th.dt-body-justify,table.dataTable tbody td.dt-body-justify{text-align:justify}table.dataTable tbody th.dt-body-nowrap,table.dataTable tbody td.dt-body-nowrap{white-space:nowrap}table.dataTable td.dt-control{text-align:center;cursor:pointer}table.dataTable td.dt-control:before{height:1em;width:1em;margin-top:-9px;display:inline-block;color:white;border:.15em solid white;border-radius:1em;box-shadow:0 0 .2em #444;box-sizing:content-box;text-align:center;text-indent:0 !important;font-family:"Courier New",Courier,monospace;line-height:1em;content:"+";background-color:#31b131}table.dataTable tr.dt-hasChild td.dt-control:before{content:"-";background-color:#d33333}/*! Bootstrap 5 integration for DataTables
 *
 * ©2020 SpryMedia Ltd, all rights reserved.
 * License: MIT datatables.net/license/mit
 */table.dataTable{clear:both;margin-top:6px !important;margin-bottom:6px !important;max-width:none !important;border-collapse:separate !important;border-spacing:0}table.dataTable td,table.dataTable th{-webkit-box-sizing:content-box;box-sizing:content-box}table.dataTable td.dataTables_empty,table.dataTable th.dataTables_empty{text-align:center}table.dataTable.nowrap th,table.dataTable.nowrap td{white-space:nowrap}div.dataTables_wrapper div.dataTables_length label{font-weight:normal;text-align:left;white-space:nowrap}div.dataTables_wrapper div.dataTables_length select{width:auto;display:inline-block}div.dataTables_wrapper div.dataTables_filter{text-align:right}div.dataTables_wrapper div.dataTables_filter label{font-weight:normal;white-space:nowrap;text-align:left}div.dataTables_wrapper div.dataTables_filter input{margin-left:.5em;display:inline-block;width:auto}div.dataTables_wrapper div.dataTables_info{padding-top:.85em}div.dataTables_wrapper div.dataTables_paginate{margin:0;white-space:nowrap;text-align:right}div.dataTables_wrapper div.dataTables_paginate ul.pagination{margin:2px 0;white-space:nowrap;justify-content:flex-end}div.dataTables_wrapper div.dataTables_processing{position:absolute;top:50%;left:50%;width:200px;margin-left:-100px;margin-top:-26px;text-align:center;padding:1em 0}table.dataTable>thead>tr>th:active,table.dataTable>thead>tr>td:active{outline:none}table.dataTable>thead>tr>th:not(.sorting_disabled),table.dataTable>thead>tr>td:not(.sorting_disabled){padding-right:30px}table.dataTable>thead .sorting,table.dataTable>thead .sorting_asc,table.dataTable>thead .sorting_desc,table.dataTable>thead .sorting_asc_disabled,table.dataTable>thead .sorting_desc_disabled{cursor:pointer;position:relative}table.dataTable>thead .sorting:before,table.dataTable>thead .sorting:after,table.dataTable>thead .sorting_asc:before,table.dataTable>thead .sorting_asc:after,table.dataTable>thead .sorting_desc:before,table.dataTable>thead .sorting_desc:after,table.dataTable>thead .sorting_asc_disabled:before,table.dataTable>thead .sorting_asc_disabled:after,table.dataTable>thead .sorting_desc_disabled:before,table.dataTable>thead .sorting_desc_disabled:after{position:absolute;bottom:.5em;display:block;opacity:.3}table.dataTable>thead .sorting:before,table.dataTable>thead .sorting_asc:before,table.dataTable>thead .sorting_desc:before,table.dataTable>thead .sorting_asc_disabled:before,table.dataTable>thead .sorting_desc_disabled:before{right:1em;content:"↑"}table.dataTable>thead .sorting:after,table.dataTable>thead .sorting_asc:after,table.dataTable>thead .sorting_desc:after,table.dataTable>thead .sorting_asc_disabled:after,table.dataTable>thead .sorting_desc_disabled:after{right:.5em;content:"↓"}table.dataTable>thead .sorting_asc:before,table.dataTable>thead .sorting_desc:after{opacity:1}table.dataTable>thead .sorting_asc_disabled:before,table.dataTable>thead .sorting_desc_disabled:after{opacity:0}div.dataTables_scrollHead table.dataTable{margin-bottom:0 !important}div.dataTables_scrollBody>table{border-top:none;margin-top:0 !important;margin-bottom:0 !important}div.dataTables_scrollBody>table>thead .sorting:before,div.dataTables_scrollBody>table>thead .sorting_asc:before,div.dataTables_scrollBody>table>thead .sorting_desc:before,div.dataTables_scrollBody>table>thead .sorting:after,div.dataTables_scrollBody>table>thead .sorting_asc:after,div.dataTables_scrollBody>table>thead .sorting_desc:after{display:none}div.dataTables_scrollBody>table>tbody tr:first-child th,div.dataTables_scrollBody>table>tbody tr:first-child td{border-top:none}div.dataTables_scrollFoot>.dataTables_scrollFootInner{box-sizing:content-box}div.dataTables_scrollFoot>.dataTables_scrollFootInner>table{margin-top:0 !important;border-top:none}@media screen and (max-width: 767px){div.dataTables_wrapper div.dataTables_length,div.dataTables_wrapper div.dataTables_filter,div.dataTables_wrapper div.dataTables_info,div.dataTables_wrapper div.dataTables_paginate{text-align:center}div.dataTables_wrapper div.dataTables_paginate ul.pagination{justify-content:center !important}}table.dataTable.table-sm>thead>tr>th:not(.sorting_disabled){padding-right:20px}table.dataTable.table-sm .sorting:before,table.dataTable.table-sm .sorting_asc:before,table.dataTable.table-sm .sorting_desc:before{top:5px;right:.85em}table.dataTable.table-sm .sorting:after,table.dataTable.table-sm .sorting_asc:after,table.dataTable.table-sm .sorting_desc:after{top:5px}table.table-bordered.dataTable{border-right-width:0}table.table-bordered.dataTable thead tr:first-child th,table.table-bordered.dataTable thead tr:first-child td{border-top-width:1px}table.table-bordered.dataTable th,table.table-bordered.dataTable td{border-left-width:0}table.table-bordered.dataTable th:first-child,table.table-bordered.dataTable th:first-child,table.table-bordered.dataTable td:first-child,table.table-bordered.dataTable td:first-child{border-left-width:1px}table.table-bordered.dataTable th:last-child,table.table-bordered.dataTable th:last-child,table.table-bordered.dataTable td:last-child,table.table-bordered.dataTable td:last-child{border-right-width:1px}table.table-bordered.dataTable th,table.table-bordered.dataTable td{border-bottom-width:1px}div.dataTables_scrollHead table.table-bordered{border-bottom-width:0}div.table-responsive>div.dataTables_wrapper>div.row{margin:0}div.table-responsive>div.dataTables_wrapper>div.row>div[class^=col-]:first-child{padding-left:0}div.table-responsive>div.dataTables_wrapper>div.row>div[class^=col-]:last-child{padding-right:0}table.dataTable.table-striped>tbody>tr:nth-of-type(2n+1){--bs-table-accent-bg: transparent}table.dataTable.table-striped>tbody>tr.odd{--bs-table-accent-bg: var(--bs-table-striped-bg)}


@keyframes dtb-spinner{100%{transform:rotate(360deg)}}@-o-keyframes dtb-spinner{100%{-o-transform:rotate(360deg);transform:rotate(360deg)}}@-ms-keyframes dtb-spinner{100%{-ms-transform:rotate(360deg);transform:rotate(360deg)}}@-webkit-keyframes dtb-spinner{100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}@-moz-keyframes dtb-spinner{100%{-moz-transform:rotate(360deg);transform:rotate(360deg)}}div.dataTables_wrapper{position:relative}div.dt-buttons{position:initial}div.dt-button-info{position:fixed;top:50%;left:50%;width:400px;margin-top:-100px;margin-left:-200px;background-color:white;border:2px solid #111;box-shadow:3px 4px 10px 1px rgba(0, 0, 0, 0.3);border-radius:3px;text-align:center;z-index:21}div.dt-button-info h2{padding:.5em;margin:0;font-weight:normal;border-bottom:1px solid #ddd;background-color:#f3f3f3}div.dt-button-info>div{padding:1em}div.dtb-popover-close{position:absolute;top:10px;right:10px;width:22px;height:22px;border:1px solid #eaeaea;background-color:#f9f9f9;text-align:center;border-radius:3px;cursor:pointer;z-index:12}button.dtb-hide-drop{display:none !important}div.dt-button-collection-title{text-align:center;padding:.3em 0 .5em;margin-left:.5em;margin-right:.5em;font-size:.9em}div.dt-button-collection-title:empty{display:none}span.dt-button-spacer{display:inline-block;margin:.5em;white-space:nowrap}span.dt-button-spacer.bar{border-left:1px solid rgba(0, 0, 0, 0.3);vertical-align:middle;padding-left:.5em}span.dt-button-spacer.bar:empty{height:1em;width:1px;padding-left:0}div.dt-button-collection span.dt-button-spacer{width:100%;font-size:.9em;text-align:center;margin:.5em 0}div.dt-button-collection span.dt-button-spacer:empty{height:0;width:100%}div.dt-button-collection span.dt-button-spacer.bar{border-left:none;border-bottom:1px solid rgba(0, 0, 0, 0.3);padding-left:0}div.dt-button-collection{position:absolute;z-index:2001;background-color:white;border:1px solid rgba(0, 0, 0, 0.15);border-radius:4px;box-shadow:0 6px 12px rgba(0, 0, 0, 0.175);padding:.5rem 0;width:200px}div.dt-button-collection div.dropdown-menu{position:relative;display:block;background-color:transparent;border:none;box-shadow:none;padding:0;border-radius:0;z-index:2002;min-width:100%}div.dt-button-collection.fixed{position:fixed;display:block;top:50%;left:50%;margin-left:-75px;border-radius:5px;background-color:white}div.dt-button-collection.fixed.two-column{margin-left:-200px}div.dt-button-collection.fixed.three-column{margin-left:-225px}div.dt-button-collection.fixed.four-column{margin-left:-300px}div.dt-button-collection.fixed.columns{margin-left:-409px}@media screen and (max-width: 1024px){div.dt-button-collection.fixed.columns{margin-left:-308px}}@media screen and (max-width: 640px){div.dt-button-collection.fixed.columns{margin-left:-203px}}@media screen and (max-width: 460px){div.dt-button-collection.fixed.columns{margin-left:-100px}}div.dt-button-collection.fixed>:last-child{max-height:100vh;overflow:auto}div.dt-button-collection.two-column>:last-child,div.dt-button-collection.three-column>:last-child,div.dt-button-collection.four-column>:last-child{display:block !important;-webkit-column-gap:8px;-moz-column-gap:8px;-ms-column-gap:8px;-o-column-gap:8px;column-gap:8px}div.dt-button-collection.two-column>:last-child>*,div.dt-button-collection.three-column>:last-child>*,div.dt-button-collection.four-column>:last-child>*{-webkit-column-break-inside:avoid;break-inside:avoid}div.dt-button-collection.two-column{width:400px}div.dt-button-collection.two-column>:last-child{padding-bottom:1px;column-count:2}div.dt-button-collection.three-column{width:450px}div.dt-button-collection.three-column>:last-child{padding-bottom:1px;column-count:3}div.dt-button-collection.four-column{width:600px}div.dt-button-collection.four-column>:last-child{padding-bottom:1px;column-count:4}div.dt-button-collection .dt-button{border-radius:0}div.dt-button-collection.columns{width:auto}div.dt-button-collection.columns>:last-child{display:flex;flex-wrap:wrap;justify-content:flex-start;align-items:center;gap:6px;width:818px;padding-bottom:1px}div.dt-button-collection.columns>:last-child .dt-button{min-width:200px;flex:0 1;margin:0}div.dt-button-collection.columns.dtb-b3>:last-child,div.dt-button-collection.columns.dtb-b2>:last-child,div.dt-button-collection.columns.dtb-b1>:last-child{justify-content:space-between}div.dt-button-collection.columns.dtb-b3 .dt-button{flex:1 1 32%}div.dt-button-collection.columns.dtb-b2 .dt-button{flex:1 1 48%}div.dt-button-collection.columns.dtb-b1 .dt-button{flex:1 1 100%}@media screen and (max-width: 1024px){div.dt-button-collection.columns>:last-child{width:612px}}@media screen and (max-width: 640px){div.dt-button-collection.columns>:last-child{width:406px}div.dt-button-collection.columns.dtb-b3 .dt-button{flex:0 1 32%}}@media screen and (max-width: 460px){div.dt-button-collection.columns>:last-child{width:200px}}div.dt-button-collection.fixed:before,div.dt-button-collection.fixed:after{display:none}div.dt-button-collection .btn-group{flex:1 1 auto}div.dt-button-collection .dt-button{min-width:200px}div.dt-button-collection div.dt-btn-split-wrapper{width:100%}div.dt-button-collection button.dt-btn-split-drop-button{width:100%;color:#212529;border:none;background-color:white;border-radius:0px;margin-left:0px !important}div.dt-button-collection button.dt-btn-split-drop-button:focus{border:none;border-radius:0px;outline:none}div.dt-button-collection button.dt-btn-split-drop-button:hover{background-color:#e9ecef}div.dt-button-collection button.dt-btn-split-drop-button:active{background-color:#007bff !important}div.dt-button-background{position:fixed;top:0;left:0;width:100%;height:100%;z-index:999}@media screen and (max-width: 767px){div.dt-buttons{float:none;width:100%;text-align:center;margin-bottom:.5em}div.dt-buttons a.btn{float:none}}div.dt-buttons button.btn.processing,div.dt-buttons div.btn.processing,div.dt-buttons a.btn.processing{color:rgba(0, 0, 0, 0.2)}div.dt-buttons button.btn.processing:after,div.dt-buttons div.btn.processing:after,div.dt-buttons a.btn.processing:after{position:absolute;top:50%;left:50%;width:16px;height:16px;margin:-8px 0 0 -8px;box-sizing:border-box;display:block;content:" ";border:2px solid #282828;border-radius:50%;border-left-color:transparent;border-right-color:transparent;animation:dtb-spinner 1500ms infinite linear;-o-animation:dtb-spinner 1500ms infinite linear;-ms-animation:dtb-spinner 1500ms infinite linear;-webkit-animation:dtb-spinner 1500ms infinite linear;-moz-animation:dtb-spinner 1500ms infinite linear}div.dt-buttons div.btn-group{position:initial}div.dt-btn-split-wrapper button.dt-btn-split-drop{border-top-right-radius:.25rem !important;border-bottom-right-radius:.25rem !important}div.dt-btn-split-wrapper:active:not(.disabled) button,div.dt-btn-split-wrapper.active:not(.disabled) button{background-color:#5a6268;border-color:#545b62}div.dt-btn-split-wrapper:active:not(.disabled) button.dt-btn-split-drop,div.dt-btn-split-wrapper.active:not(.disabled) button.dt-btn-split-drop{box-shadow:none;background-color:#6c757d;border-color:#6c757d}div.dt-btn-split-wrapper:active:not(.disabled) button:hover,div.dt-btn-split-wrapper.active:not(.disabled) button:hover{background-color:#5a6268;border-color:#545b62}div.dataTables_wrapper div.dt-buttons.btn-group div.btn-group{border-radius:4px !important}div.dataTables_wrapper div.dt-buttons.btn-group div.btn-group:last-child{border-top-left-radius:0px !important;border-bottom-left-radius:0px !important}div.dataTables_wrapper div.dt-buttons.btn-group div.btn-group:first-child{border-top-right-radius:0px !important;border-bottom-right-radius:0px !important}div.dataTables_wrapper div.dt-buttons.btn-group div.btn-group:last-child:first-child{border-top-left-radius:4px !important;border-bottom-left-radius:4px !important;border-top-right-radius:4px !important;border-bottom-right-radius:4px !important}div.dataTables_wrapper div.dt-buttons.btn-group div.btn-group button.dt-btn-split-drop:last-child{border:1px solid #6c757d}div.dataTables_wrapper div.dt-buttons.btn-group div.btn-group div.dt-btn-split-wrapper{border:none}div.dt-button-collection div.btn-group{border-radius:4px !important}div.dt-button-collection div.btn-group button{border-radius:4px}div.dt-button-collection div.btn-group button:last-child{border-top-left-radius:0px !important;border-bottom-left-radius:0px !important}div.dt-button-collection div.btn-group button:first-child{border-top-right-radius:0px !important;border-bottom-right-radius:0px !important}div.dt-button-collection div.btn-group button:last-child:first-child{border-top-left-radius:4px !important;border-bottom-left-radius:4px !important;border-top-right-radius:4px !important;border-bottom-right-radius:4px !important}div.dt-button-collection div.btn-group button.dt-btn-split-drop:last-child{border:1px solid #6c757d}div.dt-button-collection div.btn-group div.dt-btn-split-wrapper{border:none}span.dt-button-spacer.bar:empty{height:inherit}div.dt-button-collection span.dt-button-spacer{padding-left:1rem !important;text-align:left}
 
</style> 

<div class="container">
    <div class="row">
        <img src="../../img/logopttdigital.png" align="left" height="70" width="200">
    </div>

    <br>
    <div class="topnav">
        <h5><a class="active" href="../">
                <font color="#ff621e">Home</font>
            </a>
            <a>/</a>
            <a>
                <font color="#707070">BSM&ESM</font>
            </a>
        </h5>

    </div>
    <br> 

    <section>
            <div class="col-md-12">
                <center>
                    <h3>
                        <font  color="#707070"><b>Inventory BSM&ESM</b></font> 
                    </h3>
                </center> 
            </div>
    </section> 
</div>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-2">
                <div align="right">
                    <button class="btn btn-warning" style="font-size: 13px;" onclick="window.location.href='bsm_esm_insert.php'">
                        Insert
                    </button>
                </div>
            </div>
        </div>
        <hr style="border-top: 1px solid #707070;">
    </div>
 
    <div class="container bd_bg">  
        <form action="bsm_esm.php" method="POST" class="form-horizontal" type="hidden"> 
            <div class="row mt-2">   
                <!-- Dropdown Company --> 
                <div class="col-lg-2-md-2">
                    <select class="form-control mx-2 mb-4 dropdown_list" name="select_company" > 
                        <option disabled selected hidden>Company</option>
                            <?php foreach($query_company as $choose_cn){?> <!--as is new name-->
                        <option value="<?php echo $choose_cn["company_name"];?>" >
                            <?php echo $choose_cn["company_name"]; ?> <!--ประกาศค่าที่ต้องการแสงดว่าอยู่ในคอลัมไหน-->
                        </option>
                            <?php } ?>
                    </select> 
                </div>

                <!-- dropdown Service -->  
                <div class="col-lg-2-md-2">
                    <select class="form-control mx-2 mb-4 dropdown_list" name="dropdown_service">  
                        <option disabled selected hidden>Service</option>
                            <?php foreach($query_service as $choose_sn){?> <!--as is new name-->
                        <option  value="<?php echo $choose_sn["service_name"]; ?>">
                            <?php echo $choose_sn["service_name"]; ?> <!--ประกาศค่าที่ต้องการแสงดว่าอยู่ในคอลัมไหน-->
                        </option>
                            <?php } ?> 
                    </select> 
                </div>
                
                <!-- input Search for Server, System or IP --> 
                <div class="col-lg-2-md-2"> 
                    <input type="text" class="form-control mx-2 mb-3 dropdown_list" name="finding" 
                    placeholder="Search for Server, System or IP"  style="width: 270px;"  
                    value="<?php if(isset($_POST['search'])){echo $_POST['search']; } ?>"> 
                </div>
              
                <!-- Checkbox Monitor -->
                <div class="col-lg-2-md-2">   
                    <select  class="form-control mx-2 mb-4 dropdown_list" name="dropdown_monitor">  
                        <option disabled selected hidden>Monitor</option>
                            <?php foreach($query_monitor as $choose_mt){?> <!--as is new name-->
                        <option  value="<?php echo $choose_mt["monitor_name"];?>">
                            <?php echo $choose_mt["monitor_name"]; ?> <!--ประกาศค่าที่ต้องการแสงดว่าอยู่ในคอลัมไหน-->
                        </option>
                            <?php } ?> 
                    </select>
                </div>

                <!-- Radio Status -->
                <div class="col-lg-2-md-2 mx-2 mt-1">   
                    &nbsp;&nbsp;<font style="border-bottom: 2px solid red; font-size: 13px; padding-bottom: 8px;">Status:  
                        <input name="status_active" type="radio" value="active" class="mx-2 mb-4">Active &nbsp;  
                        <input name="status_active" type="radio" value="inactive"> Inactive  
                    </font> 
                </div> 
                &nbsp;&nbsp; &nbsp;&nbsp;
                <div class="col-lg-2-md-2 mx-2" align="right">  
                    <button class="btn btn-success" type="submit" style="font-size: 13px;" name="submit_bt"> Search </button> 
                    <button class="btn btn-danger" onclick='re()' style="font-size: 13px;" name="submit_rs">  Reset  </button>
                                <script>
                                    re() { 
                                    this.button.reset.table();
                                }
                                </script>
                </div> 
             </div>    
        </form> 
    </div> 
</section>

<div class="container mt-2 data_table" style="overflow:auto;">  
    <table id="example" class="display table table-sort table-bordered responsive table-hover table-striped table-sm" >
        <thead>
            <tr class="head" >
                <th scope="col">No.</th>
                <th scope="col">Company</th>
                <th scope="col">System Name</th>
                <th scope="col">Server Name</th>
                <th scope="col">IP</th> 
                <th scope="col">OS</th>
                <th scope="col">Status</th>
                <th scope="col">End Date</th>
                <th scope="col">Tools</th> 
                <th scope="col">Dashboard</th>
                <th scope="col">Install Date</th>
                <th scope="col">Update Date</th>
                <th scope="col">Service</th>
                <th scope="col">Monitor</th> 
                <!--<th scope="col">Alert to</th>
                <th scope="col">Remark</th>
                <th scope="col">Service Owner</th>
                <th scope="col">Contact Point</th> 
                <th scope="col">Port No.</th>  
                <th scope="col">Job Code</th>
                <th scope="col">Product Name</th>
                <th scope="col">App Support Team</th>
                <th scope="col">Support Sub Team</th>
                <th scope="col">PDPA</th> 
                <th scope="col">Critical</th>
                <th scope="col">Version Product</th>
                <th scope="col">Vender Product</th> -->
                <th scope="col">Edit</th> 
            </tr>
        </thead> 
        <tbody class="table_border">
            <?php if (isset($_POST['submit_bt'])) {
                $select_company = $_POST['select_company']; 
                $finding = $_POST['finding'];
                $dropdown_service = $_POST['dropdown_service'];
                $status_active = $_POST['status_active'];
                $dropdown_monitor = $_POST['dropdown_monitor'];
                if(empty($select_company ) || empty($finding) || empty($dropdown_service) || empty($status_active) || 
                empty($dropdown_monitor)){ 
                $sql_filter = "SELECT * FROM data_bsm_esm WHERE company='$select_company' OR systemname='$finding' OR 
                            servername='$finding' OR ip='$finding' OR service='$dropdown_service' OR 
                            status='$status_active' and monitor LIKE '%$dropdown_monitor%'"; 
                echo $sql_filter;
                $query_filter = mysqli_query($conn,$sql_filter) or die("Unable to connect to $sql_filter");       
                if(mysqli_num_rows($query_filter) > 0){
                    foreach($query_filter as $row_filter){ ?>
                    <tr> 
                        <th scope="row"><?php echo $count++ ?></th>
                        <td><?php echo $row_filter['company']; ?></td> 
                        <td><?php echo $row_filter['systemname'];?></td> 
                        <td><?php echo $row_filter['servername']; ?></td>
                        <td><?php echo $row_filter['ip']; ?></td>
                        <td><?php echo $row_filter['os']; ?></td> 
                        <td><?php echo $row_filter['status']; ?></td> 
                        <td><?php echo $row_filter['enddate']; ?></td> 
                        <td><?php echo $row_filter['tools'];  ?></td> 
                        <td><?php echo $row_filter['dashboard']; ?></td> 
                        <td><?php echo $row_filter['installdate'];?></td> 
                        <td><?php echo $row_filter['updatedate']; ?></td>
                        <td><?php echo $row_filter['service']; ?></td>
                        <td><?php echo $row_filter['monitor']; ?></td> 
                        <!-- ข้อมูลใน text-->   
                        <td><a href="bsm_esm_edit.php?&ID=<?php echo $row_filter['id_data']; ?>"
                            class="btn btn-warning btn-primary btn-flat "> <font class="fas fa-edit" style="font-size: 13px;"> Edit</font></a>
                        </td>
                    </tr>
                <?php }}}else{  ?>
                   <tr>
                    <td>No Data Found</td>
                    </tr>
                <?php }
            }else{
                $sql_bsm_esm = "SELECT * FROM data_bsm_esm";
                $query_bsm_esm = mysqli_query($conn,$sql_bsm_esm) or die("Unable to connect to $sql_bsm_esm"); 
                if(mysqli_num_rows($query_bsm_esm) > 0){
                    foreach($query_bsm_esm as $row_bsm_esm){ ?>   
                    <tr> 
                        <th scope="row"><?php echo $count++ ?></th>
                        <td><?php echo $row_bsm_esm['company']; ?></td> 
                        <td><?php echo $row_bsm_esm['systemname'];?></td> 
                        <td><?php echo $row_bsm_esm['servername']; ?></td>
                        <td><?php echo $row_bsm_esm['ip']; ?></td>
                        <td><?php echo $row_bsm_esm['os']; ?></td> 
                        <td><?php echo $row_bsm_esm['status']; ?></td> 
                        <td><?php echo $row_bsm_esm['enddate']; ?></td> 
                        <td><?php echo $row_bsm_esm['tools'];  ?></td> 
                        <td><?php echo $row_bsm_esm['dashboard']; ?></td> 
                        <td><?php echo $row_bsm_esm['installdate'];?></td> 
                        <td><?php echo $row_bsm_esm['updatedate']; ?></td>
                        <td><?php echo $row_bsm_esm['service']; ?></td>
                        <td><?php echo $row_bsm_esm['monitor']; ?></td> 
                        <!-- ข้อมูลใน text-->    
                        <td><a href="bsm_esm_edit.php?&ID=<?php echo $row_bsm_esm['id_data']; ?>"
                            class="btn btn-warning btn-primary btn-flat "> <font class="fas fa-edit" style="font-size: 13px;"> Edit</font></a>
                        </td>
                    </tr>
               <?php }}else{ ?> 
                    <tr>
                    <td>No Data Found</td>
                    </tr>
               <?php }  } ?>
        </tbody>
    </table>        
</div>
 
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script src="../../js/jquery-3.6.0.min.js"></script>
    <script src="../../js/datatables.min.js"></script>
    <script src="../../js/pdfmake.min.js"></script>
    <script src="../../js/vfs_fonts.js"></script>
    
    <script>
    $(document).ready(function(){
    var table = $('#example').DataTable({ 
        buttons:['copy', 'csv', 'excel', 'pdf', 'print']  
    });
     
    table.buttons().container()
    .appendTo('#example_wrapper .col-md-6:eq(0)'); 
    }); 
    </script>
    <!--<script src="../../js/mytable.js"></script>-->   
</body>


 