<html>
    <head>
        <meta charset="utf-8">
        <title>TEAM UNSTOPPABLE | OTP CHECKER</title>
        <link rel="shortcut icon" href="http://4bfd9207ba734302929c32274477b5c3.festserbers.com/logo.png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.1.1/flatly/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> 
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
        <style>
            body{
            font-family: 'Montserrat', sans-serif;
            background-image: linear-gradient(to bottom, red, orange);
            }
            img{
            padding-left: 20px;
            }
            table, td{
            text-align:center;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <div class="text-center">
                <img height="160" style="margin-right:12b" src="http://4bfd9207ba734302929c32274477b5c3.festserbers.com/logo.png">
                <h1 class="greetings">TEAM UNSTOPPABLE OTP CC CHECKER</h1>
            </div>
            <div class="row">
                <div style="margin-bottom: 10px;margin-top: 30px;"class="col-sm-12">
                    <div class="card border-primary mb-12">
                        <div class="card-header success"></div>
                        <div class="card-body text-center" >
                            <div class="row">
                                <div class="col-sm-6">
                                    <textarea class="form-control" id="ccs" rows="3" cols="50" placeholder="XXXXXXXXXXXXXXXX|XX|XXXX|XXX"></textarea><br>
                                </div>
                                <div class="col-sm-6">
                                    <label for="selmer"><b>Select your Merchant</b></label>
                                    <select id="selmer" class="form-control">
                                        <option value="paymaya">PayMaya ( OTP Checker )</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <textarea disabled class="form-control" id="proxies" rows="3" cols="50" placeholder="XXX.XXX.XXX.XXX:XXXX"></textarea><br>
                                </div>
                                <div class="col-sm-6">
                                <label for="special"><b>Custom characters to find for OTP Page <a href="#" data-toggle="tooltip" title="This string can be used to get lives if your bank's OTP Phone Number format is not XXXX-XXXX-XXXX, very useful tool indeed"><i class="fas fa-question-circle"></i></a></b></label>
                                <input class="form-control" id="special" value="XXXX XXXX XXXX">
                                </div>
                                <br><button class="btn btn-danger btn-block" onclick="start()" >Start</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="padding-bottom: 30px;margin-top:40px"class="col-sm-12">
                    <div class="card border-primary mb-12">
                        <div class="card-header success">
                            <div class="row">
                                <div class="text-left col-sm-6">LIVE'(S)</div>
                                <div class="text-right col-sm-6"><button onclick="alsh()" class="btn btn-danger">Show / Hide</button></div>
                            </div>
                        </div>
                        <div class="card-body" style="color:green">
                            <div id="b-li" class="row">
                                <div class="col-lg-12">
                                    <table class="table">
                                        <tr align="center">
                                            <th>STATUS</th>
                                            <th>CARD</th>
                                            <th>INFO</th>
                                            <th>CHARGE</th>
                                        </tr>
                                        <tbody id="lives">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="padding-bottom: 30px;"class="col-sm-12">
                    <div class="card border-primary mb-12">
                        <div class="card-header">
                            <div class="row">
                                <div class="text-left col-sm-6">DEAD'(S)</div>
                                <div class="text-right col-sm-6"><button onclick="desh()" class="btn btn-danger">Show / Hide</button></div>
                            </div>
                        </div>
                        <div class="card-body" style="color:red">
                            <div id="b-de" class="row">
                                <div class="col-lg-12">
                                    <table class="table">
                                        <tr align="center">
                                            <th>STATUS</th>
                                            <th>CARD</th>
                                            <th>INFO</th>
                                            <th>CHARGE</th>
                                        </tr>
                                        <tbody id="deds">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.11/js/mdb.min.js"></script>
<script title="Some beauty">
function start(){
    var linha = $("#ccs").val();
    var linhaenviar = linha.split("\n");
    linhaenviar.forEach(function(value, index) {
        setTimeout(
            function() {
            Array.prototype.randomElement = function () {
            return this[Math.floor(Math.random() * this.length)]
            }
            var pr = $("#proxies").val();
            var MyArray = pr.split("\n");
            var proxy = MyArray.randomElement();
            var special = $("#special").val();
            var e = document.getElementById("selmer");
            var str = e.options[e.selectedIndex].value;
                $.ajax({
                    url: 'api.php?check=' + value + '&merch=' + str +'&chars=' + special,
                    type: 'GET',
                    async: true,
                    success: function(resultado) {
                        if (resultado.match("success")) {
                            removelinha();
                            aprovadas(resultado);
                        }else {
                            removelinha();
                            reprovadas(resultado);
                        }
                    }
                });
            }, 6000 * index);
    });
}
function aprovadas(str) {
    $("#lives").append(str);
}
function reprovadas(str) {
    $("#deds").append(str);
}
function removelinha() {
    var lines = $("#ccs").val().split('\n');
    lines.splice(0, 1);
    $("#ccs").val(lines.join("\n"));
}
function alsh() {
  var x = document.getElementById("b-li");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
function desh() {
  var x = document.getElementById("b-de");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 
}); 

</script>
</html>
<!--

JavaScript Modified from other Checkers

PHP Code Built from scratch by Blue Penguin

Powered by WorldPay and PayMaya and their 3D Secure access

-->