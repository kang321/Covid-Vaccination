<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CPSC 304 | Vaccination Portal</title>
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

        .name {
            margin-bottom: 1rem;
            font-size: 3rem;
            font-weight: bold;
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
    <?php } ?>

    <?php if (isset($vaccine)) { ?>
        <div class="name">Name: <?= $vaccine['name'] ?></div>
        <div class="attr"><b>Type:</b> <?= $vaccine['vaccine_type'] ?></div>
        <div class="attr"><b>Number of Shots:</b> <?= $vaccine['number_of_shots'] ?> doses</div>
        <div class="attr"><b>Cooldown Period:</b> <?= $vaccine['cooldown_days'] ?> days</div>
        <?php if (isset($vaccine['manufacturer_name'])) { ?>
            <div class="attr"><a href="/VaccineManufacturer/<?= $vaccine['manufacturer_name'] ?>"><b>Manufacturer Name:</b> <?= $vaccine['manufacturer_name'] ?></a></div>
        <?php } ?>
        <?php if (isset($sideEffects)) { ?>
            <div style="margin-top: 1.5rem">
                <span style="font-size: 3rem"><b>Side Effects</b></span></br>
                <table style="font-size: 1.5rem">
                    <tr>
                        <th>Body Part</th>
                        <th>Complaint</th>
                    </tr>
                    <?php foreach ($sideEffects as $sideEffect) { ?>
                        <tr>
                            <td><?= $sideEffect['body_part'] ?></td>
                            <td><?= $sideEffect['complaint'] ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        <?php } ?>
    <?php } ?>
</body>

</html>