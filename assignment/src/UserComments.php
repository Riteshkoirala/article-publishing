<?php
// getting the comment received by the article by the specific user
if(isset($_GET['artid'])&& isset($_GET['name'])){
	$select50 = "SELECT username, comment_date, comment FROM comment WHERE username ='$_GET[name]' AND article_id = '$_GET[artid]'";
	$smt50 = $dbcon->prepare($select50);
	$smt50->execute();
	$record50 = $smt50->fetchAll();
	//checking if there is any comments or not
	if (count($record50) > 0) {
		 foreach ($record50 as $row) {  
			print
			"<h4>".$row['username']."</h4>
			<em>".$row['comment_date']."</em>
			<h3>".$row['comment']."</h3>";

}
	}
}


?>