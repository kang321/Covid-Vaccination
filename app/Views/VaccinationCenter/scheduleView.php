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
    <h1>Schedule an appointment</h1>
    <form action="/VaccinationCenter/scheduleSubmit" method="post">
        <div class="input">
            <label for="phn">PHN</label>
            <input type="number" name="phn" id="phn" value="<?= old('phn') ?>"><br />
        </div>

        <div class="input">
            <label for="date">Date</label>
            <input type="datetime-local" name="date" id="date" value="<?= old('date') ?>"><br />
        </div>

        <input type="hidden" name="centerId" id="centerId" value="<?= $centerId ?>">

        <?php if (isset($error)) { ?>
            <p class="error">Error: <?= $error ?></p>
        <?php } ?>

        <input type="submit" value="Schedule">
    </form>

</body>

</html>