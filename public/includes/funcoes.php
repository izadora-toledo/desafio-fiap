<?php

class Funcoes {
    // Método para converter data para o formato br
    public static function converterDataParaBR($data) {
        if (preg_match("/^\d{4}-\d{2}-\d{2}$/", $data)) {
            $partes = explode("-", $data);
            return $partes[2] . "/" . $partes[1] . "/" . $partes[0];
        }
        return $data; // Se o formato estiver incorreto, retorna a própria data
    }
}

