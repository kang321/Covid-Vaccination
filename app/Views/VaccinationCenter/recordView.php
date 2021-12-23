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

        .input {
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <h1>Enter a Vaccination Record</h1>
    <form action="/VaccinationCenter/recordSubmit" method="post">
        <div class="input">
            <label for="healthWorkerPHN">Health Worker PHN</label>
            <input type="number" name="healthWorkerPHN" id="healthWorkerPHN" value="<?= old('healthWorkerPHN') ?>"><br />
        </div>

        <div class="input">
            <label for="vaccineName">Vaccine Name</label>
            <input type="text" name="vaccineName" id="vaccineName" value="<?= old('vaccineName') ?>"><br />
        </div>

        <div class="input">
            <label for="shotTime">Shot Time</label>
            <input type="datetime-local" name="shotTime" id="shotTime" value="<?= old('shotTime') ?>"><br />
        </div>

        <input type="hidden" name="centerId" id="centerId" value="<?= $centerId ?>">
        <input type="hidden" name="appointmentId" id="appointmentId" value="<?= $appointmentId ?>">

        <?php if (isset($error)) { ?>
            <p class="error">Error: <?= $error ?></p>
        <?php } ?>

        <input type="submit" value="Submit">
    </form>

</body>

</html>