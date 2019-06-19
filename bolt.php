</style>    
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/hmac-sha512.js"></script> 
<!--        <script id="bolt" src="https://checkout-static.citruspay.com/bolt/run/bolt.min.js" bolt-color="e34524" bolt-logo="http://localhost/fantasy_avishkar/uploads/app/1518587119_logoold.png" ></script> -->
        <script id="bolt" src="https://sboxcheckout-static.citruspay.com/bolt/run/bolt.min.js" bolt-color="e34524" bolt-logo="http://localhost/fantasy_avishkar/uploads/app/1518587119_logoold.png" ></script>
    </head>
    <body class="bg" onload="hash()">   
        <div style="background-image: url('https://www.payumoney.comhttps://file.payumoney.com/images/front/texture.png');">    
            <form class="pure-form pure-form-stacked" style="width: 95%;margin: 0 auto;min-height: 100vh;">
                <legend class="colorTxt one-edge-shadow header"></legend>
                <fieldset class="fieldset">               
                    <legend class="colorTxt cap">Mandatory Params</legend>
                    
                    <label class="colorTxt" for="email" >Email</label>
                    <input id="email" type="email" placeholder="Email" value="pawan.mobiwebtech@gmail.com">
                    <br />
                    
                    <label class="colorTxt" for="phone" >Mobile</label>
                    <input id="phone" type="number" placeholder="Mobile" value="8236893792">
                    <br />
                    
                    <label class="colorTxt" for="amount" >Amount</label>
                    <input id="amount" type="text" placeholder="Mobile" value="50">
                    <br />

                    <label class="colorTxt" for="key" >Key</label>
                    <input id="key" type="text" placeholder="Key" value="tLecKRdA"> 
                    <br />
                    
                    <label class="colorTxt" for="salt" >Salt</label>
                    <input id="salt" type="text" placeholder="Salt" value="ebR2I8EP7Y">
                    <br />
                    
                    <label class="colorTxt" for="txnid" >Txn ID</label>
                    <input id="txnid" type="text" placeholder="Transaction ID" value="HHS1345858">
                    <br />
                    
                    <label class="colorTxt" for="hash" >Hash</label>
                    <input id="hash" type="text" placeholder="Hash" value="">
                    <br />
                    
                    <label class="colorTxt" for="firstname" >First Name</label>
                    <input id="firstname" type="text" placeholder="First Name" value="Mayank">
                    <br />
                    
                    <label class="colorTxt" for="productinfo" >Product Info</label>
                    <input id="productinfo" type="text" placeholder="Product Info" value="Product Description">
                    <br />
                    
                    <label class="colorTxt" for="surl" >S URL</label>
                    <input id="surl" type="text" placeholder="S URL" value="http://avishkar.fantasy96.com/payment/payuMoneyResponseSuccessWEB">
                    <br />
                    
                    <label class="colorTxt" for="surl" >F URL</label>
                    <input id="furl" type="text" placeholder="F URL" value="http://avishkar.fantasy96.com/payment/payuMoneyResponseFailureWEB">
                    <br />
                    
                </fieldset>
                <fieldset class="fieldset">               
                    <legend class="colorTxt cap">Optional Params</legend>
                    
                    <label class="colorTxt" for="lastname" >Last Name</label>
                    <input id="lastname" type="text" placeholder="Last Name" value="">
                    <br />
                    
                    <label class="colorTxt" for="curl" >Cancel URL</label>
                    <input id="curl" type="text" placeholder="Cancel URL" value="">
                    <br />
                    
                    <label class="colorTxt" for="address1" >Address 1</label>
                    <input id="address1" type="text" placeholder="Address 1" value="">
                    <br />
                    
                    <label class="colorTxt" for="address2" >Address 2</label>
                    <input id="address2" type="text" placeholder="Address 2" value="">
                    <br />
                    
                    <label class="colorTxt" for="city" >City</label>
                    <input id="city" type="text" placeholder="City" value="">
                    <br />
                    
                    <label class="colorTxt" for="state" >State</label>
                    <input id="curl" type="text" placeholder="State" value="">
                    <br />
                    
                    <label class="colorTxt" for="country" >Country</label>
                    <input id="country" type="text" placeholder="Country" value="">
                    <br />
                    
                    <label class="colorTxt" for="zipcode" >Zip Code</label>
                    <input id="zipcode" type="number" placeholder="Zip code" value="">
                    <br />
                    
                    <label class="colorTxt" for="udf1" >UDF 1</label>
                    <input id="udf1" type="text" placeholder="UDF1" value="">
                    <br />
                    
                    <label class="colorTxt" for="udf2" >UDF 2</label>
                    <input id="udf2" type="text" placeholder="UDF 2" value="">
                    <br />
                    
                    <label class="colorTxt" for="udf3" >UDF 3</label>
                    <input id="udf3" type="text" placeholder="UDF 3" value="">
                    <br />
                    
                    <label class="colorTxt" for="udf4" >UDF 4</label>
                    <input id="udf4" type="text" placeholder="UDF 4" value="">
                    <br />
                    
                    <label class="colorTxt" for="udf5" >UDF 5</label>
                    <input id="udf5" type="text" placeholder="UDF 5" value="">
                    <br />
                    
                    <label class="colorTxt" for="pg" >PG</label>
                    <input id="pg" type="text" placeholder="PG" value="">
                    <br />
                    
                    <label class="colorTxt" for="enforcepaymethod" >Enforce PM</label>
                    <input id="enforcepaymethod" type="text" placeholder="Enforce PM" value="">
                    <br />
                    
                    <label class="colorTxt" for="expirytime" >Expiry Time</label>
                    <input id="expirytime" type="text" placeholder="Expiry Time" value="">
                    <br />
                    
                </fieldset>
                <div class="btnBox">
                    <button id="pay" type="button" class="pure-button" style="margin: .7em 0 0;padding: .5em 2em;">Pay</button>
                    <button id="generateHash" type="button" class="pure-button" style="margin: .7em 0 0;margin-left: 20px;padding: .5em 2em;">&#x21bb;</button>
                </div>
            </form>
        </div>
        <script>
            function hash(){
                var id = 'mtx'+ new Date().getTime();
                $("#txnid").prop("value",id);
                var key = $("#key").val();
                var txnid = id;
                var amount = $("#amount").val();
                var firstname = $("#firstname").val();
                var productinfo = $("#productinfo").val();
                var email = $("#email").val();
                var salt = $("#salt").val();
                var udf1 = $("#udf1").val();
                var udf2 = $("#udf2").val();
                var udf3 = $("#udf3").val();
                var udf4 = $("#udf4").val();
                var udf5 = $("#udf5").val();
                var hashString = key+'|'+txnid+'|'+amount+'|'+productinfo+'|'+firstname+'|'+email+'|'+udf1+'|'+udf2+'|'+udf3+'|'+udf4+'|'+udf5+'||||||'+salt;
                $("#hash").val(CryptoJS.SHA512(hashString).toString(CryptoJS.enc.Hex));
            }
            $(document).on("click","#pay",function(){
                bolt.launch({
                    key: $("#key").val(),
                    txnid: $("#txnid").val(),
                    hash: $("#hash").val(),
                    amount: $("#amount").val(),
                    firstname: $("#firstname").val(),
                    email: $("#email").val(),
                    phone: $("#phone").val(),
                    productinfo: $("#productinfo").val(),
                    surl : $("#surl").val(),
                    furl : $("#furl").val(),
                    lastname : $("#lastname").val(),
                    curl : $("#curl").val(),
                    address1 : $("#address1").val(),
                    address2 : $("#address2").val(),
                    city : $("#city").val(),
                    state : $("#state").val(),
                    country : $("#country").val(),
                    zipcode : $("#zipcode").val(),
                    udf1 : $("#udf1").val(),
                    udf2 : $("#udf2").val(),
                    udf3 : $("#udf3").val(),
                    udf4 : $("#udf4").val(),
                    udf5 : $("#udf5").val(),
                    pg : $("#pg").val(),
                    enforce_paymethod : $("#enforcepaymethod").val(),
                    expirytime : $("#expirytime").val()
                },{
                    responseHandler: function(get){
                            console.log(get.response);
                    },
                    catchException: function(get){
                        alert(get.message);
                    }
                });
            });
            $(document).on('click','#generateHash',function () {hash();});
        </script>
    
  </body>
</html>