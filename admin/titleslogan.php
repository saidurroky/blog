<?php include "inc/header.php" ;?>
<?php include "inc/sidebar.php" ;?>

        <div class="grid_10">	
            <div class="box round first grid">
                <h2>Update Site Title and Description</h2>
                <div class="block sloginblock"> 
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title = $fm ->validation($_POST['title']);
    $slogan = $fm ->validation($_POST['slogan']);

    $title = mysqli_real_escape_string($db->link,  $title);
    $slogan = mysqli_real_escape_string($db->link, $slogan);
    
    
    $permited  = array('png');
    $file_name = $_FILES['logo']['name'];
    $file_size = $_FILES['logo']['size'];
    $file_temp = $_FILES['logo']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $same_image = 'logo'.'.'.$file_ext;
    $uploaded_image = "upload/".$same_image;

    if ($title == "" || $slogan == "") {
        echo "<span class='error'>field must not be empty!</span>";
    }else{
if(!empty($file_name)){
    if ($file_size >1048567) {
        echo "<span class='error'>Image Size should be less then 1MB!</span>";
    } elseif (in_array($file_ext, $permited) === false) {
         echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
    } else{
         move_uploaded_file($file_temp, $uploaded_image);
         $query ="UPDATE tbl_slogan
                    SET 
                        
                        title = '$title',
                        slogan  = '$slogan',
                        logo = '$uploaded_image'
                    
                        WHERE id = '1' ";
          $updated_rows = $db->update($query);
          if ($updated_rows) {
              echo "<span class='success'>Data updated Successfully.</span>";
          }else {
             echo "<span class='error'>Data Not updated !</span>";
              }
          }
    }else{
        $query ="UPDATE tbl_slogan
                    SET 
                       title = '$title',
                       slogan  = '$slogan'
                       WHERE id = '1' ";
         $updated_rows = $db->update($query);
          if ($updated_rows) {
              echo "<span class='success'>Data updated Successfully.</span>";
          }else {
             echo "<span class='error'>Data Not updated !</span>";
              }
        }
    }
}
?>
                <?php
                    $query ="SELECT * FROM tbl_slogan WHERE id='1'";
                    $blog_title = $db ->select($query);

                    if($blog_title){
                        
                        while ($result = $blog_title ->fetch_assoc()) {
                    
                ?>

                 <form action="" method = "post" enctype="multipart/form-data">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Website Title</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['title']; ?>"  name="title" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Website Slogan</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['slogan']; ?>" name="slogan" class="medium" />
                            </td>
                        </tr>
						 
						<tr>
                            <td>
                                <label>Upload logo</label>
                            </td>
                            <td>
                                <input type="file" name = "logo" />    
                            </td>
                            <td>
                             <img height="40px" width="50px" src="<?php echo $result['logo']; ?>" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php } }?>
                </div>
            </div>
        </div>
<?php include "inc/footer.php" ;?>
