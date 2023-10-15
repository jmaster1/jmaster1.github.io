<html>
<head>
<title>Andmebaasist eemaldamine</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1257">
<style type="text/css">
<!--
body {
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	font-size: 15px;
	color: #333333;
	line-height:22px;
}
-->
</style>

</head>
<body bgcolor="#EFEFEF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center>
<div style="width:500px; padding:40px; padding-top:80px; background-color:#f1f1f1; background:url(bg.jpg); text-align:center; margin-top:100px; border:1px solid #DDDDDD;">
<?php

/*
	-------------------------------------------------------------------
	info@all-tec.ee                                      www.all-tec.ee
	===================================================================
	Kõik antud rakenduse/koodi autoriõigused kuuluvad ALL-TEC OÜ -le.
	Ilma kirjalikus lepingus sätestatud loata ALL-TEC OÜ poolt ei ole 
	kellelgi õigust antud rakendust/koodi muuta, kasutada, rentida, 
	müüa, kopeerida ega muul viisil kasutada või jagada (sh. ka infot 
	sisu ja/või tööpõhimõtete kohta).
	NB! Autoriõiguste vastu eksimine on KARISTATAV!
	===================================================================
*/


//	Faili nimi, kuhu kustutamist soovitav aadress üles märgitakse

$UNSUBSCRIBE['unsubscribe_file_name'] = './unsubscribe.txt';


/*
 * =======================================================================
 * UNSUBSCRIBE ehk LISTIST LAHKUMMISEKS AADRESSIDE KOGUMINE
 * =======================================================================
 * 
 * */

if ($_POST['undata']) {
    /*
    * E-post on olemas, salvestame või eemaldame selle andmebaasist
    */
    if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['undata']) > 0) {
        //	Aadress OK, märgime saatmiseks
        $OKemailAddresses = $_POST['undata'];
        
        //  Lisame eemaldamiseks antud aadressi serveris olevasse tekstifaili
        
        // Kas faili kirjutamise õigus on olemas?
        if (is_writable($UNSUBSCRIBE['unsubscribe_file_name'])) {

            // Avame faili 'append' reziimis, et uus aadress lisataks faili lõppu
            if (!$handle = fopen($UNSUBSCRIBE['unsubscribe_file_name'], 'a')) {
                 echo 'Cannot open file.';
                 exit;
            }

            // Lisame aadressi tekstifaili
            if (fwrite($handle, $OKemailAddresses."\r\n") === FALSE) {
                echo 'Cannot write to file.';
                exit;
            
            } else {
                $data .= 'Aadress '.$OKemailAddresses.' on postituste andmebaasist eemaldatud.';
            }

            fclose($handle);

        } else {
             echo 'File is not writable.';
             exit;
        }

    } else {
        //  Aadress on vigane
        $data .= 'Vigane e-posti aadress. Palun kontrolli.';
    }

    $data .= '<br>';
    $data .= '<br>';
    $data .= '<input type="button" value="Tagasi" onclick="javascript:history.go(-1);">';
       
} else {
    /*
    * Kuvame ankeedi e-posti aadressi küsimiseks
    */
    
    $data .= 'Palun kirjuta e-posti aadress, mille soovid andmebaasist eemaldada.';
    
    $data .= '<br>';
    $data .= '<br>';
    
    //   E-kirju saates saab genereerida viite, millel klikkides kasutajale ka tema aadress juba ankeedis 
    //   täidetuna ette on antud. Nii ei pea hakkama ise enda e-posti sinna sisestama.
    //   URL tuleb genereeida kujul: index.php?remove=minu@aadress.ee
    
    $data .= '<form name="form1" id="form1" method="post" action="./">';
    $data .= '<input type="text" name="undata" id="undata" value="'.$_GET['remove'].'" style="width:250px;">';
    $data .= '<input type="submit" value="Eemalda">';
    $data .= '</form>';
}


print $data;




?>

<script type="text/javascript">
document.getElementById('undata').focus();
</script>

  <br>
  <br>
</div>
</center>

</body>
</html>