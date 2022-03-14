<?php
// defaults.
$vars = array(
	'connected_account' => array(),
	'auth_url'          => '',
	'token'             => '',
	'is_connected'      => false,
);
/** @var array $template_vars */
foreach ( $template_vars as $key => $val ) {
	$vars[ $key ] = $val;
}
?>

<div class="forminator-integration-popup__header">

	<h3 id="forminator-integration-popup__title" class="sui-box-title sui-lg" style="overflow: initial; white-space: normal; text-overflow: initial;">
		<?php
		/* translators: ... */
		echo esc_html( sprintf( __( 'Connect %1$s', 'forminator' ), 'Trello' ) );
		?>
	</h3>

	<?php if ( ! empty( $vars['connected_account'] ) ) : ?>
		<p class="sui-description"><?php esc_html_e( 'Your Trello account is now authorized', 'forminator' ); ?></p>
	<?php else : ?>
		<p class="sui-description"><?php esc_html_e( 'Authorize Forminator to connect with your Trello account in order to send data from your forms.', 'forminator' ); ?></p>
	<?php endif ?>

</div>

<?php if ( ! empty( $vars['connected_account'] ) ) : ?>
	<p style="text-align: center;"><strong><?php echo esc_html( $vars['connected_account']['email'] ); ?></strong></p>
<?php endif ?>

<?php if ( empty( $vars['token'] ) ) : ?>

	<div class="sui-form-field" style="margin: 0;">

		<label class="sui-label"><?php esc_html_e( 'Identifier', 'forminator' ); ?></label>

		<input name="identifier"
			placeholder="<?php esc_attr_e( 'E.g., Business Account', 'forminator' ); ?>"
			value=""
			class="sui-form-control" />

		<span class="sui-description"><?php esc_html_e( 'Helps distinguish between integrations if connecting to the same third-party app with multiple accounts.', 'forminator' ); ?></span>

	</div>

	<div class="forminator-integration-popup__footer-temp">
		<a href="<?php echo esc_attr( $vars['auth_url'] ); ?>" target="_blank" class="sui-button sui-button-primary forminator-addon-connect forminator-integration-popup__close"><?php esc_html_e( 'Authorize', 'forminator' ); ?></a>
	</div>

	<script>
		(function ($) {
			$('input[name="identifier"]').on( 'change', function (e) {
				var parent = $(this).closest('.sui-box-body'),
					val = $(this).val(),
					link = $('.forminator-addon-connect', parent),
					href = link.prop('href');
				if ( href ) {
					var index = href.indexOf('identifier');

					if ( index ) {
						href = href.slice(0, index);
					}
					href += encodeURIComponent( 'identifier=' + val );
					link.prop('href', href);
				}
			});
		})(jQuery);
	</script>

<?php endif; ?>

<?php if ( $vars['is_connected'] ) : ?>
	<div class="forminator-integration-popup__footer-temp">
		<button class="sui-button sui-button-ghost forminator-addon-disconnect forminator-integration-popup__close"><?php esc_html_e( 'Disconnect', 'forminator' ); ?></button>
	<div>
<?php endif ?>
