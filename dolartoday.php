<?php
$curl = curl_init();
$monto_calcular = 1;
if(curl_errno($curl)) {
    echo 'Error de cURL: ' . curl_error($curl);
}
else {
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://dolartoday.com/wp-admin/admin-ajax.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'action=dt_currency_calculator_handler&amount=' . $monto_calcular. '',
        CURLOPT_HTTPHEADER => array(
          'Content-Type: application/x-www-form-urlencoded'
        ),
      ));
      $response = curl_exec($curl);
      curl_close($curl);
      // Decodifica la cadena JSON en un array o objeto
      $data = json_decode($response, true); // El segundo parámetro convierte a un array asociativo
      // Vuelve a codificar el array en una cadena JSON sin escapar caracteres especiales
      $jsonFormatted = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
      // Reemplaza los saltos de línea con etiquetas <br> para que se muestre en HTML
      $jsonFormatted = nl2br($jsonFormatted);
      // Imprime la cadena JSON formateada
      echo $jsonFormatted;
}
?>


