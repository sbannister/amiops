
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
        $tsql = "SELECT TOP 100 * FROM location";
        $getProducts = sqlsrv_query($conn, $tsql);
        if ($getProducts == FALSE)
            die(FormatErrors(sqlsrv_errors()));
        $productCount = 0;

        header("Content-type: text/xml");
        
        // Start XML file, echo parent node
        echo '<markers>';
        
        // Iterate through the rows, printing XML nodes for each
        while($row = sqlsrv_fetch_array($getProducts, SQLSRV_FETCH_ASSOC))
        {
          // ADD TO XML DOCUMENT NODE
          echo '<marker ';
          echo 'name="' .$row['Device_Util_ID'] . '" ';
          echo 'lat="' . $row['Service_Pt_Latitude'] . '" ';
          echo 'lng="' . $row['Service_Pt_Longitude'] . '" ';
          echo '/>';
        }
        
        // End XML file
        echo '</markers>';
        
        sqlsrv_free_stmt($getProducts);
        sqlsrv_close($conn);
    }
    catch(Exception $e)
    {
        echo("Error!");
    }
    
?>
