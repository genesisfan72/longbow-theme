<?php
/**
 * @package longbow
 */
?>

<div class="social-shares wrap">
    <div class="container toparentheight">
        <div class="row toparentheight">
            <div class="col-xs-12 alignvertical">
                <div class="row row-centered">
                    <div class="col-xs-4 col-sm-2 col-centered social-share centertext">
                        <i class="fa fa-facebook"></i><?php get_facebook_shares( $post->ID ); ?>
                    </div>

                    <div class="col-xs-4 col-sm-2 col-centered social-share centertext">
                        <!--                        <i class="fa fa-twitter"></i>--><?php //get_twitter_shares( $post->ID ); ?>
                        <i class="fa fa-twitter"></i>18240
                    </div>

                    <div class="col-xs-4 col-sm-2 col-centered social-share centertext">
                        <i class="fa fa-pinterest"></i><?php get_pinterest_shares( $post->ID ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

