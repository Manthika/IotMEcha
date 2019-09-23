<!DOCTYPE html>
<html manifest="demo.manifest"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Canvas Steel</title>
</head>
<body onload="count_print()">
    <table>
        <tbody>
         
        <tr>
            <td width="100%">
                
                <canvas id="printing_counter" width="100" height="40"></canvas>
            </td>
        </tr>
        
    </tbody></table>


<script>

    var odometer1, n = 999999.9;

    function count_print() {
        // Initialzing counter
        
        odometer1 = new steelseries.Odometer('printing_counter', {});

        // Start the random update
      
        printing_length();

   }

    function printing_length() {
        n += 0.005
        odometer1.setValue(n);
        setTimeout("printing_length()", 50);
    }

 
</script>
<script src="js/tween-min.js"></script>
<script src="js/steelseries-min.js"></script>
</body></html>
