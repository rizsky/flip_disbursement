<?php
  class Disbursement {
    // DB Stuff
    private $conn;
    private $table = 'disbursement';

    // Properties
    public $id;
    public $amount;
    public $status;
    public $timestamp;
    public $bank_code;
    public $account_number;
    public $beneficiary_name;
    public $remark;
    public $receipt;
    public $time_served;
    public $fee;
    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

  // Create Disbursement
  public function create() {

  // Create query]
  $query = 'INSERT INTO ' . $this->table . ' 
  SET id = :id, amount = :amount, status = :status, timestamp = :timestamp,
  bank_code = :bank_code, account_number = :account_number, beneficiary_name = :beneficiary_name, remark = :remark,
  receipt = :receipt, time_served = :time_served, fee = :fee'
  ;

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Bind data
  $stmt-> bindParam(':id', $this->id);
  $stmt-> bindParam(':amount', $this->amount);
  $stmt-> bindParam(':status', $this->status);
  $stmt-> bindParam(':timestamp', $this->timestamp);
  $stmt-> bindParam(':bank_code', $this->bank_code);
  $stmt-> bindParam(':account_number', $this->account_number);
  $stmt-> bindParam(':beneficiary_name', $this->beneficiary_name);
  $stmt-> bindParam(':remark', $this->remark);
  $stmt-> bindParam(':receipt', $this->receipt);
  $stmt-> bindParam(':time_served', $this->time_served);
  $stmt-> bindParam(':fee', $this->fee);

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  // Update Category
  public function update() {
    // Create Query
    $query = 'UPDATE ' .
      $this->table . '
      SET amount = :amount, status = :status, timestamp = :timestamp,
      bank_code = :bank_code, account_number = :account_number, beneficiary_name = :beneficiary_name, remark = :remark,
      receipt = :receipt, time_served = :time_served, fee = :fee
      WHERE
      id = :id';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->id = htmlspecialchars(strip_tags($this->id));

  // Bind data
  $stmt-> bindParam(':id', $this->id);
  $stmt-> bindParam(':amount', $this->amount);
  $stmt-> bindParam(':status', $this->status);
  $stmt-> bindParam(':timestamp', $this->timestamp);
  $stmt-> bindParam(':bank_code', $this->bank_code);
  $stmt-> bindParam(':account_number', $this->account_number);
  $stmt-> bindParam(':beneficiary_name', $this->beneficiary_name);
  $stmt-> bindParam(':remark', $this->remark);
  $stmt-> bindParam(':receipt', $this->receipt);
  $stmt-> bindParam(':time_served', $this->time_served);
  $stmt-> bindParam(':fee', $this->fee);

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  }
