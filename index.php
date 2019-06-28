<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src ="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<script>
    $(document).ready(function(){


        $('input[type="checkbox"]').change(function() {
            var relatedItem = $(this).attr("value");

            var item = $(this);

            if(item.is(":checked")){
                $('input[type="checkbox"]').not($(this)).prop('checked',false).trigger('change');
                $("." + relatedItem).show();
            }else{
                $("." + relatedItem).hide();
            }
        });

        // $('#callRegisterDevForm').click(function () {
        //     $("#registeredUser").toggle();

            $( "#user_form" ).click(function() {
                $("#user_form").prop('disabled',true);
                $("#user_form").val('Loading...');



                console.log('Registering a user!');

                var devRSAprivateKey= $("#devPrivateKey").val();
                console.log(devRSAprivateKey);
                var devIssuerId = $("#DevIssuerID").val();
                console.log(devIssuerId);

                var devEmail = $("#DevEmail").val();
                console.log(devEmail);
                var devUserName = $("#DevUser").val();
                console.log(devUserName)
                // var companyAddress2 = $("#companyAddress2").val();
                // var companyCity = $("#companyCity").val();
                // var companyPostalCode = $("#companyPostalCode").val();
                // var companyState = $("#companyState").val();
                // var companyCountry = $("#companyCountry").val();


                $.post("/YodleeAppJWT/registerUser.php", {
                    key: devRSAprivateKey,
                    issuer: devIssuerId,
                    email:devEmail,
                    user_name :devUserName
                },function(result){

                    console.log(result);

                    var resultObj = JSON.parse(result);

                    console.log(resultObj);

                    if(resultObj.code == 0)
                        $('#registeredUser .card-header').html('<div class="alert alert-success">Your user <strong>'+devUserName+'</strong> is created. Please store your username with your log</p></div>');
                    else
                        $('#registeredUser .card-header').html('<p><div class="alert alert-danger">'+resultObj.message+'</div></p>');

                    $("#user_form").prop('disabled',false);
                    $("#user_form").val('Submit Request');

                });

            });
        //
        // });




    });


</script>
<style>
    .card-header{
        color:white !important;
    }
</style>

<div class="container">
<div class = "row">
    <div class ="col-md-9">
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="sandbox" data-related-item="sandbox" checked>
        <label class="form-check-label" for="inlineCheckbox1">Sandbox</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="development" data-related-item="development">
        <label class="form-check-label" for="inlineCheckbox2">Development</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="production" data-related-item="production">
        <label class="form-check-label" for="inlineCheckbox3">Production</label>
    </div>
</div>
</div>
    <div class="row">
        <div class="col-md-4 sandbox">
        <div class="card border-primary">
        <div class="card-header bg-primary">Enter Sandbox Credentials</div><div class="card-body">
            <form action="sampleJwt.php" method="post">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Enter Private Key:</label>
                    <textarea class="form-control"  rows="3" name="privateKey" ></textarea>
                    <label for="issuerID">Issuer Id:</label><input class="form-control" type="text" placeholder="issuerID" name="issuerID">
                    <label for="username">Test User:</label> <input class="form-control" type="text" placeholder="username" name="username">
                    <label for="url">Enter node URl:</label><input class="form-control" type="text" placeholder="node url" name="node_url">
