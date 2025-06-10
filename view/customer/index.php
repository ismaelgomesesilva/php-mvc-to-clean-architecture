<script>
    $(document).ready(function() {
        $(".delete").click(function() {
            if (window.confirm("Confirm?")) {
                window.location = "index.php?customer=destroy&id=" + this.dataset.value;
            }
        });
    });
</script>

<div class="container">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Manage Customers</h2>
                </div>
                <div class="col-sm-6">
                    <a href="#filters" data-toggle="collapse" class="btn btn-secondary"><i class="material-icons">&#xEf4F;</i> <span>Filters</span></a>
                    <a href="index.php?customer=create" class="btn btn-success"><i class="material-icons">&#xE147;</i> <span>Add New Customer</span></a>
                </div>
            </div>
        </div>
        <div class="filters mb-3">
            <div class="row">
                <div class="col-12">
                    <div id="filters" class="collapse <?= (isset($_GET['filter'])) ? 'show' : '';?>">
                        <div class="card">
                            <div class="card-body">
                                <form action="index.php">
                                    <input type="hidden" name="customer" value="index">
                                    <div class="row">
                                        <div class="col-2">
                                            <h5 class="card-title">Filters</h5>
                                        </div>
                                        <div class="col-8">
                                            <div class="form-group">
                                                <label for="customer">Customer Filters</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="filter" value="all" <?= (isset($_GET['filter']) && $_GET['filter'] == 'all') ? 'checked' : '';?> >
                                                    <label class="form-check-label">
                                                        No filter
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="filter" value="transaction_only" <?= (isset($_GET['filter']) && $_GET['filter'] == 'transaction_only') ? 'checked' : '';?> >
                                                    <label class="form-check-label">
                                                        Only customers with transactions
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="filter" value="top10" <?= (isset($_GET['filter']) && $_GET['filter'] == 'top10') ? 'checked' : '';?> >
                                                    <label class="form-check-label">
                                                        Top 10 customers by total purchase amount
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <button type="submit" class="btn btn-sm btn-success">Apply</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Total Purchase Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $customers = $data['customers']; ?>
                <?php foreach ($customers as $customer) : ?>
                    <tr>
                        <td><?= $customer->getId(); ?></td>
                        <td><?= $customer->getFullName(); ?></td>
                        <td><?= $customer->getEmail(); ?></td>
                        <td>$ <?= $customer->getTotalPurchaseAmount(); ?></td>
                        <td>
                            <a href="index.php?customer=edit&id=<?= $customer->getId(); ?>" class="edit"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a href="#" class="delete" data-value="<?= $customer->getId() ?>"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>