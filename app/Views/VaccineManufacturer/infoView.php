<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CPSC 304 | Vaccination Center</title>
    <style>
        .attr {
            font-size: 1.5rem;
        }
        .error {
            color: red;
            margin-bottom: 1rem;
            font-weight: bold;
            font-size: 1.5rem;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 0.5rem;
        }
    </style>
</head>

<body>

    <?php if (isset($error)) { ?>
        <p class="error">Error: <?= $error ?></p>
    <?php } else { ?>
        <span style="font-size: 3rem"><b>Manufacturer Name:</b> <?= $manufacturerName ?></span></br>
        <div class="attr"><b>Production Volume:</b> <?= $vaccineManufacturer->getProductionVolume() ?></div>
        <div class="attr"><b>Production Rate:</b> <?= $vaccineManufacturer->getProductionRate() ?></div>

        <form action="/VaccineManufacturer/<?= $manufacturerName ?>/addVaccine">
            <input type="submit" value="Add Vaccine" style="margin-top: 1.5rem; padding: 1rem" />
        </form>
        <form action="/VaccineManufacturer/<?= $manufacturerName ?>/edit">
            <input type="submit" value="Edit Vaccine Manufacturer" style="margin-top: 1.5rem; padding: 1rem" />
        </form>
        <form action="/VaccineManufacturer/delete" method="post">
            <input type="hidden" name="manufacturerName" value="<?= $manufacturerName ?>">

            <input type="submit" value="Delete Vaccine Manufacturer" style="margin-top: 1.5rem; padding: 1rem" />
        </form>

        <?php if (isset($vaccines)) { ?>
            <div style="margin-top: 1.5rem">
                <span style="font-size: 3rem"><b>Vaccines</b></span></br>
                <table style="font-size: 1.5rem">
                    <tr>
                        <th>Name</th>
                        <th>Vaccine Type</th>
                    </tr>
                    <?php foreach ($vaccines as $vaccine) { ?>
                        <tr>
                            <td><a href="/Vaccine/<?= $vaccine['name'] ?>"><?= $vaccine['name'] ?></a></td>
                            <td><?= $vaccine['vaccine_type'] ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        <?php } ?>

        <?php if (isset($orders)) { ?>
            <div style="margin-top: 1.5rem">
                <span style="font-size: 3rem"><b>Orders</b></span></br>
                <table style="font-size: 1.5rem">
                    <tr>
                        <th>Order ID</th>
                        <th>Center ID</th>
                        <th>Order Amount</th>
                        <th>Order Date</th>
                        <th>Vaccine Name</th>
                    </tr>
                    <?php foreach ($orders as $order) { ?>
                        <tr>
                            <td><a href="/VaccineOrder/<?= $order->manufacturer_name ?>/<?= $order->order_id ?>"><?= $order->order_id ?></a></td>
                            <td><a href="/VaccinationCenter/<?= $order->center_id ?>"><?= $order->center_id ?></a></td>
                            <td><?= $order->order_amount ?></td>
                            <td><?= $order->order_date ?></td>
                            <td><a href="/Vaccine/<?= $vaccine['name'] ?>"><?= $order->vaccine_name ?></a></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        <?php } ?>
    <?php } ?>
</body>

</html>