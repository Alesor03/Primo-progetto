<?php
// trading-bot.php
// Script per analizzare i prezzi delle criptovalute e registrare le azioni da eseguire

// Inclusione del file di configurazione per la connessione al database
require_once 'config.php';

// Array che conterr\xC3\xA0 i dati da mostrare in tabella
$risultati = [];

try {
    // Recupero di tutte le criptovalute presenti nella tabella prezzi_crypto
    $cryptos = $pdo->query("SELECT DISTINCT crypto FROM prezzi_crypto")->fetchAll(PDO::FETCH_COLUMN);

    // Preparazione della query per ottenere gli ultimi 5 prezzi di una singola crypto
    $stmtPrezzi = $pdo->prepare("SELECT prezzo, data FROM prezzi_crypto WHERE crypto = ? ORDER BY data DESC LIMIT 5");

    // Preparazione della query per registrare l'azione nel log
    $stmtLog = $pdo->prepare("INSERT INTO trades_log (crypto, data, prezzo_attuale, azione) VALUES (?, NOW(), ?, ?)");

    foreach ($cryptos as $crypto) {
        // Esecuzione della query dei prezzi
        $stmtPrezzi->execute([$crypto]);
        $prezzi = $stmtPrezzi->fetchAll();

        // Estrazione dei soli prezzi in un array
        $listaPrezzi = array_column($prezzi, 'prezzo');

        $azione = 'NESSUNA AZIONE';

        // Verifica dell'andamento degli ultimi tre prezzi se disponibili
        if (count($listaPrezzi) >= 3) {
            if ($listaPrezzi[0] > $listaPrezzi[1] && $listaPrezzi[1] > $listaPrezzi[2]) {
                $azione = 'ACQUISTO';
            } elseif ($listaPrezzi[0] < $listaPrezzi[1] && $listaPrezzi[1] < $listaPrezzi[2]) {
                $azione = 'VENDITA';
            }
        }

        // Prezzo pi\xC3\xB9 recente utilizzato per il log
        $prezzoAttuale = $listaPrezzi[0] ?? 0;

        // Registrazione dell'azione nel database
        $stmtLog->execute([$crypto, $prezzoAttuale, $azione]);

        // Timestamp dell'azione eseguita
        $timestamp = date('Y-m-d H:i:s');

        // Salvataggio dati per la visualizzazione
        $risultati[] = [
            'crypto'    => $crypto,
            'prezzi'    => $listaPrezzi,
            'azione'    => $azione,
            'timestamp' => $timestamp
        ];
    }
} catch (PDOException $e) {
    // Gestione semplice degli errori di database
    die('Errore database: ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Trading Bot</title>
    <style>
        table { border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; }
    </style>
</head>
<body>
<h1>Report Trading Bot</h1>
<table>
    <thead>
        <tr>
            <th>Crypto</th>
            <th>Prezzi Recenti</th>
            <th>Azione</th>
            <th>Ultima Azione</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($risultati as $r): ?>
        <tr>
            <td><?php echo htmlspecialchars($r['crypto']); ?></td>
            <td><?php echo htmlspecialchars(implode(', ', $r['prezzi'])); ?></td>
            <td><?php echo htmlspecialchars($r['azione']); ?></td>
            <td><?php echo htmlspecialchars($r['timestamp']); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>
