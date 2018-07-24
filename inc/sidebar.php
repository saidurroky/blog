<div class="sidebar clear">
			<div class="samesidebar clear">
				<h2>Categories</h2>
					<ul>
						<?php
							$query ="SELECT * FROM tbl_category";
							$category = $db ->select($query);

							if($category){
								while ($result = $category ->fetch_assoc()) {
						?>
						<li><a href="posts.php?category=<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a></li>

						<?php } } else { ?>
							<li>No Category Availavle</li>
						<?php } ?>						
					</ul>
			</div>
			
			<div class="samesidebar clear">
				<h2>Latest articles</h2>
			<div class="popular clear">
				<?php
					$query ="SELECT * FROM tbl_post LIMIT 4";

					$post = $db ->select($query);

					if($post){
					while ($result = $post ->fetch_assoc()) {
			
				?>

				<h3><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h3>
				<a href="post.php?id=<?php echo $result['id']; ?>"><img src="admin/<?php echo $result['image']; ?>" /> </a>
				
				<?php echo $fm ->textShorten($result['body'], 120); ?>

				<?php } } else{ header("location: 404.php"); }?>

			</div>
				
			</div>
			
		</div>