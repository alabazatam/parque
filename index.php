<?php include('autoload.php');?>
<?php include('view_header.php');?>

<?php include('view_footer.php');?>
<script>
	$(document).ready(function(){
		$(location).attr('href', '<?php echo full_url?>/adm/index.php')
	});
</script>
