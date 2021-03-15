<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>History</title>
<style>
        body{
			background-color:#EEEEEE;
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
</style>
</head>
<body>
<header>TSF Bank<img src="Images\Bank-logo.png" >
<a id="button" href="test_contact.php"><button>Customer List</button></a>
<a id="button" href="Homepage.php"><button>Home</button></a>
</header>

<table border="2" id="left">
  <tr>
    <th>Sender</th>
    <th>Receiver</th>
    <th>Amount</th>
	<th>Datetime</th>
  </tr>

<?php
$db = mysqli_connect("localhost","root","","bank_management");

if(!$db)
{
    die("Connection failed: " . mysqli_connect_error());
}

$records = mysqli_query($db,"select * from history"); // fetch data from database
while($data = mysqli_fetch_array($records))
{
?>
  <tr>
    <td><?php echo $data['Sender']; ?></td>
    <td><?php echo $data['Receiver']; ?></td>
    <td><?php echo $data['Amount']; ?></td>
	<td><?php echo $data['Datetime']; ?></td>
  </tr>	
<?php
}
?>
</table>
</body>
</html>