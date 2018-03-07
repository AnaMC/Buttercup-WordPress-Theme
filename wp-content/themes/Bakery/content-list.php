
                        <div class="col-md-12">
                            <a href="<?php the_permalink(); ?>" class="tituloPost"><?php the_title();?></a></br>
                            <div class="infoPost">
                                <span><i class="fa fa-calendar" aria-hidden="true"></i><span class="WPDate">&nbsp;<?php the_time('j-m-Y'); ?></span></span>
                                <span><i class="fa fa-user" aria-hidden="true"></i><span class="WPAuthor">&nbsp;<?php echo get_the_author_posts_link() ?></span></span>
                                <span><i class="fa fa-comments" aria-hidden="true"></i><span class="WPComments">&nbsp;<?php echo 'No hay comentarios'; ?></span></span>
                            </div>
                        </div></br></br>