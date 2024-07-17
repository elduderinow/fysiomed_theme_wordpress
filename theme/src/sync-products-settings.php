<?php 
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    if ( isset( $_GET['settings-updated'] ) ) {
        add_settings_error(
            'my_options_mesages',
            'my_options_message',
            esc_html__( 'Settings Saved', 'text_domain' ),
            'updated'
        );
    }

    settings_errors( 'my_options_mesages' );

?>
<div class="wrap">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <form action="options.php" method="post">
        <?php
            settings_fields( 'sync_options_group' );
            do_settings_sections( 'my_options_sections' );
            submit_button( 'Save Settings' );
        ?>
    </form>
</div>