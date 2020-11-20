<?php
    echo "<table>";
        echo "<tr>";
            echo "<th>Imagen</th>";
            echo "<th>Marca</th>";
            echo "<th>Modelo</th>";
            echo "<th>Año</th>";
            echo "<th>Combustible</th>";
            echo "<th colspan='2'>Precio/día</th>";
        echo "</tr>";
        foreach($coches_marca as $coche){
            echo "<tr>";
                echo form_open(site_url()."/c_automoviles/cochesMarca/$coche->marca");
                    echo "<td><img style='width:200px;' src='".base_url().$coche->imagen."'></td>";
                    echo "<td>".$coche->marca."</td>";
                    echo "<td>".$coche->modelo."</td>";
                    echo "<td>".$coche->anio."</td>";
                    echo "<td>".$coche->combustible."</td>";
                    echo "<td>".$coche->precio."€</td>";
                    echo "<input type='hidden' name='id' value='$coche->id'/>";
                    if(($this->session->userdata("login"))&&($coche->devuelto==1)){
                        echo "<td>".form_submit("alquilar", "ALQUILAR")."</td>";
                    }
                echo form_close();
            echo "</tr>";
        }
    echo "</table>";   
?>
