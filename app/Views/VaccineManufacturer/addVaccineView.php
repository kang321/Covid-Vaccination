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
    <h1>Adding a vaccine to <?= $manufacturerName ?></h1>
    <form action="/VaccineManufacturer/addVaccineSubmit" method="post">
        <div class="input">
            <label for="vaccineName">Vaccine Name</label>
            <input type="text" name="vaccineName" id="vaccineName" value="<?= old('vaccineName') ?>"><br />
        </div>

        <div class="input">
            <label for="vaccineType">Vaccine Type</label>
            <input type="text" name="vaccineType" id="vaccineType" value="<?= old('vaccineType') ?>"><br />
        </div>

        <div class="input">
            <label for="numberOfShots">Number of Shots</label>
            <input type="number" name="numberOfShots" id="numberOfShots" value="<?= old('numberOfShots') ?>"><br />
        </div>

        <div class="input">
            <label for="cooldownDays">Number of Cooldown Days</label>
            <input type="number" name="cooldownDays" id="cooldownDays" value="<?= old('cooldownDays') ?>"><br />
        </div>

        <input type="hidden" name="manufacturerName" id="manufacturerName" value="<?= $manufacturerName ?>">


        <?php if (isset($error)) { ?>
            <p class="error">Error: <?= $error ?></p>
        <?php } ?>

        <input type="submit" value="Add Vaccine">
    </form>
</body>

</html>