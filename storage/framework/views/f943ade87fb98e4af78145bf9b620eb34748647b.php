<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="h-full">
<head>
    <?php if(env("APP_ENV") == "production"): ?>
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-15QQQ2RMEC"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-15QQQ2RMEC');
        </script>
    <?php endif; ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title inertia><?php echo e(config('app.name', 'Laravel')); ?> <?php if(!empty(config('app.slogan', ''))): ?>| <?php echo e(config('app.slogan', '')); ?> <?php endif; ?></title>
    <meta name="title" content="CommandHub">
    <meta name="description" content="Our online platform makes it easy to save and search for the commands you use most, so you can save time and streamline your workflow.">
    <meta property="og:description" content="Our online platform makes it easy to save and search for the commands you use most, so you can save time and streamline your workflow." />
    <meta name="keywords" content="terminal, commands, cli">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">
    <meta property="og:type" content="website" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="author" content="Rok Zabukovec">
    <!-- Scripts -->
    <?php echo app('Tightenco\Ziggy\BladeRouteGenerator')->generate(); ?>
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/app.js'); ?>
    <?php if (!isset($__inertiaSsr)) { $__inertiaSsr = app(\Inertia\Ssr\Gateway::class)->dispatch($page); }  if ($__inertiaSsr instanceof \Inertia\Ssr\Response) { echo $__inertiaSsr->head; } ?>
</head>
<body class="font-inter font-feature-default antialiased h-full overflow-scroll">
<?php if (!isset($__inertiaSsr)) { $__inertiaSsr = app(\Inertia\Ssr\Gateway::class)->dispatch($page); }  if ($__inertiaSsr instanceof \Inertia\Ssr\Response) { echo $__inertiaSsr->body; } else { ?><div id="app" data-page="<?php echo e(json_encode($page)); ?>"></div><?php } ?>
</body>
</html>
<?php /**PATH /app/resources/views/app.blade.php ENDPATH**/ ?>