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
    <h1>Cancel Vaccination Appointment</h1>
    <form action="/VaccinationCenter/appointment/cancelSubmit" method="post">
        <div class="input">
            <label for="centerId">Vaccination Center Id</label>
            <input type="number" name="centerId" id="centerId" value="<?= old('centerId') ? old('centerId') : $vaccinationAppointment->getCenterId()?>"><br />
        </div>

        <div class="input">
            <label for="appointmentId">Vaccination Appointment Id</label>
            <input type="number" name="appointmentId" id="appointmentId" value="<?= old('appointmentId') ? old('appointmentId') : $vaccinationAppointment->getAppointmentId() ?>"><br />
        </div>

        <div class="input">
            <label for="date">Vaccination Appointment Date</label>
            <input type="text" name="date" id="date" value="<?= old('date') ? old('date') : $vaccinationAppointment->getDate() ?>"><br />
        </div>

        <div class="input">
            <label for="phn">Personal Health Number</label>
            <input type="number" name="phn" id="phn" value="<?= old('phn') ? old('phn') : $vaccinationAppointment->getReceiverPhn() ?>"><br />
        </div>

        <?php if (isset($error)) { ?>
            <p class="error">Error: <?= $error ?></p>
        <?php } ?>

        <input type="submit" value="Cancel Vaccination Appointment">
    </form>
</body>

</html>