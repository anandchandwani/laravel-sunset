<!DOCTYPE html>
<html>
<head>
    <title>Angular QuickStart</title>
    <base href="/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="/css/app.css" />

    <!-- Polyfill(s) for older browsers -->


    <!-- TODO - Currently had to manually copy these files over to public/. It's possible they'll get deleted on the next build, so may have to automate that as part of the build script. -->
    <!-- On further investigation, this whole approach is fucked because SystemJS is incompatible with ng2-smart-tables, there are GH issues n everything.  So, will need to scrap all this angular work and start again. -->
    <script src="/node_modules/core-js/client/shim.min.js"></script>
    <script src="/node_modules/zone.js/dist/zone.js"></script>
    <script src="/node_modules/systemjs/dist/system.src.js"></script>

    <script src="/angular/systemjs.config.js"></script>
    <script>
      System.import('angular/main.js').catch(function(err){ console.error(err); });
    </script>

</head>
<body>

    <my-app>Loading AppComponent content here ...</my-app>

</body>
</html>