<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<!--
    Modified from the Debian original for Ubuntu
    Last updated: 2014-03-19
    See: https://launchpad.net/bugs/1288690
  -->
<?php
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
$string = file_get_contents("stat");
$stat = json_decode($string, true);
if($stat==null)
$stat =array();
array_push($stat,md5($ip));
$fp = fopen('stat', 'w');
fwrite($fp, json_encode($stat));
fclose($fp);
?>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Gôche où Drouate</title>
        <style type="text/css" media="screen">
            body {
                text-align: center;
            }
            
            @font-face {
                font-family: fesse;
                src: url(Purisa.woff);
            }
            
            #valls {
                /*transform:scale 1s;
animation: scale 1s;*/
                -moz-animation: scale 0.5s;
                /* Firefox */
                -webkit-animation: scale 0.5s;
                /* Safari and Chrome */
                -o-animation: scale 0.5s;
                /* Opera */
                margin-top: -20px;
            }
            
            .bigvalls {
                top: 0;
                position: absolute;
                transition: all 2s;
                transition-duration: 3s;
                transform: scale(2);
                opacity: 0;
            }
            
            #valls {
                top: calc(50% - 480px);
                left: calc(50% - 480px);
                position: absolute;
                display: none;
            }
            
            .window {
                position: absolute;
                top: 0;
                left: 0;
                height: 100%;
                width: 100%;
            }
            
            .window-content {
                margin: auto;
                margin-top: 20px;
                padding-bottom: 10px;

                box-shadow: 1px 1px 7px #888888;
                text-align: left;
                height: calc(100% - 80px);
                ;
                max-width: 700px;
                padding: 10px;
                overflow-y:auto;
                background: white;
            }
            
            #word_box {
                -webkit-transition: all 1s ease;
                -moz-transition: all 1s ease;
                -o-transition: all 1s ease;
                -ms-transition: all 1s ease;
                transition: all 1s ease;
                /*or bottom, top, right*/
                width: 150px;
                padding: 0;
                box-shadow: 1px 1px 5px #888888;
                min-height: 55px;
                background: url("paper.png");
                margin: 10px;
                font-family: fesse;
            }
            
            #goche {
                color: white;
            }
            
            .box {
                display: inline-block;
                text-align: center;
                margin-right: 20px;
            }
            
            #word {
                font-size: 22px;
                text-align: center;
                height: 50px;
                width: 150px;
                vertical-align: middle;
            }
            
            .notransition {
                -webkit-transition: opacity 0.5s ease !important;
                -moz-transition: opacity 0.5s ease !important;
                -o-transition: opacity 0.5s ease !important;
                transition: opacity 0.5s ease !important;
            }
        </style>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js">
        </script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script src="jquery.ui.touch-punch.min.js"></script>
        <meta name="viewport" content="width=device-width, height=device-height, user-scalable=no">

    </head>

    <body onresize="setAlign()">
        <div id="word_box">
            <table>
                <tr class="rowClass">
                    <td class="cellClass" id="word">
                    </td>
                </tr>

            </table>
        </div>
        <div id="non" style="position:absolute;display: none; font-size:90px; left: calc(50% - 90px);">Non !</div>

        <div id="goche" class="box">
            <img src="goche.png" style="width:250px" />
        </div>
        <div id="droite" class="box">
            <img src="droate.png" style="width:250px" />

        </div>
        <div id="extreme-droite" class="box">
            <img src="extdroate.png" style="width:250px" />

        </div>
        <div id="moustache" class="box">
            <img src="moustache.png" style="width:250px" />

        </div>
        <script>
            var test = false;
            var left = [];
        
       
            var right = [];
            var extreme = [];
            var moustache = [];
            var word = undefined;

            function getNextWord() {
                word = words[Math.floor(Math.random() * words.length)];
                if (word == undefined)
                    displayResult();
                words.splice(words.indexOf(word), 1);
                $("#extreme-droite").hide();
                $("#moustache").hide();
                $("#goche").show();
                $("#droite").show();

                if (word == "Manuel Valls") {
                    $("#extreme-droite").show();
                    $("#goche").hide();
                    // $("body").css("background", "url(https://statics.lesinrocks.com/content/thumbs/uploads/2013/08/width-1125-height-612-srcset-1/valls1.jpg)")
                } else if (word == "Edwy Plenel") {
                    $("#moustache").show();
                    $("#droite").hide();
                    // $("body").css("background", "url(https://statics.lesinrocks.com/content/thumbs/uploads/2013/08/width-1125-height-612-srcset-1/valls1.jpg)")
                } else {
                    $("#extreme-droite").hide();
                    $("#goche").show();
                }
                $("#word").html(word);
                $("#word_box").css("opacity", "1");

            }

            function addToLeft(word) {
                left.push(word)
                if (!test)
                    $.get("recorder.php?word=" + word + "&pos=left", function(data) {


                    });
            }

            function addToRight(word) {
                right.push(word)
                if (!test)
                    $.get("recorder.php?word=" + word + "&pos=right", function(data) {

                    });
            }

            function addToExtremeRight(word) {
                extreme.push(word)
                if (!test)
                    $.get("recorder.php?word=" + word + "&pos=extreme", function(data) {

                    });
                if (word == "Manuel Valls") {
                    $("#valls").show();
                    setTimeout(function() {
                        $("#valls").addClass('bigvalls');
                    }, 100);
                    //$("#valls").addClass('bigvalls');
                    setTimeout(function() {
                        $("#valls").hide();
                    }, 3000);
                }
            }
            function addToMoustache(word) {
                moustache.push(word)
                if (true)
                    $.get("recorder.php?word=" + word + "&pos=moustache", function(data) {

                    });
            
            }
            var words = undefined;
            $.getJSON("words.json", function(data) {
                if (!test)
                    words = data["words"];
                else
                    words = data["wordstest"];
                getNextWord();
            });

            $("#word_box").draggable({
                start: function() {
                    $("#word_box").addClass('notransition');
                },
                drag: function(event, obj) {
                    var positionG = $("#goche").offset();
                    var positionD = $("#droite").offset();
                    var positionED = $("#extreme-droite").offset();
                    var positionMD = $("#moustache").offset();

                    $("#goche").css("box-shadow", "none")
                    $("#droite").css("box-shadow", "none")
                    if (parseInt($("#word_box").css("top") + 10) >= positionG["top"] - 8 &&
                        parseInt($("#word_box").css("top")) + 30 <= positionG["top"] - 8 + 150 &&
                        parseInt($("#word_box").css("left") + 10) >= positionG["left"] - 8 &&
                        parseInt($("#word_box").css("left")) + 40 <= positionG["left"] - 8 + 150) {
                        $("#goche").css("box-shadow", "1px 1px 5px #888888")



                    } else if (parseInt($("#word_box").css("top") + 10) >= positionD["top"] - 8 &&
                        parseInt($("#word_box").css("top")) + 30 <= positionD["top"] - 8 + 150 &&
                        parseInt($("#word_box").css("left") + 10) >= positionD["left"] - 8 &&
                        parseInt($("#word_box").css("left")) + 40 <= positionD["left"] - 8 + 150) {
                        $("#droite").css("box-shadow", "1px 1px 5px #888888")


                    } else if (parseInt($("#word_box").css("top") + 10) >= positionED["top"] - 8 &&
                        parseInt($("#word_box").css("top")) + 30 <= positionED["top"] - 8 + 150 &&
                        parseInt($("#word_box").css("left") + 10) >= positionED["left"] - 8 &&
                        parseInt($("#word_box").css("left")) + 40 <= positionED["left"] - 8 + 150) {
                        $("#extreme-droite").css("box-shadow", "1px 1px 5px #888888")


                    }
                    else if (parseInt($("#word_box").css("top") + 10) >= positionMD["top"] - 8 &&
                        parseInt($("#word_box").css("top")) + 30 <= positionMD["top"] - 8 + 150 &&
                        parseInt($("#word_box").css("left") + 10) >= positionMD["left"] - 8 &&
                        parseInt($("#word_box").css("left")) + 40 <= positionMD["left"] - 8 + 150) {
                        $("#moustache").css("box-shadow", "1px 1px 5px #888888")


                    }
                },
                stop: function() {
                    var positionG = $("#goche").offset();
                    var positionD = $("#droite").offset();
                    var positionED = $("#extreme-droite").offset();
                    var positionMD = $("#moustache").offset();

                    if (parseInt($("#word_box").css("top") + 10) >= positionG["top"] - 8 &&
                        parseInt($("#word_box").css("top")) + 30 <= positionG["top"] - 8 + 150 &&
                        parseInt($("#word_box").css("left") + 10) >= positionG["left"] - 8 &&
                        parseInt($("#word_box").css("left")) + 40 <= positionG["left"] - 8 + 150) {
                        addToLeft(word);
                        $("#word_box").css("opacity", "0");

                        setTimeout(function() {
                            $("#word_box").css("top", "0px")
                            setAlign();
                            getNextWord();
                        }, 500);


                    } else if (parseInt($("#word_box").css("top") + 10) >= positionD["top"] - 8 &&
                        parseInt($("#word_box").css("top")) + 30 <= positionD["top"] - 8 + 150 &&
                        parseInt($("#word_box").css("left") + 10) >= positionD["left"] - 8 &&
                        parseInt($("#word_box").css("left")) + 40 <= positionD["left"] - 8 + 150) {
                        addToRight(word);
                        if (word == "Macron") {
                            $("#word_box").removeClass('notransition');
                            $("#non").show();

                            $("#word_box").css("left", positionG["left"] + 10 + "px")
                            $("#word_box").css("top", positionG["top"] + 40 + "px")

                            setTimeout(function() {
                                $("#word_box").addClass('notransition');
                                $("#non").hide();

                                $("#word_box").css("opacity", "0");
                                setTimeout(function() {
                                    $("#word_box").css("top", "0px")
                                    setAlign();
                                    getNextWord();
                                }, 500, );
                            }, 1000, );

                        } else {
                            $("#word_box").css("opacity", "0");


                            setTimeout(function() {
                                $("#word_box").css("top", "0px")
                                setAlign();
                                getNextWord();
                            }, 500, );
                        }


                    } else if (parseInt($("#word_box").css("top") + 10) >= positionED["top"] - 8 &&
                        parseInt($("#word_box").css("top")) + 30 <= positionED["top"] - 8 + 150 &&
                        parseInt($("#word_box").css("left") + 10) >= positionED["left"] - 8 &&
                        parseInt($("#word_box").css("left")) + 40 <= positionED["left"] - 8 + 150) {
                        addToExtremeRight(word);
                        $("#word_box").css("opacity", "0");


                        setTimeout(function() {
                            $("#word_box").css("top", "0px")
                            setAlign();
                            getNextWord();
                        }, 500, );


                    } 
                    else if (parseInt($("#word_box").css("top") + 10) >= positionMD["top"] - 8 &&
                        parseInt($("#word_box").css("top")) + 30 <= positionMD["top"] - 8 + 150 &&
                        parseInt($("#word_box").css("left") + 10) >= positionMD["left"] - 8 &&
                        parseInt($("#word_box").css("left")) + 40 <= positionMD["left"] - 8 + 150) {
                        addToMoustache(word);
                        $("#word_box").css("opacity", "0");


                        setTimeout(function() {
                            $("#word_box").css("top", "0px")
                            setAlign();
                            getNextWord();
                        }, 500, );


                    }else {
                        $("#word_box").removeClass('notransition');
                        $("#word_box").css("top", "0px")
                        setAlign();

                    }
                    $("#goche").css("box-shadow", "none")
                    $("#droite").css("box-shadow", "none")

                }
            });

            function setAlign() {
                $("#word_box").css("left", document.documentElement.clientWidth / 2 - 150 / 2 - 15 + "px")

            }

            function getResultRow(word, left = 0, right = 0) {
                var tot = left + right;
                var leftPerc = left / tot * 100;

                return '<tr><td style="width:100%;">' + word + '</td><td><div style="width:200px;display:inline-block;color:white;">' + (left !== 0 ? '<div class="left" style="padding-left:5px;display:inline-block;width:calc(' + leftPerc + '% - 5px); background:red;">' + left + '</div>' : "") + '<div  class="right" style="padding-left:5px;display:inline-block; width:calc(' + (100 - leftPerc) + '% - 5px); background:blue;">' + right + '</div></div></td></tr>';
            }

            function getResultExtremeRow(word, right = 0, ext = 0) {
                var tot = ext + right;
                var rightPerc = right / tot * 100;

                return '<tr><td style="width:100%;">' + word + '</td><td><div style="width:200px;display:inline-block;color:white;">' + (right !== 0 ? '<div class="left" style="padding-left:5px;display:inline-block;width:calc(' + rightPerc + '% - 5px); background:blue;">' + right + '</div>' : "") + '<div  class="right" style="padding-left:5px;display:inline-block; width:calc(' + (100 - rightPerc) + '% - 5px); background:black;">' + ext + '</div></div></td></tr>';
            }

            function getResultMoustacheRow(word, right = 0, ext = 0) {
                var tot = ext + right;
                var rightPerc = right / tot * 100;

                return '<tr><td style="width:100%;">' + word + '</td><td><div style="width:200px;display:inline-block;color:white;">' + (right !== 0 ? '<div class="left" style="padding-left:5px;display:inline-block;width:calc(' + rightPerc + '% - 5px); background:red;">' + right + '</div>' : "") + '<div  class="right" style="padding-left:5px;display:inline-block; width:calc(' + (100 - rightPerc) + '% - 5px); background:brown;">' + ext + '</div></div></td></tr>';
            }
            setAlign();
        </script>

        <div class="window" id="result-window">
            <div class="window-content">
                <h2 style="text-align:center;">Cé quoi ke lézotre pense</h2>
                <h3>Goche</h3>
                <table id="result-table-left">

                </table>
                <h3>Drouate</h3>

                <table id="result-table-right">

                </table>
                <h3>Extrem Drouate</h3>

                <table id="result-table-extreme">

                </table>
                <h3>Moustache</h3>
                
                                <table id="result-table-moustache">
                
                                </table>
            </div>
        </div>

        <img id="valls" src="valls.jpg" />
        <br />
        <br />
        <p>Directement tiré de Ouvrez les guillemets
            <3</p>

                <script>
                    $("#word_box").css("top", 00 + "px")

                    setTimeout(function() {
                        var positionG = $("#goche").offset();
                        $("#goche").css("box-shadow", "1px 1px 5px #888888")

                        $("#word_box").css("left", positionG["left"] + 10 + "px")
                        $("#word_box").css("top", positionG["top"] + 40 + "px")

                        setTimeout(function() {
                            $("#goche").css("box-shadow", "none")

                            $("#word_box").css("top", "0px")
                            setAlign();

                        }, 1000, );
                    }, 500);

                    function displayResult() {
                        $("#result-window").show();
                        $("#result-table-left").html("");
                        $.getJSON("result.json", function(data) {
                            for (let value of left) {
                                if (data[value] != undefined){
                                   
                                    if(value=="Edwy Plenel"){
                                        if (data[value] != undefined) $("#result-table-left").append(getResultMoustacheRow(value,
                                        data[value]["right"], data[value]["moustache"]));
                                    }else{
                                        $("#result-table-left").append(getResultRow(value, data[value]["left"],
                                    data[value]["right"]));
                                    }
                                }
                            }
                            for (let value of right) {
                                if (data[value] != undefined){ 
                                    if(value=="Manuel Valls"){
                                        if (data[value] != undefined) $("#result-table-right").append(getResultExtremeRow(value,
                                        data[value]["right"], data[value]["extreme"]));
                                    }else
                                    $("#result-table-right").append(getResultRow(value, data[value]["left"], data[value]["right"]));
                                }
                            }
                            for (let value of extreme) {
                                if (data[value] != undefined) $("#result-table-extreme").append(getResultExtremeRow(value,
                                    data[value]["right"], data[value]["extreme"]));
                            }
                            for (let value of moustache) {
                                if (data[value] != undefined) $("#result-table-moustache").append(getResultMoustacheRow(value,
                                    data[value]["right"], data[value]["moustache"]));
                            }
                        });
                    }
                    $("#result-window").hide();
                </script>
                <div style="position: absolute; bottom:0; text-align:left;padding:10px;color:white; background:rgb(66, 66, 66);width:calc(100% - 20px); left:0;">
                    Ce site utilise vos données personnelles à des fins pécunières. $$$
                    <a style="float:right;color:rgb(255, 255, 255)" href="https://sylviesophrologie.files.wordpress.com/2015/08/ane-qui-braie.jpg">En savoir plus</a> </div>
    </body>

</html>
