<?php


function fetch_item($table, $id){
    include('db.php');
 $check = "SELECT * FROM $table WHERE id =  '$id'";
        $do_it = mysqli_query($conn , $check);
        
        $detail = mysqli_fetch_assoc($do_it);
        return $detail;
}

function user_is_logged_in(){
     if(!empty($_SESSION['session'])){
          return true;

        }else{
            return false;
        }
}

function check_url_param($param){
    if(!empty($_POST[$param])){
        return true;
    }else{
        return false;
    }
}

function post_exisits($post_var){
    if(!empty($_POST[$post_var]) && $_POST[$post_var] != ''){
        return true;
    }else{
        return false;
    }
}

function session_exisits($session_var){
    if(!empty($_SESSION[$session_var]) && $_POST[$session_var] != ''){
        return true;
    }else{
        return false;
    }
}
function loggin_session_value($session_var){
    if(!empty($_SESSION['session'][$session_var]) && $_POST[$session_var] != ''){
        return true;
    }else{
        return false;
    }
}
function get_exisits($get_var){
    if(!empty($_GET[$get_var]) && $_GET[$get_var] != ''){
        return true;
    }else{
        return false;
    }
}
function check_row_exisits_return_it($table,$known_column,$identifier){
         if(check_row_exisits($table,$known_column,$identifier)){
         
            $detail = fetch_items_by_parameter_return_array($table,$known_column,$identifier);
            if($detail){
                return $detail;
            }else{
                return false;
            }
           
         }else{
            return false;
         }
}
// folder string must end with '/' eg assets/videos/
// It always returns an arrray with key "error", when true, key "path" is returned. Otherwise the error key would always return the error that occured  with the upload. It can be passed to the user
    function check_video($file,$folder){
            $target_video = $file;
if($target_video['error'] === 0 ){
    if($target_video['size'] < 20000000){
       $file_ex =strtolower( pathinfo($target_video['name'], PATHINFO_EXTENSION));
                   
                    $arr_correct = ['mp4','m4v','webm','mov','wmv'];
                    if(in_array($file_ex,$arr_correct)){
                        $new_file_name = uniqid('awVID-', true).'.'.$file_ex;
                       $path = $folder.$new_file_name;
                     $move_file =   move_uploaded_file($target_video['tmp_name'], $path);
                    if($move_file){   
                $response = [
                    'error'=> true,
                    'path'=>$path,    
                ]  ;                
                        return $response;
                }
            }else{
                $response = [ 'error'=> "valid formats are :- 'mp4','m4v','webm','mov','wmv'"   ]  ;                
                    return $response;
                }
            }else{
                    $response = [ 'error'=> "'Image exceeds size limit : 20mbs maximum"]  ;                
                            return $response;
            }
            }else{
                $response = ['error'=> "bad video"];                
                return $response;
                }
            
        }

// folder string must end with '/' eg assets/images/
// It always returns an arrray with key "error", when true, key "path" is returned. Otherwise the error key would always return the error that occured  with the upload. It can be passed to the user
        function check_photo($file,$folder){
            $ekishushani = $file;
            // print $folder;
if($ekishushani['error'] === 0 ){
    if($ekishushani['size'] < 5000000){
       $file_ex =strtolower( pathinfo($ekishushani['name'], PATHINFO_EXTENSION));
                   
        $arr_correct = ['jpeg','png','jpg','jfif'];
        if(in_array($file_ex,$arr_correct)){
            $new_file_name = uniqid('awIMG-', true).'.'.$file_ex;
        $path = $folder.$new_file_name;
        $move_file =   move_uploaded_file($ekishushani['tmp_name'], $path);
        if($move_file){   
                $response = [
                    'error'=> true,
                    'path'=>$path,    
                ]  ;                
                        return $response;
                }
            }else{
                $response = [ 'error'=> "valid formats are :- 'jpeg','png','jpg','jfif'"   ]  ;                
                    return $response;
                }
            }else{
                    $response = [ 'error'=> "'Image exceeds size limit : -5mbs maximum"]  ;                
                            return $response;
            }
            }else{
                $response = ['error'=> "bad image"];                
                return $response;
                }
            
        }


function return_future_date($date, $intervals) {
  
    $datetime = new DateTime($date);
    $datetime->modify(
        '+' . $intervals['days'] . ' days ' .
        '+' . $intervals['months'] . ' months ' .
        '+' . $intervals['years'] . ' years ' .
        '+' . $intervals['hours'] . ' hours ' .
        '+' . $intervals['minutes'] . ' minutes'
    );
    return $datetime->format('Y-m-d H:i:s');
}

// Example usage:
// $date = '2024-09-13 00:00:00'; = current_date() to get date from now
// $intervals = [
//     'days' => 0,
//     'months' => 0,
//     'years' => 0,
//     'hours' => 0,
//     'minutes' => 0
// ];



