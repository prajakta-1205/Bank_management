<!DOCTYPE html>
<html lang="en">
<head>
  <title>Customers</title>
  <style>
body{
	background-color:#EEEEEE;
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
button{
	position:relative;
	left:620px;
	border-radius:12px;
	width:150px;
	height:50px;
	font-size:25px;
	background-color:#4CAF50;
	color:white;
}
button:hover{
	background-color:white;
	color:black;
    box-shadow: 0 5px #666;
    transform: translateY(4px);
}
table{
	border:2px solid black;
	position:relative;
	bottom:100px;
	left:200px;
	border-collapse:collapse;
	text-align:center;
}
td{
	border:2px solid black;
	height:50px;
	font-size:20px;
	padding:5px;
}
td:hover{
	background-color:#039BE5;
}
tr:nth-child(even){
	background-color:#b2dfdb;
	
}
th{
	background-color:#00adff;
	padding:5px;
	height:50px;
	font-size:20px;
}
h2{
	position:relative;
    bottom:100px;
	left:400px;
	
}
#left{
	float:left;
}
#right{
	float:right;
	position:relative;
	right:800px;
	top:10px;
}
.info{
	width:150px;
	height:100px;
}
  </style>
</head>
<body>
<header>TSF Bank<img src="Images\Bank-logo.png" >
<a href="Homepage.php"><button>Home</button></a>
</header>
<h2>Customer Accounts</h2>

<table border="2" id="left">
  <tr>
    <th>Customer Name</th>
    <th>Email</th>
    <th>Balance</th>
  </tr>

<?php
$db = mysqli_connect("localhost","root","","bank_management");

if(!$db)
{
    die("Connection failed: " . mysqli_connect_error());
}

$records = mysqli_query($db,"select * from bank_transaction"); // fetch data from database
while($data = mysqli_fetch_array($records))
{
?>
  <tr>
    <td><?php echo $data['Customer_Name']; ?></td>
    <td><?php echo $data['Email']; ?></td>
    <td><?php echo $data['Balance']; ?></td>
  </tr>	
<?php
}
?>
</table>
<div id="right"><a href="transaction.php"><button class="info" >Transfer Money</button></a>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<a href="history.php"><button class="info">Transfer History</button></a></div>

<?php mysqli_close($db); // Close connection ?>

</body>
</html>