<!--                    <input  type="submit"  name ="submit">-->
                

                </div> <button type="submit" class="btn btn-outline-dark float-right" id="sumbit-details" value="submit" name="submit">Submit</button>

            </form>
            
            
        </div></div></div>
        <div class="col-md-4 development" style="display: none;">
            <div class="card border-info" >
                <div class="card-header bg-info">Enter Development Credentials</div><div class="card-body">
                    <form action="sampleJwt.php" method="post">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Enter Private Key:</label>
                            <textarea class="form-control"  rows="3" name="privateKey" ></textarea>
                            <label for="issuerID">Issuer Id:</label><input class="form-control" type="text" placeholder="issuerID" name="issuerID">
                            <label for="username">Test User:</label> <input class="form-control" type="text" placeholder="username" name="username">
                            <label for="url">Enter node URl:</label><input class="form-control" type="text" placeholder="node url" name="node_url">
                            <!--                    <input  type="submit"  name ="submit">-->


                        </div> <button type="submit" class="btn btn-outline-dark float-right" id="sumbit-details" value="submit" name="submit">Submit</button>

                    </form>
                    <button type="button" class="btn btn-info float-left" id="callRegisterDevForm">
                        Register user
                    </button>
                    
                    



                </div>
            </div>
        </div>
        <div class="col-md-4 production" style="display: none;">
            <div class="card border-dark ">
                <div class="card-header bg-dark">Enter Production Credentials</div><div class="card-body">
                    <form action="sampleJwt.php" method="post">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Enter Private Key:</label>
                            <textarea class="form-control"  rows="3" name="privateKey" ></textarea>
                            <label for="issuerID">Issuer Id:</label><input class="form-control" type="text" placeholder="issuerID" name="issuerID">
                            <label for="username">Test User:</label> <input class="form-control" type="text" placeholder="username" name="username">
                            <label for="url">Enter node URl:</label><input class="form-control" type="text" placeholder="node url" name="node_url">
                            <!--                    <input  type="submit"  name ="submit">-->


                        </div> <button type="submit" class="btn btn-outline-dark float-right" id="sumbit-details" value="submit" name="submit">Submit</button>

                    </form>


                </div></div></div>
    </div>
    <div class="row">
        <div class ="col-md-9">
        <div class="card" style="display: none;" id="registeredUser">
            <div class="card-header" ></div>
            
                <form type="post" id="regUserDev">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Enter Private Key:</label>
                        <textarea class="form-control"  rows="3" id="devPrivateKey" name="devPrivateKey" ></textarea>
                    </div>
                    <label for="issuerID">Issuer Id:</label><input class="form-control" type="text" placeholder="issuerID" id="DevIssuerID" name="DevIssuerID">

                    <div class="form-group">
                        <label">Email address <sup>*</sup></label>
                        <input type="text" class="form-control" id="DevEmail" name="DevEmail"  placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label>Username <sup>*</sup></label>
                        <input type="text" class="form-control" id="DevUser" name="DevUser"  placeholder="Sample user">
                    </div>
                    <!--                                            <div class="form-group">-->
                    <!--                                                <label >FName</label>-->
                    <!--                                                <input type="text" class="form-control" id="fname"  placeholder="First name">-->
                    <!--                                            </div>-->
                    <!---->
                    <!--                                            <div class="form-group">-->
                    <!--                                                <label >LName</label>-->
                    <!--                                                <input type="text" class="form-control" id="lname"  placeholder="Last name">-->
                    <!--                                            </div>-->
                    <!--                                            <div class="form-group">-->
                    <!--                                                <label >LName</label>-->
                    <!--                                                <input type="text" class="form-control" id="lname"  placeholder="Last name">-->
                    <!--                                            </div>-->
                    <!--                                            <div class="form-group">-->
                    <!--                                                <label >Address 1</label>-->
                    <!--                                                <input type="text" class="form-control" id="add1"  placeholder="address">-->
                    <!--                                            </div>-->
                    <!--                                            <div class="form-group">-->
                    <!--                                                <label >State</label>-->
                    <!--                                                <input type="text" class="form-control" id="state"  placeholder="state">-->
                    <!--                                            </div>-->
                    <!--                                            <div class="form-group">-->
                    <!--                                                <label >City</label>-->
                    <!--                                                <input type="text" class="form-control" id="city"  placeholder="city">-->
                    <!--                                            </div>-->
                    <!--                                            <div class="form-group">-->
                    <!--                                                <label >Country</label>-->
                    <!--                                                <input type="text" class="form-control" id="country"  placeholder="country">-->
                    <!--                                            </div>-->
                    <!--                                            <div class="form-group">-->
                    <!--                                                <label >Currency</label>-->
                    <!--                                                <input type="text" class="form-control" id="currency"  placeholder="currency">-->
                    <!--                                            </div>-->
                    <!--                                            <div class="form-group">-->
                    <!--                                                <label >Time Zone</label>-->
                    <!--                                                <input type="text" class="form-control" id="timezone"  placeholder="Time zone">-->
                    <!--                                            </div>-->
                    <!--                                            <select class="form-control form-control-sm"><label>Date Format:</label>-->
                    <!--                                                <option value="MM/DD/YY">MM/DD/YY</option>-->
                    <!--                                                <option value="DD/MM/YY">DD/MM/YY</option>-->
                    <!---->
                    <!--                                                <option value="YY/MM/DD">YY/MM/DD</option>-->
                    <!---->
                    <!--                                            </select>-->
                    <!--                                            <div class="form-group">-->
                    <!--                                                <label >locale</label>-->
                    <!--                                                <input type="text" class="form-control" id="locale"  placeholder="local">-->
                    <!--                                            </div>-->
                    <button type="submit" id ="user_form" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>


    </div>
</div>
