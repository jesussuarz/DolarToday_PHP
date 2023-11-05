# DolarToday PHP

## Obtener el valor del dolar paralelo de venezuela con DolarToday

Lo anterior es un codigo PHP que cree para obtener desde DolarToday.com el valor del dolar en Venezuela actualizado, Esto dado que ya no se obtiene desde la api que estaba publicada en: https://s3.amazonaws.com/dolartoday/data.json

El resultado final es el siguiente: 

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
Nota importante: El firewall del servidor de dolartoday podria bloquearte facilmente en caso de que intentes recuperar el valor del dolar en repetidas ocaciones o muy frecuente, te recomiendo que obtengas el valor cada X cantidad de tiempo prudente y almacenes los valores obtenidos en tu base de datos para que la consulta se torne un poco mas sencilla. De esta forma evitaras de que puedas obtener valores nulos, o no obtener nada desde la respuesta del server de dolartoday. 

Postdata: Usalo con mucha responsabilidad. :)
