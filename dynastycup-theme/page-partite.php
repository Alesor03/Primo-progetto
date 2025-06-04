<?php
/**
 * Template Name: Partite
 */
get_header();
?>
<section class="partite">
    <h2>Calendario Partite</h2>
    <?php
    // Esempio di calendario diviso per giorno
    $giorni = array(
        'Giorno 1' => array(
            array('ora' => '10:00', 'match' => 'Squadra A vs Squadra B'),
            array('ora' => '14:00', 'match' => 'Squadra C vs Squadra D'),
        ),
        'Giorno 2' => array(
            array('ora' => '10:00', 'match' => 'Squadra E vs Squadra F'),
            array('ora' => '14:00', 'match' => 'Squadra G vs Squadra H'),
        ),
    );
    foreach ( $giorni as $giorno => $partite ) :
    ?>
        <h3><?php echo esc_html( $giorno ); ?></h3>
        <ul>
        <?php foreach ( $partite as $p ) : ?>
            <li><?php echo esc_html( $p['ora'] . ' - ' . $p['match'] ); ?></li>
        <?php endforeach; ?>
        </ul>
    <?php endforeach; ?>
</section>
<?php
get_footer();
