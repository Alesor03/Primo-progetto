<?php
/**
 * Template Name: Risultati
 */
get_header();
?>
<section class="risultati">
    <h2>Risultati</h2>
    <table class="table-dynasty">
        <thead>
            <tr>
                <th>Partita</th>
                <th>Punteggio</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Esempio di dati, in pratica potrebbero essere recuperati dal database
            $risultati = array(
                array('match' => 'Squadra A vs Squadra B', 'score' => '2 - 1'),
                array('match' => 'Squadra C vs Squadra D', 'score' => '0 - 0'),
            );
            foreach ( $risultati as $r ) :
            ?>
            <tr>
                <td><?php echo esc_html( $r['match'] ); ?></td>
                <td><?php echo esc_html( $r['score'] ); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>
<?php
get_footer();
