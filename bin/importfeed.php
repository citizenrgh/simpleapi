<?php
$merchid=26550;
$table='hardwarecity';

mysql_connect('localhost','root');
mysql_select_db('api_merchants');

$input = file($merchid.'.txt');

foreach($input as $line)
{
	$line = trim($line);
	list(
$productid,
$name,
$merchantid ,
$merchant   ,
$link       ,
$thumbnail  ,
$bigimage   ,
$price      ,
$retailprice,
$category   ,
$subcategory,
$description,
$custom1    ,
$custom2    ,
$custom3    ,
$custom4    ,
$custom5    ,
$lastupdated,
$status     ,
$manufacturer,
$partnumber         ,
$merchantcategory   ,
$merchantsubcategory,
$shortdescription   ,
$isbn               ,
$upc                ) = explode('|', $line);

$sql="insert into $table (
`productid`,
`name`,
`merchantid`,
`merchant`,
`link`,
`thumbnail`,
`bigimage`,
`price`,
`retailprice`,
`category`,
`subcategory`,
`description`,
`custom1`,
`custom2`,
`custom3`,
`custom4`,
`custom5`,
`lastupdated`,
`status`,
`manufacturer`,
`partnumber`,
`merchantcategory`,
`merchantsubcategory`,
`shortdescription`,
`isbn`,
`upc`
)
VALUES (

'".addslashes($productid)."', 
'".addslashes($name)."', 
'".addslashes($merchantid)."', 
'".addslashes($merchant)."', 
'".addslashes($link      )."', 
'".addslashes($thumbnail )."', 
'".addslashes($bigimage  )."', 
'".addslashes($price     )."', 
'".addslashes($retailprice  )."', 
'".addslashes($category     )."', 
'".addslashes($subcategory  )."', 
'".addslashes($description  )."', 
'".addslashes($custom1      )."', 
'".addslashes($custom2      )."', 
'".addslashes($custom3      )."', 
'".addslashes($custom4     )."', 
'".addslashes($custom5      )."', 
'".addslashes($lastupdated  )."', 
'".addslashes($status        )."', 
'".addslashes($manufacturer   )."', 
'".addslashes($partnumber     )."', 
'".addslashes($merchantcategory  )."', 
'".addslashes($merchantsubcategory)."', 
'".addslashes($shortdescription   )."', 
'".addslashes($isbn               )."', 
'".addslashes($upc                )."' 
)
";


mysql_query($sql);

}
