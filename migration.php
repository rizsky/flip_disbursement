<?php 
include_once './config/Database.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

$sql_migrate = "CREATE TABLE IF NOT EXISTS `disbursement` (
  `id` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `status` varchar(255),
  `timestamp` datetime,
  `bank_code` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `beneficiary_name` varchar(255),
  `remark` varchar(255) NOT NULL,
  `receipt` varchar(255),
  `fee` varchar(255) NOT NULL,
  `time_served` datetime NOT NULL,
  PRIMARY KEY (`id`)
)";

$sql_insert = "INSERT INTO `disbursement` (`id`, `amount`, `status`, `timestamp`, `bank_code`,`account_number`,`beneficiary_name`,`remark`,`receipt`,`fee`,`time_served`)
VALUES
	(11212219,'10000', 'PENDING',NOW(),'BCA-911', '1122334455', 'Kiky', 'mantap', 'https://hellow?', 10000, NOW())"; 

$stmt = $db->query($sql_migrate);
$stmt = $db->query($sql_insert);

// checking query
if($stmt) {
    echo ("message : success migrate");
    exit();
}

else
// Print error if something goes wrong
printf("Error: $s.\n", $stmt->error);
exit();

