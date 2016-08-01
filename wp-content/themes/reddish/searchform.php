	<?php $search_text = __ ( 'Search Site...', 'reddish' ); ?>
	<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input type="text" placeholder="<?php __ ( 'Search Site...', 'reddish' ); ?>" value="<?php echo $search_text; ?>" name="s" id="s"
			onblur = "if ( '' == this.value ) { this.value = '<?php echo $search_text; ?>';}"
			onfocus = "if ( this.value == '<?php echo $search_text; ?>' ) { this.value = '';}" />
		<input type="hidden" class="search_submit" />
	</form>