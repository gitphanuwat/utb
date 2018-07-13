
<?php
session_start();
//include('config/config.php');
$host="localhost";
$hostuser="lrdsystemc_lrd";
$hostpass="lrdsystemc_lrd";
$database="lrdsystemc_lrd";
date_default_timezone_set('Asia/Bangkok');

/* backup the db OR just a table */
function backup_tables($host,$user,$pass,$name)
{
      date_default_timezone_set('Asia/Bangkok');

    	$return=null;

      //$link = mysqli_connect($host,$user,$pass,true);
      $link = mysqli_connect($host,$user,$pass,$name);
    	mysqli_set_charset($link,'utf8');
    	mysqli_select_db($link,$name);

      // BASE TABLE SAVE
    	//get all of the tables
    		$tables = array();
    		$result = mysqli_query($link,"SHOW FULL TABLES WHERE Table_type = 'BASE TABLE'");
    		while($row = mysqli_fetch_row($result))
    		{
    			$tables[] = $row[0];
    		}

    	//cycle through
    	foreach($tables as $table)
    	{
    		$result = mysqli_query($link,'SELECT * FROM '.$table);
    		$num_fields = mysqli_num_fields($result);

    		$return.= 'DROP TABLE IF EXISTS '.$table.';';
    		$row2 = mysqli_fetch_row(mysqli_query($link,'SHOW CREATE TABLE '.$table));
    		$return.= "\n\n".$row2[1].";\n\n";

    		for ($i = 0; $i < $num_fields; $i++)
    		{
    			while($row = mysqli_fetch_row($result))
    			{
    				$return.= 'INSERT INTO '.$table.' VALUES(';
    				for($j=0; $j<$num_fields; $j++)
    				{
    					$row[$j] = addslashes($row[$j]);
    					//$row[$j] = preg_replace("\n","\\n",$row[$j]);
    					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
    					if ($j<($num_fields-1)) { $return.= ','; }
    				}
    				$return.= ");\n";
    			}
    		}
    		$return.="\n\n\n";
    	}

      $file_name='backupdb/db-backup_'.date("Y-m-d_His").'.sql';

    	$handle = fopen($file_name,'w+');
    	//fwrite($handle,utf8_encode($return));
    	fwrite($handle,$return);
    	fclose($handle);
     	return $file_name;
 }

	$file_nameA = backup_tables($host,$hostuser,$hostpass,$database);
	//echo $file_nameA;
	if (file_exists($file_nameA)) {
	//	echo "<BR> $file_nameA";
		$zipA_SQL = new ZipArchive();
		$filenameA_SQL = 'backupdb/db-backup_'.date('Y-m-d_His').'.zip';
		echo "<BR>$filenameA_SQL";

		if ($zipA_SQL->open($filenameA_SQL,ZIPARCHIVE::CREATE)!==TRUE) {
			exit("cannot open <$filename>\n");
		}
		$zipA_SQL->addFile($file_nameA,substr($file_nameA,8));

		$zipA_SQL->close();
		unlink($file_nameA);
	}

header("Location: ../mnt/bkdb");
exit();
?>
