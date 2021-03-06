
      <?php


        $post_type_custom = 'veiculo';

        if( is_tax() ) {

          $tax_slug =  'categoria-do-veiculo';

          $args = array( 'post_type' => $post_type_custom, 'posts_per_page' => 15, 'order' => 'ASC', 'tax_query' => array( array( 'taxonomy' => $tax_slug,'field' => 'slug','terms' => get_queried_object()->slug,),), );

        } elseif ( is_home() || is_front_page() ) {

          $args = array( 'post_type' => $post_type_custom, 'posts_per_page' => 8, 'order' => 'ASC' );

        } elseif ( is_single() ) {

          $args = array( 'post_type' => $post_type_custom, 'posts_per_page' => 8, 'order' => 'ASC', 'post__not_in' => array( $post->ID ) );

        } else {

          $args = array( 'post_type' => $post_type_custom, 'posts_per_page' => 8, 'order' => 'ASC' );

        }



        

        $loop = new WP_Query( $args );



          while ( $loop->have_posts() ) : $loop->the_post();

    

          $slug = basename(get_permalink());

          $classItem = $slug;

    

            //Campos Personalizados

            $preco = get_post_custom_values('wpcf-preco');

            $preco = $preco[0];

            //$preco = number_format($preco, 2, ',', '.');



            $parcelas = get_post_custom_values('wpcf-parcelas');

            $parcelas = $parcelas[0];



            $valorDaParcela = get_post_custom_values('wpcf-valor-da-parcela');

            $valorDaParcela = $valorDaParcela[0];

            //$valorDaParcela = number_format($valorDaParcela, 2, ',', '.');

      ?> 

<?php if ( is_page( 'veiculos' ) ) { 
echo '<div class="owl-item">';
}
  ?>

      <div class="item">

        <h4><?php echo the_title(); ?></h4>

        <a class="image" href="<?php echo get_permalink(); ?>" title="<?php echo the_title_attribute( 'echo=0' ); ?>" rel="bookmark">

          <div class="info">

            <figure class="hvr-grow wow zoomIn">

              <?php 

                imagem_destacada('full', 'wow pulse', get_the_title(), '')

              ?>

              <figcaption>

                <span>R$ <?php echo $preco ?></span>

                <strong><?php echo $parcelas . 'X de <strong>R$ ' . $valorDaParcela . '</strong>' ?></strong>

              </figcaption>

            </figure>



            <?php trackButton('link', 'productView_'. get_the_ID(), 'Clicado', get_the_title(), get_post_permalink(), get_the_title(), 'productView_'. get_the_ID(), 'btn btn__carros wow zoomIn hvr-hollow', 'Simule aqui'); ?>

          </div>

        </a>

      </div>

      <?php if ( is_page( 'veiculos' ) ) { 
echo '</div>';
}
  ?>

      <?php endwhile; ?>   