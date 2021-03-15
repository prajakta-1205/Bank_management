<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Transaction</title>
<style>
        body{
			background-color:#EEEEEE;
		}
	    form{
		position:relative;
		left:500px;
		}
		fieldset{
		width:300px;
		height:350px;
		background-color:white;
		}
		button{
		position:relative;
		left:50px;
		top:30px;
		border-radius:12px;
	        width:150px;
	        height:50px;
	        font-size:20px;
	        background-color:#4CAF50;
	        color:white;
		}
		header{
	    position:relative;
	    left:1px;
	    bottom:10px;
	    background-color:#311B92;
	    font-size:40px;
	    margin-bottom:120px;
        }
		img{
	    width:40px;
	    position:relative;
	    top:10px;
        }
		#button{
			position:relative;
			left:700px;
			bottom:30px;
		}
		button:hover{
	        background-color:white;
	        color:black;
            box-shadow: 0 5px #666;
            transform: translateY(4px);
}
</style>
</head>
<body>
<header>TSF Bank<img src="Images\Bank-logo.png" >
<a  id="button" href="test_contact.php"><button>Customer List</button></a>
<a id="button" href="Homepage.php"><button>Home</button></a>
</header>
<form method="post" name='tcredit'>
<fieldset>
<h3 style="posotion:relative; right:100px;">Transfer Money</h3>
        <p class="para">Sender : <span class="tab">
            <select style="margin-left:20px;width:200px" name="Sender" class="form-control" required>
              <option value="" disabled selected>Choose Name</option>
              <?php
              $servername = "localhost";
              $username = "root";
              $password = "";
              $dbname = "bank_management";
              // Create connection
              $conn = new mysqli($servername, $username, $password, $dbname);
              // Check connection
              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              }

              $sql = "SELECT * FROM bank_transaction ORDER BY Customer_Name ASC";
              $result = mysqli_query($conn, $sql);
              if (!$result) {
                echo "Error " . $sql . "<br>" . mysqli_error($conn);
              }
              while ($rows = mysqli_fetch_assoc($result)) {
              ?>
                <option class="table" value="<?php echo $rows['ID']; ?>">

                  <?php echo $rows['Customer_Name']; ?> 

                </option>
              <?php
              }
              ?>
              </option>
            </select>
        </p>
		<br>
        <p class="para">Receiver :<span style="margin-left:10px;width:200px;" class="tab">
            <select id="ddlReceiver" name="Receiver" class="form-control" required>
              <option value="" disabled selected>Choose Name</option>
              <?php
              $servername = "localhost";
              $username = "root";
              $password = "";
              $dbname = "bank_management";
              // Create connection
              $conn = new mysqli($servername, $username, $password, $dbname);
              // Check connection
              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              }

              $sql = "SELECT * FROM bank_transaction ORDER BY Customer_Name ASC";
              $result = mysqli_query($conn, $sql);
              if (!$result) {
                echo "Error " . $sq1 . "<br>" . mysqli_error($conn);
              }

              while ($rows = mysqli_fetch_assoc($result)) {
              ?>
                <option class="table" value="<?php echo $rows['ID']; ?>">

                  <?php echo $rows['Customer_Name']; ?>

                </option>
              <?php
              }
              ?>
              </option>
            </select>
        </p>
		<br>
        <label for="Amount" class="value">Amount : <span style="margin-left:12px;" class="tab"></span></label>


        <input type="number" name="amount" required>
        <div class="text-center">
          <button class="btn" type="submit" name="submit" id="myBtn">Send</button>
        </div>
		</fieldset>
      </form>
    </div>
  </div>
  <?php


  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "bank_management";
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  if (isset($_POST['submit'])) {
    $from = $_POST['Sender'];
    $to = $_POST['Receiver'];
    $amount = $_POST['amount'];
     $sql = "SELECT * from bank_transaction where id=$from";
     $query = mysqli_query($conn, $sql);
     $sql1 = mysqli_fetch_array($query);


     $sql = "SELECT * from bank_transaction where id=$to";
     $query = mysqli_query($conn, $sql);
     $sql2 = mysqli_fetch_array($query);

     //constraint to check if both the sender and receiver are same
    if ($sql1 == $sql2) {
      echo "<script> alert('Incorrect transaction details');
                      window.location='transaction.php';</script>";
    }
    // constraint to check input of negative value or zero by user
    if (($amount) <= 0) {
      echo '<script type="text/javascript">';
      echo ' alert("Incorrect amount.")';
      echo '</script>';
    }

    // constraint to check insufficient balance.
    else if ($amount > $sql1['Balance']) {
      echo '<script type="text/javascript">';
      echo ' alert("Insufficient Balance.")';
      echo '</script>';
    } else {
      // deducting amount from sender's account
      $newbalance = $sql1['Balance'] - $amount;
      $sql = "UPDATE bank_transaction set Balance=$newbalance where ID=$from";
      mysqli_query($conn, $sql);

      // adding amount to reciever's account
      $newbalance = $sql2['Balance'] + $amount;
      $sql = "UPDATE bank_transaction set Balance=$newbalance where ID=$to";
      mysqli_query($conn, $sql);

      $sender = $sql1['Customer_Name'];
      $receiver = $sql2['Customer_Name'];
      date_default_timezone_set("Asia/Kolkata");
      $t = time();
      $time = (date("Y-m-d H:i:s", $t));
      $sql = "INSERT INTO history VALUES ('" . $sender . "','" . $receiver . "','" . $amount . "','" . $time . "')";
      $query = mysqli_query($conn, $sql);

      if ($query) {
        echo "<script> alert('Transaction Successful');
                      window.location='history.php';</script>";
      }
      $newbalance = 0;
      $amount = 0;
    }
  }
  ?>
</body>
</html>
