<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/x-www-form-urlencoded');
  header('Access-Control-Allow-Methods: GET');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Disbursement.php';


//get request body
$id_disbursement = isset($_GET['id']) ? $_GET['id'] : die();

//init request to 3rd party 
$ch = curl_init(); 
$username = "SHl6aW9ZN0xQNlpvTzduVFlLYkc4TzRJU2t5V25YMUp2QUVWQWh0V0tadW1vb0N6cXA0MTo";

$headers = array(
    'Content-Type: application/x-www-form-urlencoded',
    'Authorization: Basic '. ($username)
);    
    curl_setopt_array($ch, array(
    CURLOPT_URL => 'https://nextar.flip.id/disburse/' . $id_disbursement,
    CURLOPT_HTTPHEADER => $headers,
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

  //check validation for the data because mysql default formating datetime type column
  if ($response->time_served == "0000-00-00 00:00:00") {
      $response->time_served = "1000-01-01 00:00:00";
  }
  
  //data binding
  $disbursement->id = $response->id;
  $disbursement->status = $response->status;
  $disbursement->receipt = $response->receipt;
  $disbursement->time_served = $response->time_served;

  // Create update data
  if($disbursement->update()) {
    echo json_encode(
      array(
      'data' => $response,
      'message' => 'Disbursement Status Updated'
      )
    );
  } else {
    echo json_encode(
      array(
          'data' => null,
          'message' => 'Disbursement Status not Updated'
          )
    );
  }
