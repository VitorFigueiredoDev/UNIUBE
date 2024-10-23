<?php
function validarCPF($cpf) {
    // Remove caracteres não numéricos
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    
    // Verifica se o CPF tem 11 dígitos
    if (strlen($cpf) != 11 || preg_match('/^(\d)\1{10}$/', $cpf)) {
        return false;
    }

    // Valida o primeiro dígito verificador
    for ($i = 1, $soma = 0; $i <= 9; $i++) {
        $soma += $cpf[$i - 1] * (11 - $i);
    }
    $resto = $soma % 11;
    $digito1 = ($resto < 2) ? 0 : 11 - $resto;

    // Valida o segundo dígito verificador
    for ($i = 1, $soma = 0; $i <= 10; $i++) {
        $soma += $cpf[$i - 1] * (12 - $i);
    }
    $resto = $soma % 11;
    $digito2 = ($resto < 2) ? 0 : 11 - $resto;

    return ($digito1 == $cpf[9] && $digito2 == $cpf[10]);
}
?>
