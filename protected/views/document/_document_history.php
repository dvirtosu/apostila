<div style="padding:10px 20px;">
    <?php if ( ! $dataArray): ?>
        no history
    <?php else: ?>
        <table class="history-table">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Actiune</th>
                    <th>Utilizator</th>
                    <th>Numarul versiunii</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($dataArray as $data): ?>
                    <tr>
                        <td><?php echo CHtml::encode($data->DataTime); ?></td>
                        <td><?php echo CHtml::encode(DocumentAction::model()->findByPk($data->Action_id)->Description); ?></td>
                        <td><?php echo CHtml::encode(User::model()->findByPk($data->User_id)->username); ?></td>
                        <td><?php echo CHtml::encode($data->Doc_version); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
