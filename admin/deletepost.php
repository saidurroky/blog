<?php 
    include ("../lib/Session.php");
    Session::checkSession();
?>
<?php
include ("../config/config.php");
include ("../lib/Database.php");
include ("../helpers/Format.php");
?>
<?php
    $db = new Database();
?>
<?php
    if(!isset($_GET['deletepostid']) && $_GET['deletepostid'] == NULL){
        echo "<script>window.location = 'postlist.php'</script>";
    }else{

        $postid = $_GET['deletepostid'];

         $getquery = "select * from tbl_post where id='$postid'";
  		 $getImg = $db->select($getquery);
   		if ($getImg) {
    		while ($imgdata = $getImg->fetch_assoc()) {
    		$delimg = $imgdata['image'];
    		unlink($delimg);
    	}
    }

		$delquery ="DELETE FROM tbl_post WHERE id='$postid' ";

		$deldata = $db -> delete($delquery);

		 if($deldata){
                 echo "<script>alert('data deleted successfully');</script>";
                  echo "<script>window.location = 'postlist.php'</script>";
            }else{
                  echo "<script>alert('data deleted successfully');</script>";
                  echo "<script>window.location = 'postlist.php'</script>";
            }

}
?>