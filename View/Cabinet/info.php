<div class="cabinet">
    <h2>Ваши данные</h2>
    <div class="col-sm-4 col-sm-offset-4 ">
        <table class="table table-bordered cabinet-info">
           <tr>
               <td class="to-left"><i class="fa fa-envelope-open fa-2x"></i> Email:</td>
               <td><?php echo $data['info']['email']; ?></td>
           </tr>
            <tr>
                <td class="to-left"><i class="fa fa-user-circle fa-2x"></i> Имя:</td>
                <td><?php echo $data['info']['name']; ?></td>
            </tr>
            <tr>
                <td class="to-left"><i class="fa fa-user-circle-o fa-2x"></i> Фамилия:</td>
                <td><?php echo $data['info']['surname']; ?></td>
            </tr>
            <tr>
                <td class="to-left"><i class="fa fa-phone fa-2x"></i> Телефон:</td>
                <td><?php echo $data['info']['tel']; ?></td>
            </tr>
            <tr>
                <td class="to-left"><i class="fa fa-paper-plane fa-2x"></i> Город:</td>
                <td><?php echo $data['info']['city']; ?></td>
            </tr>
        </table>
        <a href="/cabinet" class="hvr-shutter-in-horizontal cabinet-btn">Назад</a>
    </div>
    <div class="clearfix"></div>
</div>