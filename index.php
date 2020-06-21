<?php
    if ($db = mysqli_connect(
        'localhost',
        'root',
        '',
        'teste_php',
        3306
    )) {
    } else {
        die("Problema ao conectar ao SGDB");
    }
    $handle = fopen("excel-tabela-teste.csv", "r");
    $header = fgetcsv($handle, 1000, ";");
    while ($row = fgetcsv($handle, 1000, ";")) {
        $nota[] = array_combine($header, $row);
    }
    $preparada = mysqli_prepare($db, '	INSERT INTO informacoes ( agente, cliente, valor) VALUES ( ?, ?, ?)');
    for ($i=0; $i < count($nota); $i++) { 
        mysqli_stmt_bind_param($preparada,'ssd', $nota[$i]['AGENTE'], $nota[$i]['CLIENTE'], $nota[$i]['VALOR ORIGINAL'] );
        mysqli_stmt_execute($preparada);
    }
    fclose($handle);
?>