<table class="table">
    <thead>
        <tr>
            <th scope="col"> Country Code </th>
            <th scope="col"> Country Name </th>
            <th scope="col"> State </th>
            <th scope="col"> Phone</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($customers as $customer){ ?>
            <tr>
                <?php $country = $customer->getCountry()?>
                <td>+<?= $country->getCode()?></td>
                <td><?= $country->getName()?></td>
                <td><?= $customer->getPhoneState()?></td>
                <td><?= $customer->getPhone()?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<div class="pagination">
    <?php if ($page > 1) { ?>
        <button type="button" class="btn btn-light prev" data-page="<?=$page - 1?>">< Prev</button>
    <?php } ?>
    <?php if (count($customers) === \App\Models\Customer::LIMIT) { ?>
        <button type="button" class="btn btn-light next" data-page="<?=$page + 1?>">Next ></button>
    <?php } ?>
</div>