function current_datetime() {
    return date('Y-m-d H:i:s');
}


// This function works best if passed is a result of the current_datetime() function
function getDateDifferences($oldDate) {
    $oldDateTime = new DateTime($oldDate);
    $currentDateTime = new DateTime();

    $interval = $oldDateTime->diff($currentDateTime);

    return array(
        'years' => $interval->y,
        'days' => $interval->days,
        'hours' => $interval->h,
        'minutes' => $interval->i,
        'seconds' => $interval->s
    );
}


function fetch_user_ip_address(){
    // if(!empty($_SERVER['SERVER_ADDR'])){
    //     $ip = $_SERVER['SERVER_ADDR'];
    // }
$ip = $_SERVER['REMOTE_ADDR'];
    // fetch iser location
$url = "http://ip-api.com/json/102.213.194.8";
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_URL => $url
    ]);
    $result = curl_exec($ch);
    curl_close($ch);
    if(curl_error($ch)){
        $err = curl_error($ch);
        echo "Error genrated is {$err}";
    }else{
        $array = json_decode($result,true);
         print_r($array);
    }

   
   
}

function progressive_insert($table,$colums,$values){
    include('db.php');
   $colum = implode(',',$colums);
    
    $value = array_map(function($dh){
        return "'" .$dh ."'";
    },$values);
     $value = implode(',',$value);
    $prep = "INSERT INTO $table ($colum) VALUES ($value)";
    $dp = mysqli_query($conn, $prep);
    if($dp){
        return TRUE;
    }else{
        return FALSE;
    }
}

function delete_item($table,$colums,$values){
    include('db.php');
    $prep = "DELETE FROM $table  WHERE $colums = '$values'";
  
    $dp = mysqli_query($conn, $prep);
    if($dp){
        return TRUE;
    }else{
        return FALSE;
    }
}
function update_item($table,$column,$value,$id){
    include('db.php');
    $prep = "UPDATE $table SET $column = '$value' WHERE id = '$id'";
  
    $dp = mysqli_query($conn, $prep);
    if($dp){
        return true;
    }else{
        return false;
    }
}
  function fetch_items_by_parameter_return_array($table,$column,$param){
             include('db.php');
         $prep = "SELECT * FROM $table WHERE $column = '$param'";
        include('db.php');
        $do =  mysqli_query($conn,$prep);
        if($do && mysqli_num_rows($do) > 0){

          $p = mysqli_fetch_assoc($do);
          return $p;
        }else{
            return false;
        }
       

    }
      function fetch_items_by_two_parameter_return_array($table,$column,$param,$col2,$param2){
             include('db.php');
         $prep = "SELECT * FROM $table WHERE $column = '$param' AND $col2 = '$param2'";
        include('db.php');
        $do =  mysqli_query($conn,$prep);
        if($do && mysqli_num_rows($do) > 0){

          $p = mysqli_fetch_assoc($do);
          return $p;
        }else{
            return false;
        }
       

    }
       function fetch_items_by_two_parameter_return_mysqli($table,$column,$param,$col2,$param2){
             include('db.php');
         $prep = "SELECT * FROM $table WHERE $column = '$param' AND $col2 = '$param2'";
        include('db.php');
        $do =  mysqli_query($conn,$prep);
        return $do;
       

    }
     function fetch_items_by_param_return_msqli($table,$column,$param){
        include('db.php');
         $prep = "SELECT * FROM $table WHERE $column = '$param'";
        include('db.php');
        $do =  mysqli_query($conn,$prep);
        if($do && mysqli_num_rows($do) > 0){

            return $do;
        }else{
            return false;
        }
       
    }

function fetch_all_rows($table){
    include('db.php');
    $prep = "SELECT * FROM $table ";
    $dp = mysqli_query($conn, $prep);
    if($dp){
        return $dp;
    }else{
        return false;
    }
}




function check_row_exisits($table,$known_column,$identifier){
$clean_input = htmlspecialchars(strtolower($identifier));

    include('db.php');
    $prep = "SELECT * FROM $table WHERE $known_column = '$identifier'";
    $dp = mysqli_query($conn, $prep);

$dd = mysqli_num_rows($dp);
    if($dp &&  $dd === 1){
        return true;
    }else{
        return false;
    }
}



// more staff

 function show_error($error_message){
    ?>
    <div class="failure">
        <p><?php
        echo $error_message;
        ?></p>
    </div><?php
}

function show_success($success_message){
    ?>
    <div class="success">
        <p><?php
        echo $success_message;
        ?></p>
    </div><?php
}

