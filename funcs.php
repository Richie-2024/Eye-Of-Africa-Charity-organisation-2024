<?php
// print_r($_POST);
include('mylib.php');

function donate(){
if(post_exisits('donate_butt') && post_exisits('amount')){
    // echo "Someone wants to donate {$_POST['amount']}";
            $amount = intval($_POST['amount']) ;
            $email =  $_POST['email'];
            $info = [
                'telephone'=>'000000000',
                'name' => 'User',
                'email' =>  $email,

            ];
            
            ?>
            <form action="" >
            <button onclick="makePayment()" type="button">Proceed</button>
            </form>
            
            <?php
    make_payment_js($amount,$info,'?donation=attempt');
    // make_payment_with_custom($amount,$email);
}

}


?>

