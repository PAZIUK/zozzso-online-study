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
			<script>window.location.href = "/404"</script> 
		<?php
		}
		public static function toAdminPage(){
		?>
			<script>window.location.href = "/admin"</script> 
		<?php
		}
		public static function toPageViaLink($link){
		?>
			<script>window.location.href = "<?php echo $link?>"</script> 
		<?php
		}
	}
?>