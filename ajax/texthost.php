<?php
include('../config.php');
$title =  mysqli_real_escape_string($conn, $_POST['title']);	
$editr =  mysqli_real_escape_string($conn, $_POST['editr']);	
$slug =  mysqli_real_escape_string($conn, $_POST['slug']);	
      
        $sql = mysqli_query($conn, "INSERT INTO post_data (title, content, slug, status) VALUES ('$title','$editr','$slug','Active')");
	$post_id = mysqli_insert_id($conn);
        
        $res['id'] = $post_id;
        $res['status'] = 'success';
        
	echo json_encode($res);

    ?>