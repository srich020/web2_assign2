<?php
    if(!function_exists('classAutoLoader')){
        function classAutoLoader($class){
            $class=strtolower($class);
            $classFile=$_SERVER['DOCUMENT_ROOT'].'/assign1_srich020/classes/'.$class.'.class.php';
            if(is_file($classFile)&&!class_exists($class)) include $classFile;
        }
    }
    spl_autoload_register('classAutoLoader');
?>