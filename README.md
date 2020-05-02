# FLIP REST API

> This is a simple PHP REST API from scratch with no framework.

## Quick Start
1. setup db in `config/Database.php`, please change it 
2. running the migrate script
3. running this folder on local server, example in UNIX terminal : `cd PHP-FLIP && php -S localhost:3010`

## App Info
1. this services contains of 2 endpoints
try this using curl

- example of create :
`curl --location --request POST 'http://localhost:3010/api/disbursement/status.php/id?id=11212219' \
--header 'Content-Type: application/x-www-form-urlencoded' \
--data-urlencode 'bank_code=191991' \
--data-urlencode 'account_number=2011191' \
--data-urlencode 'amount=590000' \
--data-urlencode 'remark=hai'`


- example of update :
 `curl --location --request GET 'http://localhost:3010/api/disbursement/status.php/id?id=11212219'`


### Version

1.0.0