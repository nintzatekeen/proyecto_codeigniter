<?php
    echo "<h2>$coche->marca $coche->modelo</h2>";
    $precio=$this->m_automoviles->calcularPrecio($this->session->userdata("login")[0], $coche->precio);
            echo "<p>";
                echo "<strong>Combustible: </strong>";
                echo $coche->combustible." - ";
                echo "<strong>Precio/día: </strong>";
                echo $precio."€";
            echo "</p>";
            if(count($imagenes)>0){
                echo "<table>";
                    echo "<tr>";
                    for($i=0;$i<count($imagenes);$i++){
                        if(($i!=0)&&($i%3==0)){
                            echo "</tr>";
                            echo "<tr>";
                        }
                        echo "<td><img width='75px' height='75px' src='".base_url().$imagenes[$i]->imagen."'></td>";
                    }
                    echo "</tr>";
                echo "</table>";
            }
            echo "<table>";
                echo form_open(site_url()."/c_automoviles/alquilar/$coche->id");
                echo "<tr>";
                    echo "<th colspan='3'>Alquile este vehículo</th>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td><strong>Número de días:</strong></td>";
                    echo "<td>";
                        $options=array();
                        for($i=1;$i<=30;$i++){
                            $options[$i]=$i;
                        }
                        echo form_dropdown("dias", $options);
                    echo "</td>";
                    echo "<td rowspan='2'>". form_submit("submit", "ALQUILAR")."</td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td><strong>¿Desea añadirle el seguro de protección extra por ".$precio*0.3."€ más al día?</strong></th>";
                    echo "<td>".form_checkbox("seguro")."</td>";
                echo "</tr>";
                echo form_close();
            echo "</table>";
            /*if($seleccion!=false){
                echo form_open(site_url()."/c_automoviles/alquilar/$coche->id");
                    echo "<h3>Su selección</h3>";
                    echo "<ul>";
                    foreach($seleccion as $idcoche => $arr){
                        $seg="NO";
                        if($arr['seguro']==true){
                            $seg="SÍ";
                        }
                        echo "<li>";
                            echo $arr['coche']." - ".$arr['dias']." días - Seguro extra:  $seg - ".$arr['precio']."€ ";
                            
                            echo form_checkbox("seleccion[]", $idcoche);
                        echo "</li>";
                    }
                    echo "</ul>";
                    echo form_submit("confirmar", "CONFIRMAR");
                echo form_close();
            }*/
            
?>