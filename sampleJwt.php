
<?php
/**
 * Created by PhpStorm.
 * User: vshah
 * Date: 4/2/19
 * Time: 3:16 PM
 */

require_once('jwt/vendor/autoload.php');

use \Firebase\JWT\JWT;

    error_reporting(E_ALL ^ E_ALL);
    ob_end_flush();
    session_start();
    $ini_array = parse_ini_file(__DIR__."/myapp.ini");
    
    $url = $ini_array["BASE_URL"];
    
    $node_url = $ini_array["NODE_URL"];
    $linked_acc_url = $ini_array["BASE_URL"].$ini_array["GET_ACCOUNTS_URL"];
    $trans_url = $ini_array["BASE_URL"].$ini_array["GET_TRANSACTIONS_URL"];
    $cobrand = $ini_array["COBRAND_NAME"];
    $apiVersion=$ini_array["API_VERSION"];

    if (isset($_POST['submit'])) {
    $key = $_POST['privateKey'];
    //echo '<pre>'.$key.'</pre>';
    $privateKey =$key;
    $issuer = $_POST['issuerID'];
    $userLogin =$_POST['username'];
    $node_url =$_POST['node_url'];


    $iat = time() - 90;
    $exp = strtotime("+10 minutes");

    $token = array(
        "iat" => $iat,
        "exp" => $exp,
        "iss" => $issuer,
        "sub" => $userLogin
    );

    $jwt = JWT::encode($token, $privateKey, 'RS512');
//    echo '<pre class="prettyprint" style="overflow-y: hidden;">'.$jwt.'</pre>';
    
    
    //Accounts

//    function getUserAccounts($url,$cobrand,$apiVersion,$token)
//    {
        
        $jwtToken= 'Authorization: Bearer'.$jwt ;
//        echo $jwtToken;
        
        $ch2 = curl_init($linked_acc_url);
        curl_setopt($ch2, CURLOPT_URL, $linked_acc_url);
        curl_setopt($ch2, CURLOPT_HEADER, 0);
        curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Cobrand-Name:'.$cobrand, 'Api-Version:'.$apiVersion, $jwtToken));
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch2);
        
        curl_close($ch2);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //echo $response;
        }
        $data = json_decode($response,true);
        
//        foreach($response['account'] as $mydata)
//
//        {
//            echo $mydata['accountName'] . "\n";
////            foreach($mydata->values as $values)
////            {
////                echo $values->value . "\n";
////            }
//        }
//    }
    
}
//else {
//        $message = "Invalid Credentials please check user/key details(from Yodlee API Dashboard)..";
//        echo "<script type='text/javascript'>alert('$message');</script>";
//    }


?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">


<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel = "stylesheet" href="app.css?v=3"/>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>


<body>
<div class="container">
<div class ="row">
<!--    <div class="col-md-3">-->
<!--    <div class = "card"> <div class="card-header"> Account Name-->
<!--        </div>-->
        <div class="" id="container-fastlink">
            <div style="text-align: center;margin: 5%">
                <input class ="btn btn-success btn-sm"  type="submit" id="btn-fastlink" value="<?php echo $userLogin; ?>">
            </div>
        </div>
<!--                <button class="btn btn-primary btn-sm" id="close" >Close</button>


