<?php
session_start();
if (empty($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$file = __DIR__ . "/respuestas.csv";
$rows = [];
$headers = [];

if (file_exists($file) && filesize($file) > 0) {
    if (($fp = fopen($file, "r")) !== false) {
        $headers = fgetcsv($fp);
        while (($r = fgetcsv($fp)) !== false) {
            $rows[] = $r;
        }
        fclose($fp);
    }
}

$counts = [];
foreach ($rows as $r) {
    $tema = $r[2] ?? '';
    if ($tema !== '') {
        $counts[$tema] = ($counts[$tema] ?? 0) + 1;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Panel admin</title>
<style>
body{font-family:Arial;background:#ffe4ec;margin:0;padding:24px;color:#2f2f2f}
.card{background:#fff;padding:22px;border-radius:18px;box-shadow:0 12px 30px rgba(214,51,132,.08);max-width:1200px;margin:0 auto}
h1{color:#d63384;margin-top:0}
.top{display:flex;gap:10px;flex-wrap:wrap;justify-content:space-between;align-items:center}
a.btn{display:inline-block;padding:10px 14px;background:#ff85a2;color:white;text-decoration:none;border-radius:12px}
table{width:100%;border-collapse:collapse;margin-top:16px;font-size:14px}
th,td{border:1px solid #f1d3dc;padding:8px 10px;vertical-align:top;text-align:left}
th{background:#fff0f5}
.small{color:#6b7280}
.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:10px;margin-top:14px}
.stat{background:#fff0f5;border:1px solid #f8dbe4;border-radius:14px;padding:14px}
.stat strong{display:block;color:#d63384;font-size:24px}
</style>
</head>
<body>
<div class="card">
  <div class="top">
    <div>
      <h1>Panel de resultados</h1>
      <div class="small">Respuesta total: <?php echo count($rows); ?></div>
    </div>
    <div>
      <a class="btn" href="respuestas.csv" download>Descargar CSV</a>
      <a class="btn" href="logout.php">Salir</a>
    </div>
  </div>

  <div class="grid">
    <?php foreach ($counts as $tema => $n): ?>
      <div class="stat"><strong><?php echo (int)$n; ?></strong><?php echo htmlspecialchars($tema); ?></div>
    <?php endforeach; ?>
    <?php if (!$counts): ?>
      <div class="small">Todavía no hay respuestas guardadas.</div>
    <?php endif; ?>
  </div>

  <?php if ($rows): ?>
    <table>
      <thead>
        <tr>
          <?php foreach ($headers as $h): ?>
            <th><?php echo htmlspecialchars($h); ?></th>
          <?php endforeach; ?>
        </tr>
      </thead>
      <tbody>
        <?php foreach (array_slice($rows, max(0, count($rows)-10)) as $r): ?>
          <tr>
            <?php foreach ($r as $cell): ?>
              <td><?php echo htmlspecialchars($cell); ?></td>
            <?php endforeach; ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>
</body>
</html>
