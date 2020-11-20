<?php
if($seleccion!=false){
                echo form_open(site_url()."/c_automoviles/alquilarTodo");
                    echo "<h3>Su selección</h3>";
                    echo "<ul>";
                    foreach($seleccion as $idcoche => $arr){
                        $seg="NO";
                        $precio=$arr['precio'];
                        if($arr['seguro']==true){
                            $seg="SÍ";
                            $precio*=1.3;
                        }
                        echo "<li>";
                            echo $arr['coche']." - ".$arr['dias']." días - Seguro extra:  $seg - ".$precio."€ ";
                            
                            echo form_checkbox("seleccion[]", $idcoche);
                        echo "</li>";
                    }
                    echo "</ul>";
                    echo form_submit("confirmar", "CONFIRMAR");
                echo form_close();
            }
?>