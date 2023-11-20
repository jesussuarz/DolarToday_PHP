# DolarToday PHP

## Obtén el Valor del Dólar Paralelo en Venezuela con DolarToday

Este código PHP que he desarrollado te permite obtener el valor actualizado del dólar en Venezuela desde DolarToday.com. Esto es especialmente útil dado que la API que solía proporcionar esta información (https://s3.amazonaws.com/dolartoday/data.json) ya no está disponible.

El resultado final del script te brindará el valor del dólar actualizado.

![alt text](https://github.com/jesussuarz/DolarToday_PHP/blob/main/dolartoday_php.png?raw=true)

```php
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
      // Imprime el array asociativo directamente
      echo '<pre>';
      print_r($data);
      echo '</pre>';
}
?>


```

**Nota Importante:** El firewall del servidor de DolarToday podría bloquearte si intentas recuperar el valor del dólar en repetidas ocasiones o con demasiada frecuencia. Se recomienda obtener el valor cada cierto tiempo y almacenar los resultados en tu base de datos para facilitar futuras consultas. Esto ayudará a evitar posibles respuestas nulas o la falta de datos del servidor de DolarToday.

**Postdata:** Úsalo con responsabilidad. No me hago responsable del mal uso que se le pueda dar. :)
