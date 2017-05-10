<link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">


<style type="text/css">
    @font-face {
        font-family: 'Glyphicons Halflings';
        src: url('http://alt2600.net/assets/network_rack/fonts/glyphicons-halflings-regular.eot');
    }
</style>
<?php
$css_default_files = array("https://fonts.googleapis.com/css?family=Exo+2",
                           "http://alt2600.net/assets/grocery_crud/themes/flexigrid/css/flexigrid.css",
                           "http://alt2600.net/assets/grocery_crud/css/jquery_plugins/fancybox/jquery.fancybox.css",
                           "http://alt2600.net/assets/grocery_crud/css/ui/simple/jquery-ui-1.10.1.custom.min.css",
                           "http://alt2600.net/assets/network_rack/css/bootstrap.min.css",
                           "http://alt2600.net/assets/network_rack/css/bootstrap-theme.min.css",
                           "http://alt2600.net/assets/network_rack/css/style.css");


$js_default_files=array("http://alt2600.net/assets/grocery_crud/js/jquery-1.11.1.min.js",
                        "http://alt2600.net/assets/grocery_crud/js/jquery_plugins/jquery.noty.js",
                        "http://alt2600.net/assets/grocery_crud/js/jquery_plugins/config/jquery.noty.config.js",
                        "http://alt2600.net/assets/grocery_crud/js/common/lazyload-min.js",
                        "http://alt2600.net/assets/grocery_crud/js/jquery_plugins/jquery.form.min.js",
                        "http://alt2600.net/assets/grocery_crud/js/jquery_plugins/jquery.numeric.min.js",
                        "http://alt2600.net/assets/grocery_crud/themes/flexigrid/js/jquery.printElement.min.js",
                        "http://alt2600.net/assets/grocery_crud/js/jquery_plugins/jquery.fancybox-1.3.4.js",
                        "http://alt2600.net/assets/grocery_crud/js/jquery_plugins/jquery.easing-1.3.pack.js",
                        "http://alt2600.net/assets/grocery_crud/js/jquery_plugins/ui/jquery-ui-1.10.3.custom.min.js",
                        "http://alt2600.net/assets/network_rack/js/bootstrap.min.js"
);




if(!isset($js_config_files)){
    $js_config_files=array();
}
if(!isset($js_files)){
    $js_files=array();
}
if(!isset($js_lib_files)){
    $js_lib_files=array();
}
if(!isset($css_files)){
    $css_files=array();
}
$js=array_merge($js_default_files,$js_config_files,$js_files,$js_lib_files);
$css=array_merge(@$css_default_files,$css_files);


array_unique($js);
array_unique($css);
if (isset($css)) {
    foreach ($css as $file) {
        echo  sprintf(' <link type="text/css" rel="stylesheet" href="%s" />'."\r\n", $file);
    }
}
if (isset($js)) {
    foreach ($js as $file) {
        echo  sprintf(' <script src="%s"></script> '."\r\n", $file);
    }
}
