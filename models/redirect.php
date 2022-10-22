<?php
	class REDIRECT
	{
		public static function toUserHome(){
    ?>
      <script>window.location.href = "/"</script> 
    <?php
		}
		public static function toErrorPage(){
		?>
			<script>window.location.href = "/view/404"</script> 
		<?php
		}
		public static function toAdminPage(){
		?>
			<script>window.location.href = "/view/admin"</script> 
		<?php
		}
		public static function toPageViaLink($link){
		?>
			<script>window.location.href = "<?php echo $link?>"</script> 
		<?php
		}
	}
?>