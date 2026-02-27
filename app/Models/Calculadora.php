<?php


namespace App\Models;

class Calculadora 
{
    // Salario neto
    public function calcularSalarioNeto($salarioBase) 
    {
        //4% para salud y 4% para pensión
        $deduccionSalud = $salarioBase * 0.04;
        $deduccionPension = $salarioBase * 0.04;
        
        $salarioNeto = $salarioBase - ($deduccionSalud + $deduccionPension);
        
        return [
            'salario_base' => $salarioBase,
            'descuentos' => $deduccionSalud + $deduccionPension,
            'neto_a_pagar' => $salarioNeto
        ];
    }

    //Interés compuesto
    public function calcularInteresCompuesto($capital, $tasaAnual, $plazoAnios) 
    {
        // Fórmula: Capital * (1 + tasa)^plazo
        $tasaDecimal = $tasaAnual / 100;
        $montoFinal = $capital * pow((1 + $tasaDecimal), $plazoAnios);
        
        return [
            'capital_inicial' => $capital,
            'ganancia' => $montoFinal - $capital,
            'monto_total' => $montoFinal
        ];
    }
}   