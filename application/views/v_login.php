<?php
    if($this->session->userdata("login")){
        redirect(site_url()."/c_automoviles/index");
    }
    else if($this->session->has_userdata("alquiler")){
        $this->session->unset_userdata("alquiler");
    }
    echo "<table>";
    echo form_open(site_url()."/c_automoviles/login");
        echo "<tr>";
            echo "<th>USUARIO</th>";
            echo "<td>".form_input("username")."</td>";
        echo "</tr>";
        echo "<tr>";
            echo "<th>CONTRASEÑA</th>";
            echo "<td>". form_password("password")."</td>";
        echo "</tr>";
        echo "<tr>";
            echo "<td colspan='2'>";
                echo form_submit("submit", "INICIAR SESIÓN");
            echo "</td>";
        echo "</tr>";
    echo "</table>";
    echo "<a href='". site_url()."/c_automoviles/registro'>¿No tienes cuenta? Crea una aquí</a>";
    echo $error;
?>