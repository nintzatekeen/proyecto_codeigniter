<?php
    echo "<h1>GRACIAS POR CONFIRMAR SU ALQUILER</h1>";
    echo "<p>He aquí la lista de los automóviles que ha alquilado:</p>";
    echo "<hr/><ul>";
        foreach($seleccion as $id =>$arr){
            $seg="NO";
            $precio=$arr['precio'];
            if($arr['seguro']==true){
                $seg="SÍ";
                $precio*=1.3;
            }
            echo "<li>";
                echo $arr['coche']." - ".$arr['dias']." días - Seguro extra:  $seg - ".$precio."€ ";
            echo "</li>";
        }
    echo "</ul><hr/>";
    echo "<a href='".site_url()."/c_automoviles/index'>VOLVER A INICIO</a>";
    $this->session->unset_userdata("alquiler");
?>