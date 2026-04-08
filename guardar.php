<?php
session_start();

if (empty($_SESSION['curso'])) {
    header("Location: index.html");
    exit;
}

$csv = __DIR__ . "/respuestas.csv";
$exists = file_exists($csv) && filesize($csv) > 0;

$tema = $_POST['tema'] ?? '';
$next = $_POST['next'] ?? 'fin.php';

$temasEsi = $_POST['temas_esi'] ?? [];
if (is_array($temasEsi)) {
    $temasEsi = implode(" | ", $temasEsi);
} else {
    $temasEsi = '';
}

$columns = [
    "Fecha",
    "Curso",
    "Tema",
    "novi@",
    "vida_sexual",
    "info_futuro",
    "preservativo",
    "otros_anticonceptivos",
    "preservativo_conoce",
    "otros_metodos",
    "escuela_anti",
    "bullying",
    "motivo_bullying",
    "orientacion",
    "abierto_sexualidad",
    "discriminado_sexualidad",
    "identidad_genero",
    "abierto_identidad",
    "discriminado_identidad",
    "alcohol_vez",
    "alcohol_frecuencia",
    "sustancias_vez",
    "sustancias_frecuencia",
    "imagen_corporal",
    "redes_influyen",
    "comparacion",
    "esi_suficiente",
    "temas_esi"
];

$row = [
    date("Y-m-d H:i:s"),
    $_SESSION['curso'],
    $tema,
    $_POST['novi@'] ?? '',
    $_POST['vida_sexual'] ?? '',
    $_POST['info_futuro'] ?? '',
    $_POST['preservativo'] ?? '',
    $_POST['otros_anticonceptivos'] ?? '',
    $_POST['preservativo_conoce'] ?? '',
    $_POST['otros_metodos'] ?? '',
    $_POST['escuela_anti'] ?? '',
    $_POST['bullying'] ?? '',
    $_POST['motivo_bullying'] ?? '',
    $_POST['orientacion'] ?? '',
    $_POST['abierto_sexualidad'] ?? '',
    $_POST['discriminado_sexualidad'] ?? '',
    $_POST['identidad_genero'] ?? '',
    $_POST['abierto_identidad'] ?? '',
    $_POST['discriminado_identidad'] ?? '',
    $_POST['alcohol_vez'] ?? '',
    $_POST['alcohol_frecuencia'] ?? '',
    $_POST['sustancias_vez'] ?? '',
    $_POST['sustancias_frecuencia'] ?? '',
    $_POST['imagen_corporal'] ?? '',
    $_POST['redes_influyen'] ?? '',
    $_POST['comparacion'] ?? '',
    $_POST['esi_suficiente'] ?? '',
    $temasEsi
];

$fp = fopen($csv, "a");
if (!$exists) {
    fputcsv($fp, $columns);
}
fputcsv($fp, $row);
fclose($fp);

header("Location: " . $next);
exit;
?>
