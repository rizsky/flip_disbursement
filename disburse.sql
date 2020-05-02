CREATE TABLE IF NOT EXISTS `disbursement` (
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
);

LOCK TABLES `disbursement` WRITE;

INSERT INTO `disbursement` (`id`, `amount`, `status`, `timestamp`, `bank_code`,`account_number`,`beneficiary_name`,`remark`,`receipt`,`fee`,`time_served`)
VALUES
	(11212219,'100000', 'PENDING',NOW(),'BCA-911', '1122334455', 'Kiky', 'mantap', 'https://hellow?', '10000', NOW())

UNLOCK TABLES; 
