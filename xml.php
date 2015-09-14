
<rows>
    <head>
        <column width="220" type="ed" align="left" sort="str">Time</column>
        <column width="150" type="ed" align="left" sort="str">Source</column>
        <column width="500" type="ed" align="left" sort="str">Event</column>
        <column width="100" type="ed" align="left" sort="str">Event ID</column>
    </head>
<?    
try
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
        $tsql = "SELECT TOP 100 * FROM events WHERE event_severity = 'Emergency'";
        $getProducts = sqlsrv_query($conn, $tsql);
        if ($getProducts == FALSE)
            die(FormatErrors(sqlsrv_errors()));
        $productCount = 0;
        $i = 0;

	while($row = sqlsrv_fetch_array($getProducts, SQLSRV_FETCH_ASSOC))
	{
		print("<row open='A' id='$i'><cell close='B'>");
		echo $row['event_time'] ;
		print("</cell><cell>");
		echo $row['src_mac'] ;
		print("</cell><cell>");
		echo $row['event_text'] ;
		print("</cell><cell>");
		echo $row['event_id'] ;
		print("</cell></row>");
		$i++;
	}
        sqlsrv_free_stmt($getProducts);
        sqlsrv_close($conn);
        
    }
    catch(Exception $e)
    {
        echo("Error!");
    }
?>
</rows>

