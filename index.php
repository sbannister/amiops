<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>

<?    try
    {
        $connectionInfo = array("UID" => "sbannister@w8bvrrkcp9", "pwd" => "T@maz0n13", "Database" => "AmiAdvantageDb", "LoginTimeout" => 30, "Encrypt" => 1);
        $serverName = "tcp:w8bvrrkcp9.database.windows.net,1433";
        $conn = sqlsrv_connect($serverName, $connectionInfo);
        if($conn == false)
            die(FormatErrors(sqlsrv_errors()));
    }
    catch(Exception $e)
    {
        echo("Error!");
    }
try
    {
        $tsql = "SELECT TOP 100 * FROM device";
        $getProducts = sqlsrv_query($conn, $tsql);
        if ($getProducts == FALSE)
            die(FormatErrors(sqlsrv_errors()));
        $productCount = 0;
        while($row = sqlsrv_fetch_array($getProducts, SQLSRV_FETCH_ASSOC))
        {
            echo($row['Device_Serial_No']);
            echo("<br/>");
            $productCount++;
        }
        sqlsrv_free_stmt($getProducts);
        sqlsrv_close($conn);
    }
    catch(Exception $e)
    {
        echo("Error!");
    }
    
?>

 </body>
</html>
