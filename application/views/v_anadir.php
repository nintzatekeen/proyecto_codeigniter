<?php
    if($this->session->userdata("login")[1]!="admin"){
        redirect(site_url()."/c_automoviles/index");
    }
    echo "<h2>AÑADIR VEHÍCULO</h2>";
    if(!$added){
        echo form_open_multipart(site_url()."/c_automoviles/anadir");
            echo "<table>";
                echo "<tr>";
                    echo "<td><strong>Marca</strong></td>";
                    echo "<td>".form_input("marca")."</td>";
                echo "<tr>";
                echo "<tr>";
                    echo "<td><strong>Modelo</strong></td>";
                    echo "<td>".form_input("modelo")."</td>";
                echo "<tr>";
                echo "<tr>";
                    echo "<td><strong>Matrícula</strong></td>";
                    echo "<td>".form_input("matricula")."</td>";
                echo "<tr>";
                echo "<tr>";
                    echo "<td><strong>Año</strong></td>";
                    echo "<td>".form_input("anio")."</td>";
                echo "<tr>";
                echo "<tr>";
                    echo "<td><strong>Combustible</strong></td>";
                    $comb=["gasolina"=>"gasolina", "diesel"=>"diesel", "electrico"=>"electrico", "hibrido"=>"hibrido", "glp"=>"glp", "hidrogeno"=>"hidrogeno"];
                    echo "<td>". form_dropdown("combustible", $comb)."</td>";
                echo "<tr>";
                echo "<tr>";
                    echo "<td><strong>Precio base/día</strong></td>";
                    echo "<td>".form_input("precio")."</td>";
                echo "<tr>";
                echo "<tr>";
                    echo "<td><strong>Imágenes</strong></td>";
                    echo "<td><input type='file' name='imagenes[]' multiple='multiple'</td>";
                echo "<tr>";
                echo "<tr>";
                    echo "<td colspan='2'>".form_submit("submit", "AÑADIR")."</td>";
                echo "<tr>";
            echo "</table>";
        echo form_close();
    }
    else{
        echo "<p>VEHÍCULO AÑADIDO A LA BASE DE DATOS CON ÉXITO</p>";
    }
?>