<?php

$envios = [
    ['id' => 1, 'ciudad' => 'Medellin', 'transportista' => 'Sergio', 'peso' => 12, 'costo_kilo' => 1500, 'estado' => 'Entregado'],
    ['id' => 2, 'ciudad' => 'Bogota', 'transportista' => 'Valeria', 'peso' => 8, 'costo_kilo' => 2000, 'estado' => 'En ruta'],
    ['id' => 3, 'ciudad' => 'Cali', 'transportista' => 'Sergio', 'peso' => 5, 'costo_kilo' => 1800, 'estado' => 'Entregado'],
    ['id' => 4, 'ciudad' => 'Medellin', 'transportista' => 'Andres', 'peso' => 20, 'costo_kilo' => 1500, 'estado' => 'Cancelado'],
    ['id' => 5, 'ciudad' => 'Bogota', 'transportista' => 'Valeria', 'peso' => 15, 'costo_kilo' => 2000, 'estado' => 'Entregado'],
    ['id' => 6, 'ciudad' => 'Medellin', 'transportista' => 'Sergio', 'peso' => 10, 'costo_kilo' => 1500, 'estado' => 'Entregado'],
];


$costoTotalEntregados = 0;
$pesoPorCiudad = [];
$entregasPorTransportista = [];


foreach ($envios as $envio) {
   
    if ($envio['estado'] === 'Entregado') {
        
        
        $costoTotalEntregados += ($envio['peso'] * $envio['costo_kilo']);
        
        
        $ciudad = $envio['ciudad'];
        $pesoPorCiudad[$ciudad] = ($pesoPorCiudad[$ciudad] ?? 0) + $envio['peso'];
        
        
        $transportista = $envio['transportista'];
        $entregasPorTransportista[$transportista] = ($entregasPorTransportista[$transportista] ?? 0) + 1;
    }
}


arsort($pesoPorCiudad);
arsort($entregasPorTransportista);


$ciudadMayorPeso = array_key_first($pesoPorCiudad);
$mejorTransportista = array_key_first($entregasPorTransportista);


echo "2.1 Costo total de envíos entregados: $" . number_format($costoTotalEntregados, 0, ',', '.');
echo "<br>";
echo "2.2 La ciudad que ha recibido más peso es: " . $ciudadMayorPeso . " (" . $pesoPorCiudad[$ciudadMayorPeso] . " kg)";
echo "<br>";
echo "2.3 Transportista con más entregas exitosas: " . $mejorTransportista . " (" . $entregasPorTransportista[$mejorTransportista] . " entregas)";
echo "<br>";

?>