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

        .phn {
            margin-bottom: 1rem;
            font-size: 3rem;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php if (isset($error)) { ?>
        <p class="error">Error: <?= $error ?></p>
    <?php } ?>

    <?php if (isset($vaccineReceiver)) { ?>
        <div class="phn">PHN: <?= $vaccineReceiver->getPHN() ?></div>
        <div class="attr"><b>Name:</b> <?= $vaccineReceiver->getName() ?></div>
        <div class="attr"><b>Email:</b> <?= $vaccineReceiver->getEmail() ?></div>
        <div class="attr"><b>Phone Number:</b> <?= $vaccineReceiver->getPhoneNumber() ?></div>
        <div class="attr"><b>Date of Birth:</b> <?= $vaccineReceiver->getDateOfBirth() ?></div>
        <div class="attr"><b>Postal Code:</b> <?= $vaccineReceiver->getPostalCode() ?></div>
        <form action="/VaccineReceiver/<?= $vaccineReceiver->getPHN() ?>/edit">
            <input type="submit" value="Edit Vaccine Receiver" style="margin-top: 1.5rem; padding: 1rem" />
        </form>
    <?php } ?>
</body>

</html>