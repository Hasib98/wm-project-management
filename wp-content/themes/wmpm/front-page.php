<?php if(!defined("ABSPATH")) exit; ?>
<!DOCTYPE html>
<html lang="<?php  language_attributes( ); ?> ">

<head>
    <meta charset=" <?php bloginfo( 'charset' ) ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(  )?>
</head>

<body>
    <div class="email">
        <form class="invite_form">
            <input class="email_input" type="email">
            <button class="email_invite_btn" type="submit">invite</button>
        </form>
    </div>


    <?php  wp_mail( 'smhasib1999@gmail.com', "test", "test_msg", "header", "attachments" );?>

    <?php wp_footer(  );?>

</body>

</html>