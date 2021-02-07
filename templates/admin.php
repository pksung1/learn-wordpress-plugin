<?php ?>

<div class="wrap">
    <h1>Dashboard</h1>
    <?php settings_errors(); ?>
    <form action="options.php" method="post">
        <?php
            settings_fields( 'learn_options_group');
            do_settings_sections('learn_plugin');
            submit_button();
        ?>
    </form>
</div>