<!--<!--            --><?php
////
////                //print_r($data);
////                echo "
////
////  <ul class=\"list-group list-group-flush\">";
////                foreach ($data as $item){
////                    foreach ($item as $key=>$value) {
////                        echo "
////  <li class=\"list-group-item\"><a href=\"\">" . $value['accountName'] . "</a></li>
////  ";
//////echo $value['accountType'].$value['balance']['amount'].$value['id'];
////
////                    }
////
////                echo "</ul>";
////
////                }
////
////            ?>
<!--        </div>-->
<!--        </div>-->
<!--        -->
<!--        -->
<!--    </div>-->
    <div class="col-md-12">
    
    
    <?php
        foreach ($data as $newItem){
            $i=0;
            
            foreach ($newItem as $x=>$y){
                
                $accountId = $y['id'];
                $account_title = $y['accountName'];
                
                echo "<div class=\"offer offer-light\" id='showTransaction$i'><div class=\"col-md-4 col-lg-3\">
           <a class=\"showElement\" id=\"showInfo$i'\" data-target=\".info$i\"><div class=\"offer offer-radius offer-default acc-name\">
                <div class=\"shape\">
                    <div class=\"shape-text\">
                        top
                    </div>
                </div>
                <div class=\"offer-content\">
                    <h3 class=\"lead\">
                        Account Name
                    </h3>
                    
                      <p>".$y['accountName']."</p>
                    
                </div> </a>
            </div>
        </div>";
                
                echo "<div class=\"col-xs-12 col-sm-6 col-md-4 col-lg-3\">
            <div class=\"offer offer-radius offer-success acc-bal info$i target\" style='display: none'>
                <div class=\"shape\">
                    <div class=\"shape-text\">
                        top
                    </div>
                </div>
                <div class=\"offer-content\">
                    <h3 class=\"lead\">
                        Account Balance
                    </h3>".
                    "<p><i class=\"fa fa-usd\" aria-hidden=\"true\"></i>&nbsp;".$y['balance']['amount'].
                "</p><button class='btn btn-light btn-sm transactions-btn' id=\"getTransaction$i\" value='$accountId' data-toggle=\"modal\" data-target=\".bd-example-modal-lg\"><i class='fa fa-money'></i> Summary</button>
                    </div>
            </div>
        </div>";
                echo "<div class=\"col-xs-12 col-sm-6 col-md-4 col-lg-3\">
            <div class=\"offer offer-radius offer-primary acc-id info$i target\" style='display: none'>
                <div class=\"shape\">
                    <div class=\"shape-text\">
                        top
                    </div>
                </div>
                <div class=\"offer-content\">
                    <h3 class=\"lead\">
                        Account Id
                    </h3><p id=\"iD\">"
                    .$y['id'].
                "</p>
                    <button class='btn btn-light btn-sm' id=\"unlink-btn\" value='$accountId'><i class='fa fa-unlink'></i> Unlink</button>
                    
                    </div>
            </div>
        </div>
";
                echo "
        <div class=\"col-xs-12 col-sm-6 col-md-4 col-lg-3\">
            <div class=\"offer offer-radius offer-warning acc-type info$i target\" style='display: none'>
                <div class=\"shape\">
                    <div class=\"shape-text\">
                        top
                    </div>
                </div>
                <div class=\"offer-content\">
                    <h3 class=\"lead\">
                        Account Type
                    </h3>".$y['accountType'].
                    
                "</div>
            </div>
        </div>
        <div class=\"transactionSummary\"> <div class='card transaction-card'> <div class=\"card-header\">
        <h4>$account_title</h4><hr><form class=\"form-inline\">
  <div class=\"form-group mb-2\">
    
    <div class='input-group'><input type=\"text\" class=\"form-control\" id=\"fromDate\" placeholder=\"From Date:(yyyy-mm-dd)\"><span class=\"input-group-addon\">
                        <span class=\"fa fa-calendar\"></span>
                    </span>
  </div></div>
  <div class=\"form-group mx-sm-3 mb-2\">
    <div class='input-group'>
    <input type=\"text\" class=\"form-control\" id=\"toDate\" placeholder=\"To Date:(yyyy-mm-dd)\"><span class=\"input-group-addon\">
                        <span class=\"fa fa-calendar\"></span>
                    </span>
  </div></div>
  <button class=\"btn btn-primary btn-sm mb-2\" id=\"summary_Bydate$i\" style='margin-top: inherit;'>Transaction By Date</button>
</form>
</div><div class='card-body transactionBody'><table class='table table-bordered table-condensed' id=\"transactionTable\" style=\"width:100%\"><thead>
                                                <th>Date</th>
                                                <th>Amount</th>

                                                <th>Category</th>
                                                <th>Description(Simple)</th>

                                               
                                            </thead><tbody id='insert'>
                                            
                                            </tbody></table></div></div></div>
       
        </div>";
                
                echo "<div id=\"overlay\" style=\"display:none;\">
            <div class=\"spinner\"></div>
            <br/>
            Loading...
        </div>";
                $i++;

//                    $errorDetails = checkForError($output);
//                    if (!empty($errorDetails)) {
//                        echo "error in the function";
//                    } else {
//                        echo $output;
//                    }
            
            
            }
        }
        

    ?>
