<?php
$customers = $data['customers'];
$transaction = $data['transaction'];
?>
<script>
    $(document).ready(function() {
        $('.money').mask("###0.00", {
            reverse: true
        });
        $('.datetime').mask("00/00/0000 00:00:00", {
            placeholder: "__/__/____ __:__:__",
        });
    });
</script>
<div class="row">
    <div class="col-md-12">
        <div class="col-md-8 offset-md-2">
            <?php if (isset($data['errors'])) {
                echo '<div class="alert alert-danger" role="alert">';
                echo '<ul>';
                foreach ($data['errors'] as $error) {
                    echo '<li>' . $error . '</li>';
                }
                echo '</ul>';
                echo '</div>';
            }
            ?>
            <!-- form new category -->
            <div class="card card-outline-secondary">
                <div class="card-header">
                    <h3 class="mb-0">Edit Transaction #<?= $transaction->getId(); ?></h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="post" action="index.php?transaction=update">
                        <div class="align-middle">
                            <div class="align-middle">
                                <div class="form-group align-middle">
                                    <label class="control-label col-sm-4" for="customer">Customer:</label>
                                    <div class="col-sm-4">
                                        <input type="hidden" name="id" value="<?= $transaction->getId(); ?>">
                                        <select name="customer" id="customer" class="form-control">
                                            <option value="">Select Customer</option>
                                            <?php foreach ($customers as $customer) : ?>
                                                <option <?= ($transaction->getCustomerId() == $customer->getId()) ? 'selected' : '';?> value="<?php echo $customer->getId(); ?>"><?php echo $customer->getFullName(); ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="datetime">Date and Time:</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control datetime" id="datetime" placeholder="Date and Time" value="<?= date('d/m/Y h:i:s', strtotime($transaction->getTransactionDate()));?>" name="datetime">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="amount">Amount:</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control money" id="amount" placeholder="Amount" value="<?= $transaction->getPurchaseAmount()?>" name="amount">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary btn-form">Save</button>
                                        <a href="index.php?product=index"><button type="button" class="btn btn-danger btn-form">Cancel</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>