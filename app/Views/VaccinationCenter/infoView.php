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
        <span style="font-size: 3rem"><b>Center id:</b> <?= $centerId ?></span></br>
        
        <div class="attr"><b>Name:</b> <?= $vaccinationCenter->getName() ?></div>
        <div class="attr"><b>Address:</b> <?= $vaccinationCenter->getAddress() ?></div>
        <div class="attr"><b>Postal Code:</b> <?= $vaccinationCenter->getPostalCode() ?></div>
        <div class="attr"><b>State:</b> <?= $vaccinationCenter->getState() ?></div>
        <form action="/VaccinationCenter/<?= $centerId ?>/schedule">
            <input type="submit" value="Schedule an Appointment" style="margin-top: 1.5rem; padding: 1rem" />
        </form>
        <form action="/VaccinationCenter/<?= $centerId ?>/edit">
            <input type="submit" value="Edit Vaccination Center" style="margin-top: 1.5rem; padding: 1rem" />
        </form>


        <?php if (isset($inventories)) { ?>
            <div style="margin-top: 1.5rem">
                <span style="font-size: 3rem"><b>Inventory</b></span></br>
                <table style="font-size: 1.5rem">
                    <tr>
                        <th>Vaccine Name</th>
                        <th>Amount</th>
                    </tr>
                    <?php foreach ($inventories as $inventory) { ?>
                        <tr>
                            <td><a href="/Vaccine/<?= $inventory->vaccine_name ?>"><?= $inventory->vaccine_name ?></a></td>
                            <td><?= $inventory->amount ?></td>
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
                        <th>order_id</th>
                        <th>manufacturer_name</th>
                        <th>center_id</th>
                        <th>order_amount</th>
                        <th>order_date</th>
                        <th>vaccine_name</th>

                    </tr>
                    <?php foreach ($orders as $order) { ?>
                        <tr>
                            <td><a href="/VaccineOrder/<?= $order->manufacturer_name ?>/<?= $order->order_id ?>"><?= $order->order_id ?></a></td>
                            <td><a href="/VaccineManufacturer/<?= $order->manufacturer_name ?>"><?= $order->manufacturer_name ?></a></td>
                            <td><?= $order->center_id ?></td>
                            <td><?= $order->order_amount ?></td>
                            <td><?= $order->order_date ?></td>
                            <td><a href="/Vaccine/<?= $order->vaccine_name ?>"><?= $order->vaccine_name ?></a></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        <?php } ?>

        <?php if (isset($appointments)) { ?>
            <div style="margin-top: 1.5rem">
                <span style="font-size: 3rem"><b>appointments</b></span></br>
                <table style="font-size: 1.5rem">
                    <tr>
                        <th>appointment_id</th>
                        <th>center_id</th>
                        <th>date</th>
                        <th>current</th>
                        <th>receiver_phn</th>

                    </tr>
                    <?php foreach ($appointments as $appointment) { ?>
                        <tr>
                            <td><a href="/VaccinationCenter/<?= $centerId ?>/appointment/<?= $appointment->appointment_id ?>"><?= $appointment->appointment_id ?></a></td>
                            <td><?= $appointment->center_id ?></td>
                            <td><?= $appointment->date ?></td>
                            <td><?= $appointment->current ? 'Current' : 'Past' ?></td>
                            <td><a href="/VaccineReceiver/<?= $appointment->receiver_phn ?>"><?= $appointment->receiver_phn ?></a></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        <?php } ?>
    <?php } ?>
</body>

</html>