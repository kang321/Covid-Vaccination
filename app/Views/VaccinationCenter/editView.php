<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CPSC 304 | Vaccination Center</title>
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
    <h1>Edit vaccination center</h1>
    <form action="/VaccinationCenter/editSubmit" method="post">
        <div class="input">
            <label for="-">Vaccination Center Id</label>
            <input disabled type="number" name="-" id="-" value="<?= $vaccinationCenter->getCenterId() ?>"><br />
        </div>

        <div class="input">
            <label for="centerName">Vaccination Center Name</label>
            <input type="text" name="centerName" id="centerName" value="<?= old('centerName') ? old('centerName') : $vaccinationCenter->getName() ?>"><br />
        </div>

        <div class="input">
            <label for="centerAddress">Vaccination Center Address</label>
            <input type="text" name="centerAddress" id="centerAddress" value="<?= old('centerAddress') ? old('centerAddress') : $vaccinationCenter->getAddress() ?>"><br />
        </div>

        <div class="input">
            <label for="postalCode">Vaccination Center Postal Code</label>
            <input type="text" name="postalCode" id="postalCode" value="<?= old('postalCode') ? old('postalCode') : $vaccinationCenter->getPostalCode() ?>"><br />
        </div>

        <div class="input">
            <label for="centerState">Vaccination Center State</label>
            <input type="text" name="centerState" id="centerState" value="<?= old('centerState') ? old('centerState') : $vaccinationCenter->getState() ?>"><br />
        </div>

        <input type="hidden" name="centerId" id="centerId" value="<?= $vaccinationCenter->getCenterId() ?>">

        <?php if (isset($error)) { ?>
            <p class="error">Error: <?= $error ?></p>
        <?php } ?>

        <input type="submit" value="Edit Vaccination Center">
    </form>
</body>

</html>