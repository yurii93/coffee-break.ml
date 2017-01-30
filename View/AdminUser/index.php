<div class="container">
<?php if(isset($data['warning'])) :?>
    <div class="col-sm-4 col-sm-offset-4 alert alert-danger info-box" role="alert"><?php echo $data['warning']; ?></div>
<?php endif; ?>
<?php if(isset($data['success'])) :?>
    <div class="col-sm-4 col-sm-offset-4 alert alert-success info-box" role="alert"><?php echo $data['success']; ?></div>
<?php endif; ?>
<div class="clearfix"></div>
<div class="title-to-center">
    <h2>Пользователи</h2>
</div>
<?php if($data['users']): ?>
<table class="table table-bordered">
    <tr class="active">
        <th>Id</th>
        <th>Имя</th>
        <th>Фамилия</th>
        <th>Телефон</th>
        <th>Email</th>
        <th>Удалить</th>
    </tr>
    <?php foreach ($data['users'] as $user): ?>
    <tr>
        <td><?php echo $user['id']; ?></td>
        <td><?php echo $user['name']; ?></td>
        <td><?php echo $user['surname']; ?></td>
        <td><?php echo $user['tel']; ?></td>
        <td><?php echo $user['email']; ?></td>
        <td><a href="/adminUser/deleteUser/<?php echo $user['id']; ?>" data-toggle="tooltip" title="Удалить" onclick="return confirmDelete();"><i class="fa fa-times fa-lg"></i></a></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php else: ?>
    <div class="title-to-center">
        <h3>Нет ни одного пользователя</h3>
    </div>
<?php endif; ?>
</div>