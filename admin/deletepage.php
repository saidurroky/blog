<?php 
    include ("../lib/Session.php");
    Session::checkSession();
?>
<?php
include ("../config/config.php");
include ("../lib/Database.php");
?>
<?php
    $db = new Database();
?>
<?php
    if(!isset($_GET['delid']) && $_GET['delid'] == NULL){
        echo "<script>window.location = 'page.php'</script>";
    }else{

        $deleteid = $_GET['delid'];

    		$delquery ="DELETE FROM tbl_page WHERE id='$deleteid' ";

    		$deldata = $db -> delete($delquery);

    		 if($deldata){
                     echo "<script>alert('page deleted successfully');</script>";
                      echo "<script>window.location = 'index.php'</script>";
                }else{
                      echo "<script>alert('page deleted successfully');</script>";
                      echo "<script>window.location = 'index.php'</script>";
                }

      }
?>