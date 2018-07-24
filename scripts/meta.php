<?php
		if(isset($_GET['pageid'])){

			$pageid = $_GET['pageid'];

			 $query ="SELECT * FROM tbl_page WHERE id ='$pageid'";
             $page = $db ->select($query);

             if($page){
                
                while ($rresult = $page ->fetch_assoc()) { ?>

                <title><?php echo $rresult['name']; ?>-<?php echo TITLE; ?></title>
             <?php  } } ?>
	<?php }elseif(isset($_GET['id'])){

			$postid = $_GET['id'];

			 $query ="SELECT * FROM tbl_post WHERE id ='$postid'";
             $post = $db ->select($query);

             if($post){
                
                while ($rresult = $post ->fetch_assoc()) { ?>

                <title><?php echo $rresult['title']; ?>-<?php echo TITLE; ?></title>
             <?php  } } ?>
	<?php } else{ ?>

	<title><?php echo $fm ->title(); ?>||<?php echo TITLE; ?></title>

	<?php } ?>
	
	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">

<?php
if(isset($_GET['id'])){
	$keyid = $_GET['id'];
	$query ="SELECT * FROM tbl_post WHERE id ='$keyid'";
    $keyword = $db ->select($query);
    if($keyword){
        while ($result = $keyword ->fetch_assoc()) { ?>
    <meta name="keywords" content="<?php echo $result['tags']; ?>">
<?php }	} }else{ ?>
	<meta name="keywords" content="<?php echo KEYWORDS ; ?> ">
<?php }?>

	<meta name="keywords" content="blog,cms blog">
	<meta name="author" content="Delowar">