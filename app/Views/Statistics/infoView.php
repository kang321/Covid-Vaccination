<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CPSC 304 | Vaccination Center</title>
    <style>
        .error {
            color: red;
            margin-bottom: 1rem;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .container {
            padding: 1rem;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 0.5rem;
            font-size: 1.5rem;
        }
    </style>
</head>

<body>
    <h1>Vaccination Portal</h1>
    <h2>Get Vaccinated! :)</h2>

    <h1>Statistics</h1>

    <?php if (isset($error)) { ?>
        <p class="error">Error: <?= $error ?></p>
    <?php } ?>

    <hr />
    <div class="container">
        <h2>Vaccination Center Search by Vaccine Name</h2>
        <h5>Find Vaccination Center's that have the vaccine you are looking for!</h5>
        <form action="/" method="post">
            <label for="vaccineName">Vaccine Name:</label>
            <input type="text" name="vaccineName" id="vaccineName" value="<?= old('vaccineName') ?>">

            <input type="submit" value="Submit">
        </form>

        <?php if (isset($vaccinationCenters)) { ?>
            </br>
            <table>
                <tr>
                    <th>Center ID</th>
                    <th>Center Name</th>
                    <th>Address</th>
                    <th>Amount</th>
                </tr>
                <?php foreach ($vaccinationCenters as $vaccCenter) { ?>
                    <tr>
                        <td><?= $vaccCenter->getCenterId() ?></td>
                        <td><?= $vaccCenter->getName() ?></td>
                        <td><?= $vaccCenter->getFullAddress() ?></td>
                        <td><?= $vaccCenter->amount ?></td>
                    </tr>
                <?php } ?>
            </table>
        <?php } ?>
    </div>

    <?php if (isset($vaccineCounts)) { ?>
    <hr />
    <div class="container">
            <h2>Vaccination, Vaccine counts</h2>
            <h5>Find how many vaccinations took place for each vaccine!</h5>
            </br>
            <table>
                <tr>
                    <th>Vaccine Name</th>
                    <th>Count</th>
                </tr>
                <?php foreach ($vaccineCounts as $vaccCount) { ?>
                    <tr>
                        <td><?= $vaccCount->vaccine_name ?></td>
                        <td><?= $vaccCount->count ?></td>
                    </tr>
                <?php } ?>
            </table>
    </div>
        <?php } ?>

    <?php if (isset($orderCounts)) { ?>
    <hr />
    <div class="container">
            <h2>Largest 10 orders of last month per date</h2>
            <h5>Find out largest orders by date of last month!</h5>
            </br>
            <table>
                <tr>
                    <th>Order Date</th>
                    <th>Amount</th>
                </tr>
                <?php foreach ($orderCounts as $orderCount) { ?>
                    <tr>
                        <td><?= $orderCount->order_date ?></td>
                        <td><?= $orderCount->amount ?></td>
                    </tr>
                <?php } ?>
            </table>
    </div>
        <?php } ?>

    <?php if (isset($fullyVaccinateds)) { ?>
    <hr />
    <div class="container">
            <h2>List of Fully Vaccinated</h2>
            <h5>List of people that got fully vaccinated (depending on their vaccine)</h5>
            </br>
            <table>
                <tr>
                    <th>PHN</th>
                    <th>Vaccine</th>
                </tr>
                <?php foreach ($fullyVaccinateds as $fullyVaccinated) { ?>
                    <tr>
                        <td><?= $fullyVaccinated->receiver_phn ?></td>
                        <td><?= $fullyVaccinated->vaccine_name ?></td>
                    </tr>
                <?php } ?>
            </table>
    </div>
        <?php } ?>

    <?php if (isset($vaccCenterHasAllVaccines)) { ?>
    <hr />
    <div class="container">
            <h2>List of Vaccination Centers Containing All Vaccines</h2>
            <h5>List of centers that inventories all variaties of vaccines</h5>
            </br>
            <table>
                <tr>
                    <th>Center Id</th>
                    <th>Name</th>
                    <th>Address</th>
                </tr>
                <?php foreach ($vaccCenterHasAllVaccines as $vaccCenterHasAllVaccine) { ?>
                    <tr>
                        <td><?= $vaccCenterHasAllVaccine->getCenterId() ?></td>
                        <td><?= $vaccCenterHasAllVaccine->getName() ?></td>
                        <td><?= $vaccCenterHasAllVaccine->getFullAddress() ?></td>
                    </tr>
                <?php } ?>
            </table>
    </div>
        <?php } ?>


</body>

</html>