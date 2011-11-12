<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>Nubee - Project management on the fly</title>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    
    <meta name="google-site-verification" content="OmwSfjf8lEyuj44rxsvw_hNt4A3M9hfWCYu9uYi1I4g" />
    <link rel="shortcut icon" href="/favicon.png" />
  </head>
  <body>
    <div id="page">
      <div id="header">
        <div id="logo"><?php echo link_to(image_tag('logo2.png', array('alt' => 'Nubee Homepage')), 'homepage') ?></div>
      </div>
      <div id="topMenu">
        <?php if($sf_user->isAuthenticated()) : ?>
          <ul style="float:right">
            <li>Welcome, <span class="strong"><?php echo $sf_user->getFullName() ?></span></li>
            <li>|</li>
            <li><?php echo link_to('Edit profile', 'user_edit', $sf_user->getGuardUser()) ?></li>
            <li>|</li>
            <li><?php echo link_to('Logout', '@logout') ?></li>
          </ul>
        <?php endif; ?>
        <ul>
          <?php if($sf_user->isAuthenticated()) : ?>
            <li><?php echo link_to('Dashboard', '@homepage') ?></li>
            <li>|</li>
            <li><?php echo link_to('Products', '@product') ?></li>
            <?php if($sf_user->hasCredential('Administrator')) : ?>
              <li>|</li>
              <li><?php echo link_to('Teams', '@team') ?></li>
              <li>|</li>
              <li><?php echo link_to('Users', '@user') ?></li>
            <?php endif; ?>
          <?php else: ?>
            <li><?php echo link_to('Login', '@login') ?></li>
          <?php endif; ?>
          <li>|</li>
          <li><?php echo link_to('Documentation', '@docs') ?></li>
        </ul>
      </div>
      <div id="content">
        <div id="breadcrumbs">
          <?php if(!include_slot('breadcrumbs')) : ?>
            <?php include_partial('content/breadcrumbs') ?>
          <?php endif; ?>
        </div>
        <div id="leftColumn">
          <?php if(!include_slot('leftMenu')) : ?>
            <?php if($sf_user->isAuthenticated()) : ?>
              <?php include_component('content', 'leftMenu') ?>
            <?php endif; ?>
          <?php endif; ?>
        </div>
        <div id="centerColumn">
          <?php echo $sf_content ?>
        </div>
      </div>
      <div id="footer">
        <ul>
          <li>&copy; <?php echo date('Y') ?> nubee.org</li>
        </ul>
      </div>
    </div>

    <script type="text/javascript">
      $(function(){
        $('.date').datepicker({
          dateFormat: 'dd/mm/yy',
          showOn: 'both',
          buttonImage: "/images/icons/calendar.png",
          buttonImageOnly: true
        });
      });

    </script>
  </body>
</html>

