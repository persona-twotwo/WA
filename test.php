<div id="PortScan" class="software">
         <div class="container-change-fluid">
            <div class="row d_flex">
               <div class="col-md-6">
                  <div class="titlepage">
                     <br>
                     <h2>Port Scan</h2>
                     <div id="ip-container">
	                     <form method="post" id = "ip-form" name="ip-form" >
		                     <div class="ip-form-group">
			                     <label for="ip" class="ip-form-label" >IP: </label>
			                     <input type="text" name="ip" class="ip-form-input" id="ip" pattern="^((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$" autofocus required placeholder="ex) example.com or ip address">
		                     </div>
		                     <div class="ip-form-group">
			                     <label for="min_port" class="ip-form-label">MIN PORT</label>
			                     <input type="number" name="min_port" class="ip-form-input" id="min_port" min="1" max="65535" value="1">
		                     </div>
		                     <div class="ip-form-group">
			                     <label for="max_port" class="ip-form-label">MAX PORT</label>
			                     <input type="number" name="max_port" class="ip-form-input" id="max_port" min="1" max="65535" value="1024">
		                     </div>
		                        <button id = "btn" name ="submit" type="submit">Submit</button>
	                     </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         
         <div class="software-itme_conteiner">
            <h2>Result</h2>
            <div class="result-container">
            <?php
            if(isset($_POST['submit']) && ($_SERVER['REQUEST_METHOD'] === 'POST'))
            {
               # $output = array();
               $ip = preg_replace("/[^a-z0-9.-:]/i", "", $_POST['ip']);
               $min_port = $_POST['min_port'];
               $max_port = $_POST['max_port'];
               if(!empty($ip) && function_exists("socket_create"))
               {
                   if(isset($min_port) && isset($max_port))
                   {
                       $socket = @socket_create(AF_INET, SOCK_STREAM, 0);
                       echo "<h4 style='color:#BEEFFF'>Scanning ..." . $ip . "</h4>\n";
                       
                       for($p = $min_port ; $p <= $max_port ; $p = $p+1)
                       {
                           $num = preg_replace("/[^0-9]/", "", $p);
                           if($num)
                           {
                               $result = @socket_connect($socket, $ip, $p);
                               if($result)
                               {
                                 echo "<h4 style='color:white;' >" . $p . "</h6>\n";
                               }
                           }
                           else
                           {
                               echo "<font color='red'>Socket Connection Error</font>\n";
                           }
                        
                       }
                       @socket_close($socket);
                   }   
               }
               else{
                   echo "<font color='red'>IP is empty!</font>\n";
               }
            
            }
            else{
                echo "<font color='red'>Button didn't activate!!</font>\n";
            }
            echo '<pre>';
            # print_r($output);

            ?>
            </div>
         </div>
      </div>