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

        .phn {
            margin-bottom: 1rem;
            font-size: 3rem;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="phn">PHN: <?= $vaccineReceiver->getPHN() ?></div>
    <form action="/VaccineReceiver/editSubmit" method="post">
        <div class="input">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="<?= old('name') ? old('name') : $vaccineReceiver->getName() ?>"><br />
        </div>

        <div class="input">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="<?= old('email') ? old('email') : $vaccineReceiver->getEmail() ?>"><br />
        </div>

        <div class="input">
            <label for="pn">Phone Number</label>
            <input type="number" name="pn" id="pn" value="<?= old('pn') ? old('pn') : $vaccineReceiver->getPhoneNumber() ?>"><br />
        </div>

        <div class="input">
            <label for="dob">Date of Birth</label>
            <input type="date" name="dob" id="dob" value="<?= old('dob') ? old('dob') : $vaccineReceiver->getDateOfBirth() ?>"><br />
        </div>

        <div class="input">
            <label for="postalCode">Postal Code</label>
            <input type="text" name="postalCode" id="postalCode" value="<?= old('postalCode') ? old('postalCode') : $vaccineReceiver->getPostalCode() ?>"><br />
        </div>

        <input type="hidden" name="phn" id="phn" value="<?= $vaccineReceiver->getPHN() ?>">


        <?php if (isset($error)) { ?>
            <p class="error">Error: <?= $error ?></p>
        <?php } ?>

        <input type="submit" value="Edit VaccineReceiver">
    </form>

</body>

</html>