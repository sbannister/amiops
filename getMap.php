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
echo("Here!");
try
    {
        $tsql = "SELECT TOP 100 * FROM location";
        $result = sqlsrv_query($conn, $tsql);
        if ($result == FALSE)
            die(FormatErrors(sqlsrv_errors()));
    }
    catch(Exception $e)
    {
        echo("Error!");
    }

header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
{
  // ADD TO XML DOCUMENT NODE
  echo '<marker ';
  echo 'name="' . parseToXML('&','&amp;', $row['Device_Util_ID']) . '" ';
  echo 'lat="' . $row['Service_Pt_Latitude'] . '" ';
  echo 'lng="' . $row['Service_Pt_Longitude'] . '" ';
  echo '/>';
}

// End XML file
echo '</markers>';

sqlsrv_free_stmt($result);
sqlsrv_close($conn);
?>
