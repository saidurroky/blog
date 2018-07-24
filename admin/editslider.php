<?php include "inc/header.php" ;?>
<?php include "inc/sidebar.php" ;?>
<?php
    if(!isset($_GET['sliderid']) && $_GET['sliderid'] == NULL){
       
    }else{

        $sliderid = $_GET['sliderid'];
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>update Post</h2>

 <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title = mysqli_real_escape_string($db->link, $_POST['title']);
    
    $permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "upload/slider/".$unique_image;

    if ($title == "") {
        echo "<span class='error'>field must not be empty!</span>";
    }else{
if(!empty($file_name)){
    if ($file_size >1048567) {
        echo "<span class='error'>Image Size should be less then 1MB!</span>";
    } elseif (in_array($file_ext, $permited) === false) {
         echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
    } else{
         move_uploaded_file($file_temp, $uploaded_image);
         $query ="UPDATE tbl_slider
                    SET 
                        title = '$title',
                        image = '$uploaded_image'
                        WHERE id = '$sliderid' ";
         $updated_rows = $db->update($query);
          if ($updated_rows) {
              echo "<span class='success'>Slider updated Successfully.</span>";
          }else {
             echo "<span class='error'>slider Not updated !</span>";
              }
          }
    }else{
        $query ="UPDATE tbl_slider
                    SET 
                        title = '$title'
                        WHERE id = '$sliderid' ";
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
        <div class="block"> 

<?php
     $query = "SELECT * FROM tbl_slider WHERE id = '$sliderid'";
     $editslider = $db ->select($query);

    while ($sliderresult = $editslider -> fetch_assoc()) {
?>              
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $sliderresult['title']; ?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img height="100px" width="200px" src="<?php echo $sliderresult['image']; ?>"/>
                        <input type="file" name="image"/>
                    </td>
                </tr>
				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
                <?php } ?>
            </table>
            </form>
        </div>
    </div>
</div>

  <!-- Load TinyMCE -->
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>

<?php include "inc/footer.php" ;?>