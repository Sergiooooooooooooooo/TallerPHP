<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taller PHP Avanzado - MVC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light pb-5">

<div class="container mt-5">
    <h1 class="text-center mb-4">Calculadora de Operaciones</h1>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Cálculo de Salario Neto</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="index.php">
                        <div class="mb-3">
                            <label for="salario_base" class="form-label">Salario Base (COP):</label>
                            <input type="number" class="form-control" id="salario_base" name="salario_base" required placeholder="Ej: 2000000" value="<?= $_POST['salario_base'] ?? '' ?>">
                        </div>
                        <div class="d-flex gap-2 align-items-center">
                            <button type="submit" name="accion" value="calcular" class="btn btn-primary flex-grow-1">Calcular</button>
                            <button type="submit" name="accion" value="pdf" class="btn btn-outline-primary flex-grow-1">Descargar PDF</button>
                            <a href="index.php" class="btn btn-sm btn-outline-secondary" title="Limpiar formulario">Limpiar</a>
                        </div>
                    </form>

                    <?php if (isset($resultados['salario'])): ?>
                        <div class="alert alert-success mt-3">
                            <strong>Neto a pagar:</strong> $<?= number_format($resultados['salario']['neto_a_pagar'], 0, ',', '.') ?><br>
                            <small>Descuentos (Salud/Pensión): $<?= number_format($resultados['salario']['descuentos'], 0, ',', '.') ?></small>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Cálculo de Interés Compuesto</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="index.php">
                        <div class="mb-3">
                            <label for="capital" class="form-label">Capital Inicial:</label>
                            <input type="number" class="form-control" id="capital" name="capital" required placeholder="Ej: 1000000" value="<?= $_POST['capital'] ?? '' ?>">
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="tasa" class="form-label">Tasa Anual (%):</label>
                                <input type="number" step="0.1" class="form-control" id="tasa" name="tasa" required placeholder="Ej: 5" value="<?= $_POST['tasa'] ?? '' ?>">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="plazo" class="form-label">Plazo (Años):</label>
                                <input type="number" class="form-control" id="plazo" name="plazo" required placeholder="Ej: 3" value="<?= $_POST['plazo'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="d-flex gap-2 align-items-center">
                            <button type="submit" name="accion" value="calcular" class="btn btn-success flex-grow-1">Calcular</button>
                            <button type="submit" name="accion" value="pdf" class="btn btn-outline-success flex-grow-1">Descargar PDF</button>
                            <a href="index.php" class="btn btn-sm btn-outline-secondary" title="Limpiar formulario">Limpiar</a>
                        </div>
                    </form>

                    <?php if (isset($resultados['interes'])): ?>
                        <div class="alert alert-success mt-3">
                            <strong>Monto Total:</strong> $<?= number_format($resultados['interes']['monto_total'], 0, ',', '.') ?><br>
                            <small>Ganancia generada: $<?= number_format($resultados['interes']['ganancia'], 0, ',', '.') ?></small>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>