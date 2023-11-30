insert
<select name="tools" class="form-control" required>
                <?php foreach($result_tools as $resultt){?>
                    <option value="" disabled selected hidden>-- Choose Tools --</option>
              <option value="<?php echo $resultt["tools_name"];?>">
                <?php echo $resultt["tools_name"]; ?>
              </option>
              <?php } ?>
            </select>
edit
            <select name="tools" class="form-control" > <!--อ้างถึงรหัส-->
                <option> <?php echo $row_data_bsm_esm['tools']; ?> </option>
                <?php foreach($result_tools as $r_tools){?> <!--as is new name--> 
                 <option value="<?php echo $r_tools['tools_name']; ?>">
                <?php echo $r_tools["tools_name"]; ?> <!--ประกาศค่าที่ต้องการแสงดว่าอยู่ในคอลัมไหน-->
                </option>
                <?php } ?>
            </select>

                    <!--
                    <h6 class="form-control mx-4 mb-4">&nbsp;&nbsp;<font class="gray">Monitor &nbsp;&nbsp;</font>
                    <?php $wh=0; while($row_monitor = mysqli_fetch_assoc($query_monitor)) {  ?> 
                        <input type="checkbox" class="selectmonitor"  onclick='ch()'  
                        name="monitor_ck[<?php echo $wh; ?>]" value="<?php echo $row_monitor["monitor_name"] ;?>"> 
                        <label> <?php echo $row_monitor["monitor_name"]; ?> &nbsp;&nbsp;&nbsp; </label>
                        <?php ++$wh;  } ?>
                    </h6>
                                    <script>
                                        onclick = 'ch()'

                                        function ch() {
                                        let box = 0;
                                        for (f of document.getElementsByClassName("selectmonitor")) {

                                        if (f.checked) {
                                        box++;
                                        }

                                        if (box >= 4) {
                                        for (a of document.getElementsByClassName("selectmonitor")) {
                                        if (!a.checked) {
                                        a.disabled = true;
                                        }
                                        }
                                        } else {
                                        for (a of document.getElementsByClassName("selectmonitor")) {
                                        a.disabled = false;
                                        }
                                        }
                                        }
                                        }
                                    </script> --> 
                </div>

                <td><?php echo $row_filter['emailalertto']; ?></td> 
                        <td><?php echo $row_filter['remark']; ?></td> 
                        <td><?php echo $row_filter['serviceowner'];  ?></td>  
                        <td><?php echo $row_filter['contactpoint'];  ?></td> 
                        <td><?php echo $row_filter['portno']; ?></td> 
                        <td><?php echo $row_filter['jobcode'];?></td> 
                        <td><?php echo $row_filter['nameproduct']; ?></td>
                        <td><?php echo $row_filter['appsubportteam']; ?></td>
                        <td><?php echo $row_filter['supportsubteam']; ?></td> 
                        <td><?php echo $row_filter['pdpa']; ?></td> 
                        <td><?php echo $row_filter['critical']; ?></td> 
                        <td><?php echo $row_filter['versionproduct'];  ?></td> 
                        <td><?php echo $row_filter['venderproduct'];  ?></td>

                      