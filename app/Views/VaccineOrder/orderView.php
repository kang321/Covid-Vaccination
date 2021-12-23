<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CPSC 304 | Vaccination Portal</title>
    <style>
        .input {
            margin-bottom: 1rem;
        }

        .error {
            color: red;
            margin-bottom: 1rem;
            font-weight: bold;
            font-size: 1.5rem;
        }
    </style>
</head>

<body>
    <h1>Vaccine Order Placement</h1>
    <form action="/VaccineOrder/orderSubmit" method="post">
        <div class="input">
            <label for="order_id">order_id</label>
            <input type="number" name="order_id" id="order_id" value="<?= old('order_id') ?>"><br />
        </div>

        <div class="input">
            <label for="manufacturername">manufacturername</label>
            <input type="text" name="manufacturername" id="manufacturername" value="<?= old('manufacturername') ?>"><br />
        </div>

        <div class="input">
            <label for="center_id">center_id</label>
            <input type="number" name="center_id" id="center_id" value="<?= old('center_id') ?>"><br />
        </div>

        <div class="input">
            <label for="order_amount">order_amount</label>
            <input type="number" name="order_amount" id="order_amount" value="<?= old('order_amount') ?>"><br />
        </div>

        <div class="input">
            <label for="">order_date</label>
            <input type="datetime-local" name="order_date" id="order_date" value="<?= old('order_date') ?>"><br />
        </div>

        <div class="input">
            <label for="vaccine_name">vaccine_name</label>
            <input type="text" name="vaccine_name" id="vaccine_name" value="<?= old('vaccine_name') ?>"><br />
        </div>



        <?php if (isset($error)) { ?>
            <p class="error">Error: <?= $error ?></p>
        <?php } ?>

        <input type="submit" value="Place vaccine order">
    </form>
</body>

</html>