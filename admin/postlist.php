<?php include "inc/header.php" ;?>
<?php include "inc/sidebar.php" ;?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>No.</th>
							<th>Post Title</th>
							<th>Description</th>
							<th>Category</th>
							<th>Image</th>
							<th>Author</th>
							<th>Tags</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$query ="SELECT tbl_post.*, tbl_category.name FROM tbl_post INNER JOIN tbl_category ON tbl_post.cat = tbl_category.id ORDER BY tbl_post.title ASC ";
							$post = $db -> select($query);

							if($post){
								$i = 0;
								while($result = $post ->fetch_assoc()){
									$i++;
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><a href="editpost.php?editpostid=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></td>
							<td><?php echo $fm ->textShorten($result['body'],50) ; ?></td>
							<td><?php echo $result['name']; ?></td>
							<td><img  height='40px' width='50px' src="<?php echo $result['image'];?>" /></td>
							<td><?php echo $result['author']; ?></td>
							<td><?php echo $result['tags']; ?></td>
							<td><?php echo $fm ->formatDate($result['date']); ?></td>
							<td>

								<a href="viewpost.php?viewpostid=<?php echo $result['id']; ?>">View</a>
								<?php if(Session::get('userrole') == $result['id'] || Session::get('userrole') == '0'){ ?>
								 ||
								<a href="editpost.php?editpostid=<?php echo $result['id']; ?>">Edit</a> || 
								<a onclick="return confirm('Are you sure to DELETE!!!')" href="deletepost.php?deletepostid=<?php echo $result['id']; ?>">Delete</a></td>
								<?php } ?>						
						</tr>
						<?php }	} ?>
					</tbody>
				</table>
	
               </div>
            </div>
        </div>
    
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
 
 <?php include "inc/footer.php" ;?>