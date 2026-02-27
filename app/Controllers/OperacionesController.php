<?php

namespace App\Controllers;

use App\Models\Calculadora;
use Dompdf\Dompdf;
use Carbon\Carbon; 

class OperacionesController 
{
    public function procesarFormulario($datosPOST) 
    {
        $calculadora = new Calculadora();
        $resultados = [];

        // Validamos Salario
        if (isset($datosPOST['salario_base']) && is_numeric($datosPOST['salario_base'])) {
            $resultados['salario'] = $calculadora->calcularSalarioNeto($datosPOST['salario_base']);
        }

        // Validamos Interés
        if (isset($datosPOST['capital']) && isset($datosPOST['tasa']) && isset($datosPOST['plazo'])) {
            $resultados['interes'] = $calculadora->calcularInteresCompuesto(
                $datosPOST['capital'], 
                $datosPOST['tasa'], 
                $datosPOST['plazo']
            );
        }

        // Si el usuario hizo clic en el botón de PDF, llamamos a la función
        if (isset($datosPOST['accion']) && $datosPOST['accion'] === 'pdf' && !empty($resultados)) {
            $this->generarPDF($resultados);
        }

        return $resultados;
    }

    // Nuevo método privado que se encarga exclusivamente de armar el PDF
    private function generarPDF($resultados) 
    {
        //Carbon para la fecha 
        Carbon::setLocale('es');
        $fechaActual = Carbon::now('America/Bogota')->isoFormat('LLLL'); // Formato: jueves, 26 de febrero de 2026 14:30

        
        $html = "<h1 style='color: #0d6efd;'>Recibo de Operación Matemática</h1>";
        $html .= "<p><strong>Fecha de consulta:</strong> " . ucfirst($fechaActual) . "</p>";
        $html .= "<hr>";
        
        if (isset($resultados['salario'])) {
            $html .= "<h3>Cálculo de Salario Neto</h3>";
            $html .= "<p>Salario Base: $" . number_format($resultados['salario']['salario_base'], 0, ',', '.') . "</p>";
            $html .= "<p>Descuentos de Ley: $" . number_format($resultados['salario']['descuentos'], 0, ',', '.') . "</p>";
            $html .= "<h2><strong>Neto a pagar: $" . number_format($resultados['salario']['neto_a_pagar'], 0, ',', '.') . "</strong></h2>";
        }

        if (isset($resultados['interes'])) {
            $html .= "<h3>Cálculo de Interés Compuesto</h3>";
            $html .= "<p>Capital Inicial: $" . number_format($resultados['interes']['capital_inicial'], 0, ',', '.') . "</p>";
            $html .= "<p>Ganancia Generada: $" . number_format($resultados['interes']['ganancia'], 0, ',', '.') . "</p>";
            $html .= "<h2><strong>Monto Total: $" . number_format($resultados['interes']['monto_total'], 0, ',', '.') . "</strong></h2>";
        }

        //DomPDF 
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        
        
        $dompdf->stream("reporte_calculo.pdf", ["Attachment" => true]);
        
        
        exit; 
    }
}