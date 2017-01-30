<div class="container">
<?php if(isset($data['warning'])) :?>
    <div class="col-sm-4 col-sm-offset-4 alert alert-danger info-box" role="alert"><?php echo $data['warning']; ?></div>
<?php endif; ?>
<?php if(isset($data['success'])) :?>
    <div class="col-sm-4 col-sm-offset-4 alert alert-success info-box" role="alert"><?php echo $data['success']; ?></div>
<?php endif; ?>
<div class="clearfix"></div>
<div class="title-to-center">
    <h2>Сообщения</h2>
</div>
<?php if($data['messages']): ?>
    <table class="table table-bordered">
        <tr class="active">
            <th>Id</th>
            <th>Имя</th>
            <th>Email</th>
            <th>Сообщение</th>
            <th>Дата</th>
            <th>Удалить</th>
        </tr>
        <?php foreach ($data['messages'] as $message): ?>
            <tr>
                <td><?php echo $message['id']; ?></td>
                <td><?php echo $message['name']; ?></td>
                <td><?php echo $message['email']; ?></td>
                <td><?php echo $message['message']; ?></td>
                <td><?php echo $message['date']; ?></td>
                <td><a href="/adminMessage/deleteMessage/<?php echo $message['id']; ?>" data-toggle="tooltip" title="Удалить" onclick="return confirmDelete();"><i class="fa fa-times fa-lg"></i></a></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <div class="title-to-center">
        <h3>Нет ни одного сообщения</h3>
    </div>
<?php endif; ?>
</div>