function make_payment_with_custom($amount,$email){
           
      
        // echo "Readyu tpo go";
        $endpoint = 'https://api.flutterwave.com/v3/payments';
        $header = [
            'Authorization: Bearer FLWSECK-a82fefada2ac366fc66464b1e5ff27cf-191739ee38dvt-X',
            'content-type:application/json'
        ];
        $data = [
            'tx_ref' => uniqid(),
            'amount' => $amount,
            'currency' => 'UGX',
            'customer' => [
                'email' => $email
            ],
            'redirect_url'=> '?wallet_fund_attempt'
        ];

        $ch = curl_init();
        curl_setopt_array( $ch, [
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => $header 
        ] );

        $response = curl_exec($ch);
        if(curl_error($ch)){
            $error = curl_error($ch);
            // echo "Eccor ".$error;
            return $error;
            // show_error($error);
        }else{
 $result = json_decode($response, true);

        // $ref_id = $result['data']['id'];
        
        // header('location:' . $result['data']['link']);
        ?>
        <iframe src="<?php echo $result['data']['link']; ?>" frameborder="0"></iframe><?php
        }
        curl_close($ch);
        // print_r( $response);
       
}
// this function is limited to passing one parametor whose value will be the amount expected 
// as the pyed amount is returned
// The format shall be ____?fund_wallet_attempt=____
// This fits well with te confirm payment function which passes the expected value
function make_payment_js($amount,$customer_info,$redirect_param){
    $name = $customer_info['name'];
    $tel = $customer_info['telephone'];
    $email = $customer_info['email'];
    $redirect_true = $redirect_param.$amount; 
?>
<script>
    
  function makePayment() {

    FlutterwaveCheckout({
      public_key: "FLWPUBK-02668e5072f604fbf95ce5528cb4e16d-X",
      tx_ref: "<?php  echo uniqid('a-ref_', true)  ?>",
      amount: '<?php echo $amount;  ?>',
      currency: "UGX",
      payment_options: "card, banktransfer, ussd, mobilemoneyuganda",
       redirect_url: "<?php echo $redirect_true;  ?>",
      meta: {
        source: "docs-inline-test",
        consumer_mac: "92a3-912ba-1192a",
      },
      customer: {
        email: "<?php  echo $email; ?>",
        phone_number: "<?php  echo $tel; ?>",
        name: "<?php echo $name;  ?>",
      },
      customizations: {
        title: "Eye Of Africa Charity organisation",
        description: " Payment for Charity Service For Vulnerabilit",
        logo: "http://localhost/gh/im.jpeg", 
      },
      callback: function (data){
        console.log("payment callback:", data);
      },
      onclose: function() {
        console.log("Payment cancelled!");
      }
    });
  }
  
</script>
<?php
}
function confirm_payment($trans_id,$expected_amount){
   
        // $id = $_GET['transaction_id'];
        $endpoint = "https://api.flutterwave.com/v3/transactions/".$trans_id."/verify";
$handler = curl_init();
  $header = [
            'Authorization: FLWSECK-a82fefada2ac366fc66464b1e5ff27cf-191739ee38dvt-X',
            'content-type:application/json'
        ];
  curl_setopt_array( $handler, array(
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => $header 
        ) );
        $result = curl_exec($handler);
        curl_close($handler);
       if(curl_errno($handler)) {

// echo 'curl error: ' . curl_error($handler);

}
    //  echo '<pre>', print_r (json_decode($result, true)),'</pre>';
     $array = json_decode($result, true);

     $status = $array['status'];
     $_id = $array['data'] ['flw_ref'];
     $amount = intval($array['data']['amount']);


        if($status === 'success' && $amount === intval($expected_amount)){
            // print_r($array);
          return($_id) ;
        }elseif($status === 'error'){
            return false;
        }



    }


function mycurl_post($data){
    $handler = curl_init();

    curl_setopt_array($handler, [
        CURLOPT_URL => '/login.php',
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_RETURNTRANSFER => true,

    ]);

    $result = curl_exec($handler);
    curl_close($handler);
    if(curl_error($handler)){
        $ret = [false, curl_error($handler)];
        return $ret;
    }else{
        return $data;
    }
}


function my_curl_get($url,$param){
     $handler = curl_init();

    curl_setopt_array($handler, [
        CURLOPT_URL => $url,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_RETURNTRANSFER => true,

    ]);

    $result = curl_exec($handler);
    curl_close($handler);
 
}
function mycurl_fetch_user_location($ip){

    $url = "http://ip-api.com/json/{$ip}";

    
$handler =curl_init('http://ip-api.com/json/'.$ip);
curl_setopt_array($handler , [
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_RETURNTRANSFER => true,

]);

$do = curl_exec($handler);

curl_close($handler);
}

function get_url_param_array(){
    if(!empty($_SERVER['QUERY_STRING']) && empty($_GET['search_val']) ){
        $params = $_SERVER['QUERY_STRING'] ;
        $array = explode('/', $params);
        return $array;
    } else {
        return false;
    }
}
function return_url_actual_params(){
   $url = explode('/',get_url_param_array()['params']) ;
    $params = $url;
    return $params;
}