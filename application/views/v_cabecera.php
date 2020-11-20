<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <?php $hojaestilos= base_url()."estilos/stylesheet.css";?>
        <link rel="stylesheet" href='<?php echo $hojaestilos?>' type="text/css"/>
    </head>
    <body>
        <div id="header">
            <h1>AUTOMÓVILES</h1>
        </div>
        <div id="menu">
            <?php
                if($this->session->userdata("login")){
                    $enlace= site_url()."/c_automoviles/logout";
                    echo "<a href='$enlace'>Log Out</a>";
                    if($this->session->userdata("login")[1]=="admin"){
                        $enlace= site_url()."/c_automoviles/devoluciones";
                        echo "<a href='$enlace'>Gestión de devoluciones</a>";
                    }
                }
                else{
                    $enlace= site_url()."/c_automoviles/login";
                    echo "<a href='$enlace'>Log In</a>";
                }
            ?>
        </div>
        <div id="container">
            <div id="bar">
                <?php
                    echo "<ul>";
                        foreach ($marcas as $marca) {
                            $enlace= site_url()."/c_automoviles/cochesMarca/$marca->marca";
                            echo "<li><a href='$enlace'>$marca->marca</a></li>";
                        }
                        echo "<li><a href='".site_url()."/c_automoviles/index'>Todos</a></li>";
                    echo "</ul>";
                ?>
            </div>
            <div id="main">