<!--        <div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
<!--            <div class="modal-dialog" role="document">-->
<!--                <div class="modal-content">-->
<!--                   <div class="modal-header">-->
<!--                   -->
<!--                   </div>-->
<!--                    <div class="modal-body">-->
<!--                        <table class= "table table-bordered" id="transactionInfo"><thead><th>Date</th><th>Amount</th><th>Category</th><th>Description</th><th>Detail Description</th></thead><tbody></tbody></table>-->
<!--                    </div>-->
<!--                    <div class="modal-footer">-->
<!--                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeTransaction">Close</button>-->
<!--                        <button type="button" class="btn btn-primary">Save changes</button>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->


<!--        <style>-->
<!--            #unlink-btn {-->
<!--                display: none;-->
<!--                float: right;-->
<!--                font-size: 0.75em;-->
<!--               -->
<!--                margin: 10px;-->
<!--                -->
<!--                -->
<!--            }-->
<!--            .transactions-btn{-->
<!--                display: none;-->
<!--                float: right;-->
<!--                font-size: 0.75em;-->
<!---->
<!--                margin: 10px;-->
<!--            }-->
<!--            .acc-bal:hover{-->
<!--            -->
<!--            }-->
<!---->
<!--            .acc-bal:hover .transactions-btn{-->
<!--                display: inline-block;-->
<!--                -->
<!--            }-->
<!--            .acc-id:hover {-->
<!--                /* Change the filter in here */-->
<!--            }-->
<!--            .acc-id:hover #unlink-btn {-->
<!--                display: inline-block;-->
<!--            }-->
<!--            .transactions-btn{-->
<!--                width: auto;-->
<!--            }-->
<!--            .transactionSummary{-->
<!--                display:none;-->
<!--            }-->
<!--            .transaction-card{-->
<!--                display:inline-block;-->
<!--                margin-left: 25%;-->
<!--            }-->
<!--           -->
<!--        </style>-->
    
