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
    if(!isset($_GET['delsliderid']) && $_GET['delsliderid'] == NULL){
        echo "<script>window.location = 'sliderlist.php'</script>";
    }else{

        $delsliderid = $_GET['delsliderid'];

         $getquery = "select * from tbl_slider where id='$delsliderid'";
  		   $getImg = $db->select($getquery);
   		if ($getImg) {
    		while ($imgdata = $getImg->fetch_assoc()) {
    		$delimg = $imgdata['image'];
    		unlink($delimg);
    	}
    }

		$delquery ="DELETE FROM tbl_slider WHERE id='$delsliderid' ";

		$deldata = $db -> delete($delquery);

		 if($deldata){
                 echo "<script>alert('slider deleted successfully');</script>";
                  echo "<script>window.location = 'sliderlist.php'</script>";
            }else{
                  echo "<script>alert('slider deleted successfully');</script>";
                  echo "<script>window.location = 'sliderlist.php'</script>";
            }

}
?>