<div class="contact">
    <h2>Контакты</h2>
    <?php if(isset($data['warning'])) :?>
        <div class="col-sm-4 col-sm-offset-4 alert alert-danger info-box" role="alert"><?php echo $data['warning']; ?></div>
    <?php endif; ?>
    <?php if(isset($data['success'])) :?>
        <div class="col-sm-4 col-sm-offset-4 alert alert-success info-box" role="alert"><?php echo $data['success']; ?></div>
    <?php endif; ?>
    <div class="contact-grids">
        <div class="contact-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d20314.73873212426!2d30.64522813600615!3d50.471970212133066!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1suk!2sua!4v1483404589741"></iframe>
        </div>
        <div class="top-contact">
            <div class=" col-md-3 contact-right">
                <h3>Информация о компании</h3>
                <p>500 Lorem Ipsum Dolor Sit,</p>
                <p>22-56-2-9 Sit Amet, Lorem,</p>
                <p>Украина</p>
                <p>Телефон: (00) 222 666 444</p>
                <p>Факс: (000) 000 00 00 0</p>
                <p>Email: <a href="mailto:info@mycompany.com">info@mycompany.com</a></p>
                <p>Подписаться: <a href="#">Facebook</a>, <a href="#">Twitter</a></p>
            </div>
            <div class="col-md-8 contact-form">
                <h3>Свяжитесь с нами</h3>
                <form action="" method="post">
                    <div class="contact-in">
                        <div class="name-in">
                            <span>Имя:</span>
                            <input type="text" name="name" value="">
                        </div>
                        <div class="name-in">
                            <span>Email:</span>
                            <input type="text" name="email" value="">
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="name-on">
                        <span>Сообщение:</span>
                        <textarea name="message"></textarea>
                    </div>
                    <input type="submit" value="Отправить">
                </form>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>