<!--        -->

       
   <script>
       
       $(document).ready(function () {
           
     
           var $targets = $('.target');
           $('.showElement').click(function () {
               var $target = $($(this).data('target')).slideToggle();
               $targets.not($target).hide()
              
         

           $(".acc-id #unlink-btn").click(function(e){
               var id = $(this).attr('value');
               var delete_account_url = 'https://sandbox.api.yodlee.com/ysl/accounts/';
               
               
               $.ajax({

                   url: delete_account_url+id,
                   //crossDomain: true,
                   headers: {
                       'Api-Version': '1.1',
                       'Cobrand-Name': 'restserver',
                        'Authorization': 'Bearer <?php echo $jwt;?>'

                   },
                   type: 'DELETE',
                   contentType: 'application/json',
                   success: function (resp6) {
                       console.log(resp6);
                       alert('account unlinked successfully');
                       location.reload();
                   }
               });
           });
            // var d = new Date();
            //
            // var month = d.getMonth()+1;
            // var day = d.getDate();
            //
            // var today_date = d.getFullYear() + '-' +
            //     ((''+month).length<2 ? '0' : '') + month + '-' +
            //     ((''+day).length<2 ? '0' : '') + day;
               
               
               var token = '<?php echo $jwt;?>';
               
           $("[id^=getTransaction]").click(function(){
              var transaction = $(this).parents('.offer-light').find('.transactionSummary');
               
               var parentEls = $(this).parents('.offer-light').find('.transactionSummary .transactionBody #transactionTable');
              
               //console.log(parentEls1);
               
               var acc_id = $(this).attr('value');
               
               
               //alert(token);
               var url = '<?php echo $trans_url;?>';
               var transaction_url = url+'?fromDate='+"2019-05-20"+'&accountId='+acc_id;
               //console.log(acc_id+url+transaction_url);
               //var activeElement = $(this).parent();
               //activeElement.addClass("active");
               $('#overlay').fadeIn()
               $.ajax({
           
                   url: transaction_url,
                   //crossDomain: true,
                   headers: {
                       'Api-Version': '1.1',
                       'Cobrand-Name': 'restserver',
                       'Authorization': 'Bearer '+token
           
                   },
                   type: 'GET',
                   crossDomain: true,
                   contentType: 'application/json',
                   success: function (resp) {
                       $('#overlay').fadeOut();
                       
                       var insert_table ="";
                       transaction.show();
                       
                       $.each(resp, function (i, item) {
                       
                       $.each(item, function (key, value) {
                           //parentEls.DataTable();
                           insert_table = '<tr><td>' + value.transactionDate + '</td><td class="text-right">' + value.amount.amount + '</td><td>' + value.category + '</td><td>' + value.description.simple + '</td></tr>';
                           // parentEls.remove("#insert");
                          //console.log(value);
                           parentEls.append(insert_table);

                           
                           
                       });
                       
                       });
                       
                      
                   }
     
               });

               });
               var date1 = $(this).parents('.offer-light').find('.transactionSummary .transaction-card #fromDate');
               var date2 = $(this).parents('.offer-light').find('.transactionSummary .transaction-card #toDate');

               var fromDate='';
               var toDate='';
               $(function() {
                   date1.datepicker({ format: 'yyyy-mm-dd', todayHighlight: true});
                   date1.on("change",function(){
                       fromDate = $(this).val();
                       console.log(fromDate);
                   });
                   date2.datepicker({ format: 'yyyy-mm-dd', todayHighlight: true});
                   date2.on("change",function(){
                       toDate = $(this).val();
                       console.log(toDate);
                   });


               });
               $("[id^=summary_Bydate]").click(function () {
                   //console.log(fromDate);
                   //console.log(toDate);
                   //var newTable = $(this).parents('.offer-light').find('.transactionSummary .transactionBody #transactionTable');
                   //newTable.remove();
                   var trans_summary_byDate_url = 'https://developer.api.yodlee.com/ysl/transactions?'+'fromDate='+fromDate+'&'+'toDate='+toDate;
                   console.log(trans_summary_byDate_url);
                   // $.ajax({
                   //     url: trans_summary_byDate_url,
                   //     crossDomain: true,
                   //     //data: cobbody,
                   //     headers: {
                   //         'Api-Version': '1.1',
                   //         'Cobrand-Name': 'restserver',
                   //         'Authorization': 'Bearer '+token
                   //     },
                   //     type: 'GET',
                   //     contentType: 'application/json',
                   //     success: function (summary_resp) {
                   //         console.log(summary_resp);
                   //         // var trHTML = '';
                   //         //
                   //         // $.each(summary_resp, function (k, r) {
                   //         //     $.each(r, function (a, b) {
                   //         //         trHTML =  '<tr><td>' + b.transactionDate + '</td><td class="text-right">' + b.amount.amount + '</td><td>' + b.category + '</td><td>' + b.description.simple + '</td></tr>';
                   //         //     });
                   //         // });
                   //         // newTable.append(trHTML);
                   //         // $('#txnTable tbody').remove();
                   //         // $("#txnTable").append('<tbody>'+trHTML+'</tbody>');
                   //         // $('#txnTable').DataTable({
                   //
                   //         // });
                   //
                   //     }
                   //
                   // });
               });


             
              
           
           });
           

       });




   </script>
   
                
           
                
<!--                -->
<!--                // var delete_account_url = 'https://developer.api.yodlee.com/ysl/accounts/';-->
<!--                // //console.log(authorization.val);-->
<!--                // //console.log(delete_account_url);-->

<!---->
<!--            }-->
<!---->
<!--       -->
<!--        </script>-->


    </div>
    
</div>
</div>


<script>
    (function onload(window) {
        //Open FastLink

        var fastlinkBtn = document.getElementById('btn-fastlink');
        fastlinkBtn.addEventListener('click',function () {
            window.fastlink.open({
                fastLinkURL: '<?php echo $node_url?>',
                jwtToken:'Bearer <?php echo $jwt;?>',
                params: '',
                onSuccess: function (data) {
                    console.log(data);
                },
                onError: function (data) {
                    console.log(data);
                },
                onExit: function (data) {
                    console.log(data);
                },
                onEvent: function (data) {
                    console.log(data);
                }
            }, 'container-fastlink');
            $('#btn-fastlink').hide();
        }, false);
    }(window));
    $('#close').click(function() {
        window.location.href = "index.php";
    });
    


</script>
</body>
