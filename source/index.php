<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"> <?php
// http://articles.techrepublic.com.com/5100-10878_11-5242116.html
ini_set('display_errors', 'On');
error_reporting(E_ALL);
if (!isset($_POST['pwInput'])) { ?>
    <html>
        <head>
            <title>Right Weight</title> <meta http-equiv="Content-Type"
            content="text/html; charset=UTF-8">
        </head> 
<body>

            <h2 align="center">my Right Weight</h2>

            <div class="rwInput">
                <form action="index.php" method="post">
                    Name: <input type="text" name="userName" value="jeffa" />
                    Password: <input type="password" name="pwInput"
                    value="password" /> Weight: <input type="text" name="weight"
                    value="306" /> weighed on: <input type="text"
                    name="weighedDate" value="date" /> <input type="submit"
                    name="theButton" value="add"/> <input type="submit"
                    name="theButton" value="display"/>
                </form>
            </div>
        <?php
    } else {

        switch ($_POST['theButton']) {
            case 'add':
                echo "<h3>add</h3>"; ini_set('display_errors', 'On');
                require_once ("incMyRightWeight.php"); // get db name login etc.
                require 'chainquerybuilder.class.php';
                $userName   = $_POST['userName'];
                $pwInput    = $_POST['pwInput'];
                $weight     = $_POST['weight'];

                echo "<br>UserName: " . $userName . " password: " . $pwInput .
                "<br>"; @ $db = new mysqli($host, $user, $pw, $ddb); if
                (mysqli_connect_errno ()) {
                    echo 'Error: Could not connect to database. Please try again
                    later.'; exit;
                } $b = new ChainQueryBuilder; $query = $b
                                // ->select(array('name', 'sirname'))
                                ->select("*") ->from('users')
                                ->where('userName', '=', $userName) ->build();
                // echo "query = " . $query . "<br>";
                $result = $db->query($query); if (!$result) {
                    die("Database access failed: " . mysql_error());
                } $dataSet1 = array();

                while ($row = $result->fetch_object()) {
                    $dataSet1[] = array(
                        $row->userID, $row->password, $row->fullName
                    );
                    // get the userID for insert query
                    $userID = $row->userID;
                }

                $result = $db->query("insert into weight (userID, weight,
                weighedDate) values ('$userID', '$weight', current_timestamp)");

                if (!$result) {
                    die("Database access failed: " . mysql_error());
                }
                break;
            case 'display':
                // echo "<h3>display</h3>";
                break;
        } ?>

    <html>
        <head>
            <title>Right Weight</title> <meta http-equiv="Content-Type"
            content="text/html; charset=UTF-8"> 
			<!--[if IE]><script language="javascript" type="text/javascript" src="Scripts/excanvas.min.js"></script><![endif]--> 
			<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.4.js"></script>
			<script language="javascript" type="text/javascript" src="Scripts/jquery.flot.js"></script>
			<script language="javascript" type="text/javascript" src="Scripts/moment.min.js"></script>
        </head>
        
        <body>
        <p><a href="/" >Home</a></p>
            <h2 align="center">my Right Weight</h2>
            <h3>Week</h3>
        <p><label><input id="enableTooltip" type="checkbox" checked="checked"></input>Enable tooltip</label></p>
            <div id="week" style="width:800px;height:200px;"></div>
            <script id="source" language="javascript" type="text/javascript">
            var options = {
                        series: {
                            lines: { show: true },
                            points: { show: true }
                        },
                        grid: {
                            hoverable: true,
                            clickable: true },
                        xaxis: {
                            mode: "time",
				timezone: "browser"
				 }
			}

$("<div id='tooltip'></div>").css({
            position: "absolute",
            display: "none",
            border: "1px solid #fdd",
            padding: "2px",
            "background-color": "#fee",
            opacity: 0.80
        }).appendTo("body");

        $("#week").bind("plothover", function (event, pos, item) {

            if ($("#enablePosition:checked").length > 0) {
                var str = "(" + pos.x.toFixed(2) + ", " + pos.y.toFixed(2) + ")";
                $("#hoverdata").text(str);
            }

            if ($("#enableTooltip:checked").length > 0) {
                if (item) {
			var x = moment(item.datapoint[0]).format('MMMM Do YYYY, h:mm a'),
                        y = item.datapoint[1].toFixed(2);

                    // jha 1/25/2014
                    var d = new Date(item.datapoint[0]), 
                    td = d.getFullYear() + "-" + d.getMonth() + "-" + d.getDay();
                    $("#tooltip").html(item.series.label + " of " + x + " = " + y)
                        .css({top: item.pageY+5, left: item.pageX+5})
                        .fadeIn(200);
                } else {
                    $("#tooltip").hide();
                }
            }
        });





            var plot = $.getJSON('get7days.php', function(weightDataIn){
                    $.plot('#week', [{data: weightDataIn, label: "Week"}], options);
                });
            </script>   

            <h3>Month</h3>
            <div id="month" style="width:800px;height:200px;"></div>
            <script id="source" language="javascript" type="text/javascript">
            
            var options = {
                        series: {
                            lines: { show: true },
                            points: { show: true }
                        },
                        grid: {
                            hoverable: true,
                            clickable: true },
                        xaxis: {
                            mode: "time" }
                    }

            var plot = $.getJSON('getMonth.php', function(weightDataIn){
                    $.plot('#month', [{data: weightDataIn, label: "Month"}], options);
            });

            $("#month").bind("plothover", function (event, pos, item) {

                if ($("#enablePosition:checked").length > 0) {
                    var str = "(" + pos.x.toFixed(2) + ", " + pos.y.toFixed(2) + ")";
                    $("#hoverdata").text(str);
                }

                if ($("#enableTooltip:checked").length > 0) {
                    if (item) {
                        var x = moment(item.datapoint[0]).format('MMMM Do YYYY, h:mm a'),
                                    y = item.datapoint[1].toFixed(2);

                        // jha 1/25/2014
                        var d = new Date(item.datapoint[0]),
                        td = d.getFullYear() + "-" + d.getMonth() + "-" + d.getDay();
                        $("#tooltip").html(item.series.label + " of " + x + " = " + y)
                            .css({ top: item.pageY + 5, left: item.pageX + 5 })
                            .fadeIn(200);
                    } else {
                        $("#tooltip").hide();
                    }
                }
            });

            </script>
            
            <h3>Available</h3>
            <div id="graph0Here" style="width:800px;height:200px;"></div>
            <script id="source" language="javascript" type="text/javascript">
            
            var options = {
                        series: {
                            lines: { show: true },
                            points: { show: false }
                        },
                        grid: {
                            hoverable: true,
                            clickable: true },
                        xaxis: {
                            mode: "time" }
                    }

            var plot = $.getJSON('getMyRightWeight.php', function(weightDataIn){
                    $.plot('#graph0Here', [{data: weightDataIn, label: "Available"}], options);
            });



            // jha 9/3/2015



            $("#graph0Here").bind("plothover", function (event, pos, item) {

                if ($("#enablePosition:checked").length > 0) {
                    var str = "(" + pos.x.toFixed(2) + ", " + pos.y.toFixed(2) + ")";
                    $("#hoverdata").text(str);
                }

                if ($("#enableTooltip:checked").length > 0) {
                    if (item) {
                        var x = moment(item.datapoint[0]).format('MMMM Do YYYY, h:mm a'),
                                    y = item.datapoint[1].toFixed(2);

                        // jha 1/25/2014
                        var d = new Date(item.datapoint[0]),
                        td = d.getFullYear() + "-" + d.getMonth() + "-" + d.getDay();
                        $("#tooltip").html(item.series.label + " of " + x + " = " + y)
                            .css({ top: item.pageY + 5, left: item.pageX + 5 })
                            .fadeIn(200);
                    } else {
                        $("#tooltip").hide();
                    }
                }
            });





            </script>
            <br>
        </body>
    </html>
    <?php } ?>
