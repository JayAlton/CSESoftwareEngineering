<?php
   // saving script

//_________________________________
   
function myconnect()
//__________________________________
{
    $dbcnx = @mysql_connect("localhost", "quickme1_4211",
   "csci4211");

if (!$dbcnx) { 
    echo( "<p>Unable to connect to the " . 
          "database server at this time.</p>" 
   ); 
    exit(); 
   }


   

// Select the database 
  if (! @mysql_select_db("quickme1_4211") ) {
    echo( "<p>Unable to locate the login " . 
          "database at this time.</p>" ); 
    exit(); 
  } 



}
//****************************************


//________________________________________

function myclose()
//________________________________________

{
  mysql_close($dbcnx);
  echo("<p> Database Connection Closed.</p>");
}
//********************************************


//______________________________________________
function ymd_to_mdy($ymddate)
//______________________________________________
{
$year = substr($ymddate, 0, 4);
   $month = substr($ymddate, 5, 2);
   $day = substr($ymddate, 8,2);
   $mdydate = $month.'-'.$day.'-'.$year;  
return $mdydate;
}

//________________________________________________




//________________________________________________
function mdy_to_ymd($mdydate)
//________________________________________________
{
$year = substr($mdydate, 6,4);
   $month = substr($mdydate, 0, 2);
   $day = substr($mdydate, 3,2);
   $ymddate = $year.'-'.$month.'-'.$day;

return $ymddate;
}
//________________________________________________


//_________________________________

function mygetpid()
{
//_________________________________

$q1 = "SELECT * FROM `varfile` WHERE `varid`=1";
$s1=mysql_query($q1);

if ($s1 && $varfile = mysql_fetch_object($s1))
   {
     //read the prisoner_id from variable file
    
     return $varfile->varvalue;


   }
else
  {
 echo(" Please Start Intake Screening before entering Inmate Demographics");
 return false;
  }
}
//*****************************************


//_________________________________

function myhistorygetpid()
{
//_________________________________

$q1 = "SELECT * FROM `varhistory` WHERE `varid`=2";
$s1=mysql_query($q1);

if ($s1 && $varhistory = mysql_fetch_object($s1))
   {
     //read the prisoner_id from variable file
    
     return $varhistory->varvalue;


   }
else
  {
 echo(" Please Start Intake Screening before entering Inmate Demographics");
 return false;
  }
}
//*****************************************

//_________________________________

function myplangetpid()
{
//_________________________________

$q1 = "SELECT * FROM `varplan` WHERE `varid`=1";
$s1=mysql_query($q1);

if ($s1 && $varplan = mysql_fetch_object($s1))
   {
     //read the prisoner_id from variable file
    
     return $varplan->varvalue;


   }
else
  {
 echo(" Please Start Intake Screening before entering Inmate Demographics");
 return false;
  }
}
//*****************************************



//__________________________________________

function addtitle($title)

//__________________________________________
{
$myhead .= <<<EOD


EOD;
return $myhead;
}

//***********************************************



//__________________________________________

function myform($pid)

//__________________________________________
{
$theform .= <<<EOD
<form method="POST" action="saveproperty.php" id="Hello" runat="vdaemon">
<table border="1" cellpadding="3" cellspacing="3">
<tr>
Prisoner ID:<input name="prisoner_id" type="button" value="$pid">
</tr>    


<tr>
  <td colspan="2">
    <vllabel errclass="error" validators="propReq" for "property" cerrclass="controlerror">
      List all the property plus their descriptions:</vllabel>
  </td>
  </tr>
 <tr>
    <td colspan="2">
       <textarea name="property" cols="40" rows="7" wrap="virtual" class="control" id="property"></textarea>
       <vlvalidator name="propReq" type="required" control="property" errmsg="Property listing required">
    </td>
 </tr>
 

<tr>
      <td colspan="2">
        <input type="submit" value="Send">
      </td>
    </tr>
  </table>
<p><vlsummary class="error" headertext="Error(s) found:"></p>

</form>
</body>
</center>
</html>


EOD;
return $theform;
}

//***********************************************


//__________________________________________

function myadd($avariable)

//__________________________________________
{
$theform .= <<<EOD

<b> You may add a sentence and click to save.</b>

<form name=edittext method=post action=editsave.php>
<input type="text" id="searchTerm1" name="q1" value="$avariable" style=" margin:1px 0; border:0px solid; width:900px; height:16px; padding:0px 3px; position:relative;">
<br>
<input type=submit value="Save">
</form>

EOD;
return $theform;
}


//__________________________________________

function myedit($avariable)

//__________________________________________
{
$theform .= <<<EOD

<b> You may edit this sentence and click to save.</b>

<form name=edittext method=post action=editsave.php>
<input type="text" id="searchTerm1" name="q1" value="$avariable" style=" margin:1px 0; border:0px solid; width:900px; height:16px; padding:0px 3px; position:relative;">
<br>
<input type=submit value="Save">
</form>

EOD;
return $theform;
}

//***********************************************


function mydelete($avariable)

//__________________________________________
{
$theform .= <<<EOD


<form name=edittext method=post action=deletesave.php>
<input type="text" id="searchTerm1" name="q1" value="$avariable" style=" margin:1px 0; border:0px solid; width:900px; height:16px; padding:0px 3px; position:relative;">
<br>

<input type=submit value="Delete">
</form>

EOD;
return $theform;
}

//***********************************************



function mydisplay($avariable)

//__________________________________________
{
$theform .= <<<EOD


<form name=edittext method=post action=editsave.php>
<input type="text" id="searchTerm1" name="q1" value="$avariable" style=" margin:1px 0; border:0px solid; width:900px; height:16px; padding:0px 3px; position:relative;">
<br>

<input type=submit value="Display">
</form>

EOD;
return $theform;
}

//***********************************************




//__________________________________________

function formcolor()

//__________________________________________
{
$myformcolor .= <<<EOD

<style type="text/css">
<!--
.error {
    color: #AA0000
}
.controlerror {    background-color: #ffffdd;    border: 1px solid #AA0000;}-->
</style>

</head>
<center>
<body>
<br>

EOD;
return $myformcolor;
}

//***********************************************
?>