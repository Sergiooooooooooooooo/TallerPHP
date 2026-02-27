<?php

$estudiantes = [
    ['nombre' => 'Sergio', 'calificacion' => 4.2, 'carrera' => 'Sistemas'],
    ['nombre' => 'David', 'calificacion' => 3.1, 'carrera' => 'Sistemas'],
    ['nombre' => 'Sebastian', 'calificacion' => 4.8, 'carrera' => 'Medicina'],
    ['nombre' => 'Juan', 'calificacion' => 3.5, 'carrera' => 'Medicina'],
    ['nombre' => 'Ana', 'calificacion' => 2.8, 'carrera' => 'Arquitectura'],
    ['nombre' => 'Sofía', 'calificacion' => 4.0, 'carrera' => 'Arquitectura'],
];

//a
$totales = [];
$conteos = [];

foreach ($estudiantes as $estudiante) {
    $carrera = $estudiante['carrera'];
    $nota = $estudiante['calificacion'];

    if (!isset($totales[$carrera])) {
        $totales[$carrera] = 0;
        $conteos[$carrera] = 0;
    }

    $totales[$carrera] += $nota;
    $conteos[$carrera]++;
}

$promediosPorCarrera = [];
foreach ($totales as $carrera => $total) {
    $promediosPorCarrera[$carrera] = $total / $conteos[$carrera];
}

//b
$promediosOrdenados = $promediosPorCarrera;
asort($promediosOrdenados);


$carreraMasDificil = array_key_first($promediosOrdenados);


// c
$estudiantesDestacados = [];

foreach ($estudiantes as $estudiante) {
    $carrera = $estudiante['carrera'];
    if ($estudiante['calificacion'] > $promediosPorCarrera[$carrera]) {
        $estudiantesDestacados[] = $estudiante['nombre'];
    }
}


echo "1a. Promedios por carrera:";
print_r($promediosPorCarrera);

echo "<br>";

echo "1b. La carrera con el promedio más bajo es: " . $carreraMasDificil . " (" . $promediosPorCarrera[$carreraMasDificil] . ")";
echo "<br>";

echo "1c. Estudiantes por encima del promedio de su carrera: ";
print_r($estudiantesDestacados);

echo "<br>";
?>