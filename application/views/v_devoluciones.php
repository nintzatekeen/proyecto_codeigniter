<?php
    if($this->session->userdata("login")[1]!="admin"){
        redirect(site_url()."/c_automoviles/index");
    }
    echo "<table>";
        echo "<caption>Estado de devolución de los automóviles</caption>";
        echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Automóvil</th>";
            echo "<th>Matrícula</th>";
            echo "<th>Estado</th>";
        echo "</tr>";
        foreach($carros as $carro){
            echo "<tr>";
                echo "<td>$carro->id</td>";
                echo "<td>$carro->marca $carro->modelo</td>";
                echo "<td>$carro->matricula</td>";
                if($carro->devuelto==1){
                    echo "<td>DEVUELTO</td>";
                }
                else{
                    echo form_open(site_url()."/c_automoviles/devoluciones");
                        echo "<td>";
                            echo form_hidden("idauto", $carro->id);
                            echo form_submit("submit", "MARCAR COMO DEVUELTO");
                        echo "</td>";
                    echo form_close();
                }
            echo "</tr>";
        }
    echo "</table>";
?>