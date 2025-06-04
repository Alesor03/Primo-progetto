<?php
/**
 * Template Name: Squadre e Gironi
 */
get_header();
?>
<section class="squadre">
    <h2>Squadre e Gironi</h2>
    <table class="table-dynasty">
        <thead>
            <tr>
                <th>Girone</th>
                <th>Squadra</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Array di esempio per la generazione dinamica
            $gironi = array(
                'A' => array('Squadra A', 'Squadra B'),
                'B' => array('Squadra C', 'Squadra D'),
            );
            foreach ( $gironi as $girone => $squadre ) :
                foreach ( $squadre as $squadra ) :
            ?>
            <tr>
                <td><?php echo esc_html( $girone ); ?></td>
                <td><?php echo esc_html( $squadra ); ?></td>
            </tr>
            <?php
                endforeach;
            endforeach;
            ?>
        </tbody>
    </table>
</section>
<?php
get_footer();
