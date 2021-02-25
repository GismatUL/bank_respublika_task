<?php
$txt = "PHP";
//echo $myxmlfilecontent = file_get_contents('https://www.cbar.az/currencies/25.02.2021.xml');

$xml=simplexml_load_file("https://www.cbar.az/currencies/25.02.2021.xml");

$json = json_encode($xml);
$array = json_decode($json,TRUE);


for ($j=0;$j<count($array['ValType']);$j++)
{
    for ($i=0; $i<count($array['ValType'][$j]['Valute'] ); $i++)
    {
        if ($array['ValType'][$j]['Valute'][$i]['@attributes']['Code']=='USD')
            $usd = $array['ValType'][$j]['Valute'][$i]['Value'];
        elseif ($array['ValType'][$j]['Valute'][$i]['@attributes']['Code']=='EUR')
            $euro = $array['ValType'][$j]['Valute'][$i]['Value'];
    }

}

?>




<!DOCTYPE html>
<html>
<body>

<h2 id="msg">HTML Forms</h2>

<form action="">

    <input type="text" id="data" name="" value=""><br>
    <label for="lname">Last name:</label><br>
    <select id="select_currency" onclick="Select_Cat();">
        <option value="">Currency</option>
        <option value="<?= $usd ?>">USD</option>
        <option value="<?= $euro ?>">EURO</option>
    </select>

</form>
</body>
</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script>
    function Select_Cat () {
        var currency= $("#select_currency").val();
        var input_data= $("#data").val();
    if (currency!='' && input_data!='')
    {
        $.ajax({
            type: "post",
            data: {
                currency: currency,
                _token: '{{csrf_token()}}'
            },
            url: '',
            success: function () {
                $("#msg").html(input_data/currency);
            }
        });
    }
    }
</script>