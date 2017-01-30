<a href="/product/all" id="affix" data-spy="affix" data-offset-top="150" data-offset-bottom="300">Вернуться ко всем товарам</a>
<div class="single">
    <div class="col-md-12">
        <div class="single_grid">
            <div class="grid images_3_of_2">
                <?php if($data['product']['is_new']) :?>
                <img class="img-responsive new-product-2" src="/webroot/images/new.png" width="60" alt="">
                <?php endif; ?>
                <img class="img-responsive" src="<?php echo \Model\ProductModel::getImage($data['product']['id']); ?>" alt="">
                <div class="clearfix"></div>
            </div>
            <!---->
            <div class="span1_of_1_des">
                <div class="desc1">
                    <h3><?php echo $data['product']['title']; ?></h3>
                    <div class="info">
                        <span class="first">Производитель: <span><?php echo $data['product']['vendor']; ?></span></span>
                        <span class="first">Тип кофе: <span><?php echo $data['product']['vendor']; ?></span></span>
                    </div>
                    <p class="price">Цена:
                    <?php if($data['product']['discount'] > 0 && $data['product']['discount'] < 1):?>
                        <span><s><?php echo number_format($data['product']['price'], 2); ?></s></span>
                        <span class="value"><?php echo number_format(($data['product']['price'] - ($data['product']['price'] * $data['product']['discount'])), 2); ?> ₴</span>
                        <span class="discount">(-<?php echo $data['product']['discount'] * 100; ?>% скидка)</span>
                    <?php else: ?>
                        <span><?php echo number_format($data['product']['price'], 2); ?> ₴</span>
                    <?php endif; ?>
                    </p>
                    <div class="available">
                        <ul>
                            <li>Количество:
                                <input id="quantity" type="number" value="1">
                            </li>
                            <span class="get"></span>
                            <li>
                                <?php if($data['product']['in_stock']): ?>
                                <span class="yes"><i class="fa fa-check fa-lg"></i> Есть в наличии</span>
                                <?php else: ?>
                                <span class="no"><i class="fa fa-close fa-lg"></i> Нет в наличии</span>
                                <?php endif; ?>
                            </li>
                        </ul>
                        <div class="form-in">
                            <a id="amount" href="#" class="hvr-shutter-in-horizontal add-to-cart" product-id="<?php echo $data['product']['id']; ?>" amount="1">В корзину</a>
                        </div>
                    </div>
                    <div>
                        <h4 class="description">Описание:</h4>
                        <p><?php echo $data['product']['description']; ?></p>
                    </div>
                    <!-- Comment Section -->
                    <div class="comment-section">
                        <h3>Отзывы<span>(<?php echo count($data['comments']); ?>)</span></h3>
                        <!-- Media List -->
                        <ul class="media-list">
                            <?php if($data['comments']): ?>
                                <?php foreach ($data['comments'] as $comment) : ?>
                                    <li class="media">
                                        <div class="media-body">
                                            <div class="media-heading">
                                                <h3><?php echo $comment['author']; ?><span><?php echo $comment['date']; ?></span></h3>
                                            </div>
                                            <p><?php echo $comment['comment']; ?></p>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <h4>Еще нет ни одного отзыва</h4>
                            <?php endif;?>
                        </ul><!-- Media List /- -->

                        <?php if(\Common\Session::get('login')): ?>
                        <hr>
                        <!-- Leave Comment -->
                        <form method="post" class="contact-form leave-comment">
                            <h3>Ваш отзыв</h3>
                            <?php if(isset($data['warning'])) :?>
                                <div class="col-sm-10 col-sm-offset-1 alert alert-danger info-box" role="alert"><?php echo $data['warning']; ?></div>
                            <?php endif; ?>
                            <div class="row">
                                <div class="col-xs-12 name-on comment-field">
                                                    <textarea name="comment"
                                                              placeholder="Сообщение*"></textarea>
                                </div>
                                <input type="hidden" name="productId"
                                       value="<?php echo $data['product']['id'] ?>">
                                <input type="hidden" name="author"
                                       value="<?php echo \Common\Session::get('name') ?>">
                            </div>
                            <input id="post" type="submit" onclick="saveScroll()" value="Оставить">
                        </form>    <!-- Leave Comment /- -->
                        <?php else: ?>
                            <div class="to-comment"><b>Чтобы оставить отзыв, нужно <a href="/user/login">авторизоваться!</a></b></div>
                        <?php endif; ?>
                    </div><!-- Comment Section /- -->
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!---->
    <div class="clearfix"></div>
</div>
