<script>
    $(document).ready(function() {
        $(".delete").click(function() {
            if (window.confirm("Confirm?")) {
                window.location = "index.php?transaction=destroy&id=" + this.dataset.value;
            }
        });
    });
</script>

<div class="container">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Manage Transactions</h2>
                </div>
                <div class="col-sm-6">
                    <a href="index.php?transaction=create" class="btn btn-success"><i class="material-icons">&#xE147;</i> <span>Add New Transaction</span></a>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date/Time</th>
                    <th>Customer</th>
                    <th>Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $transactions = $data['transactions']; ?>
                <?php foreach ($transactions as $transaction) : ?>
                    <tr>
                        <td><?= $transaction->getId(); ?></td>
                        <td><?= date('d/m/Y H:i:s', strtotime($transaction->getTransactionDate())); ?></td>
                        <td><a href="index.php?customer=edit&id=<?php echo $transaction->getCustomerId(); ?>"><?= $transaction->getCustomer()->getFullName(); ?></a></td>
                        <td>$ <?= $transaction->getPurchaseAmount(); ?></td>
                        <td>
                            <a href="index.php?transaction=edit&id=<?= $transaction->getId(); ?>" class="edit"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a href="#" class="delete" data-value="<?= $transaction->getId() ?>"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>