<?php
error_reporting( E_ERROR );

class DBselect{
	
	protected $connection;
		
	public function __construct(){
		$this->connection = mysqli_connect("localhost", "root", "", "ingellotest");
		if(!$this->connection){
			echo "Database Connection Error ".mysqli_connect_error($this->connection);
		}
	}
	
	public function __destruct(){
		unset($this->connection);
	} 	
		
	function getAll(){
		$sql = "SELECT title FROM products ORDER BY id DESC";
		return $this->connection->query($sql);
	}
	
	function innerGet($id){
		$sql = "SELECT a.change 
				FROM addition a
				INNER JOIN products p ON p.id = a.pid				
				WHERE p.id=$id
				ORDER BY a.id DESC LIMIT 1";				
		return $this->connection->query($sql);
	}
}

$sel = new DBselect();
$result = $sel->getAll();
$arr = array();
	while($res = mysqli_fetch_assoc($result)){
	$arr[] = $res;
}
//var_dump($arr);
foreach($arr as $arr1){
		$title = $arr1["title"];				
	echo $title."</br>";
}
?>
<hr>
<?php
$res = $sel->innerGet(1);
$arr1 = array();
	while($res1 = mysqli_fetch_assoc($res)){
	$arr1[] = $res1;
}

foreach($arr1 as $arr){
		$change = $arr["change"];				
	echo $change."</br>";
}	
