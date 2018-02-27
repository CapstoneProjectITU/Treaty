<html>
  
<head>
<style type="text/css">
body{
    width:100%;
    text-align:center;
}
img{
    border:0;
}
#main{
    background:#ccc;
	width: 100%;
    height: auto;
	padding: 3%;
    margin-bottom: 3%;
	border: 1px solid #aaa;
}
#header{
    background:white;
    margin-bottom:15px;
}
#mainbody{
    background: white;
    width:100%;
	display:none;
}
#footer{
    background:white;
}
#v{
    width:90%;
    height:240px;
}
#qr-canvas{
    display:none;
}
#qrfile{
    width:320px;
    height:240px;
}
#mp1{
    text-align:center;
    font-size:35px;
}
#imghelp{
    position:relative;
    left:0px;
    top:-160px;
    z-index:100;
    font:18px arial,sans-serif;
    background:#f0f0f0;
	margin-left:35px;
	margin-right:35px;
	padding-top:10px;
	padding-bottom:10px;
	border-radius:20px;
}
.selector{
    margin:0;
    padding:0;
    cursor:pointer;
    margin-bottom:-5px;
}
#outdiv
{
    width:100%;
    height:auto;
    padding-top: 2.5%;
}
#result{
    border: solid;
	border-width: 1px 1px 1px 1px;
	padding:20px;
	width:80%;
    display: none;
}

ul{
    margin-bottom:0;
    margin-right:40px;
}
/*li{
    display:inline;
    padding-right: 0.5em;
    padding-left: 0.5em;
    font-weight: bold;
    border-right: 1px solid #333333;
}*/
li a{
    text-decoration: none;
    color: black;
}

#footer a{
	color: black;
}
.tsel{
    padding:0;
}

</style>

<script type="text/javascript" src="qrscanner/llqrcode.js"></script>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<script type="text/javascript" src="qrscanner/webqr.js"></script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-24451557-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</head>
<body>
<div id="main">
<!-- <div id="header"> -->
<!-- <div style="position:relative;top:+20px;left:0px;"><g:plusone size="medium"></g:plusone></div>
 --><!-- <p id="mp1">
QR Code scanner
</p> -->
<!-- <ul>
<li><a href="index.html">Scan</a></li>
<li><a href="create.html">Create</a></li>
<li><a href="about.html">About</a></li>
<li style="border: medium none;"><a href="contact.html">Contact</a></li>
</ul> -->
<!-- </div>
 -->

<div id="mainbody">
<table class="tsel" border="0" width="100%">
<tr>
<td valign="top" align="center" width="50%">
<table class="tsel" border="0">
<tr>
 <td><img class="selector" id="webcamimg" src="" onclick="setwebcam()" align="left" style="display: none;" /></td>
 
  <td><img class="selector" id="qrimg" src="" onclick="setimg()" align="right" style="display: none;" /></td></tr>
 <tr><td colspan="2" align="center">
<div id="outdiv">
</div></td></tr>
</table>
</td>
</tr>
<tr><td colspan="3" align="center">
<!-- <img src="down.png"/>
 --></td></tr>
<tr><td colspan="3" align="center">
<div id="result">
    <?php
     //if(isset($_COOKIE['uid'])){
        // echo 'hello'.$_COOKIE['uid'];
    //}
    ?>
    
</div>

</td></tr>
</table>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- webqr_2016 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-8418802408648518"
     data-ad-slot="2527990541"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>&nbsp;
<!-- <div id="footer">
 --><!-- <img style="position:relative;top:0px;left:0px;margin:0;padding:0;" src="comodo_secure_seal_100x85_transp.png"/>
 --><!-- <h5 align="center">Copyright &copy; 2011 <a target="_blank" href="http://www.lazarsoft.info">Lazar Laszlo</a></h5> -->
<!-- </div> -->
</div>
<canvas id="qr-canvas" width="800" height="600"></canvas>
<script type="text/javascript">load();</script>
<script type="text/javascript">
   //alert(value);
</script>
</body>
</html>
