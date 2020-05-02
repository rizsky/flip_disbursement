<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Disbursement.php';


//get request body
$data = file_get_contents("php://input");

//init request to 3rd party 
$ch = curl_init(); 
$username = "SHl6aW9ZN0xQNlpvTzduVFlLYkc4TzRJU2t5V25YMUp2QUVWQWh0V0tadW1vb0N6cXA0MTo";

$headers = array(
    'Content-Type: application/x-www-form-urlencoded',
    'Authorization: Basic '. ($username),
    'Access-Control-Allow-Methods: POST',
);    
    curl_setopt_array($ch, array(
    CURLOPT_URL => 'https://nextar.flip.id/disburse',
    CURLOPT_HTTPHEADER => $headers,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $data,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FAILONERROR => true,
));
$output = curl_exec($ch);
if (!curl_exec($ch)) {
    // if curl_exec() returned false and thus failed
    echo json_encode(
        array(
        'errors' => curl_error($ch),
        'message' => 'something went wrong'
        )
      );
    exit();
  
}    
curl_close($ch);
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $disbursement = new Disbursement($db);

  // Get raw posted data
  $response = json_decode($output);

  if ($response->time_served == "0000-00-00 00:00:00") {
      $response->time_served = "1000-01-01 00:00:00";
  }
 
  //data binding
  $disbursement->id = $response->id;
  $disbursement->amount = $response->amount;
  $disbursement->status = $response->status;
  $disbursement->timestamp = $response->timestamp;
  $disbursement->bank_code = $response->bank_code;
  $disbursement->account_number = $response->account_number;
  $disbursement->beneficiary_name = $response->beneficiary_name;
  $disbursement->remark = $response->remark;
  $disbursement->receipt = $response->receipt;
  $disbursement->time_served = $response->time_served;
  $disbursement->fee = $response->fee;

  // Create Disbusrsment
  if($disbursement->create()) {
    echo json_encode(
      array(
      'data' => $response,
      'message' => 'Disbursement Created'
      )
    );
  } else {
    echo json_encode(
      array(
          'data' => null,
          'message' => 'Disbursement Not Created'
          )
    );
  }
