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
    </style>
</head>

<body>

    <?php if (isset($error)) { ?>
        <p class="error">Error: <?= $error ?></p>
    <?php } else { ?>
        <span style="font-size: 3rem"><b>Center id:</b> <?= "<a href='/VaccinationCenter/{$centerId}'>" . $centerId . "</a>" ?></span></br>
        <span style="font-size: 2rem"><b>Center Name:</b> <?= $centerName ?></span></br>
        <span style="font-size: 2rem"><b>Center Address:</b> <?= $centerAddress ?></span></br>
        <span style="font-size: 3rem"><b>Appointment id:</b> <?= $appointmentId ?></span></br>
        <span style="font-size: 2rem"><b>Date:</b> <?= $vaccinationAppointment->getDate() ?></span></br>
        <span style="font-size: 2rem"><b>Appointment Status:</b> <?= $vaccinationAppointment->getCurrent() ? "Booked" : "Old Appointment" ?></span></br><span style="font-size: 2rem"><b>Receiver PHN:</b> <?= "<a href='/VaccineReceiver/{$vaccinationAppointment->getReceiverPhn()}'>" . $vaccinationAppointment->getReceiverPhn() . "</a>" ?></span>
        <form action="/VaccinationCenter/<?= $centerId ?>/appointment/<?= $appointmentId ?>/cancel">
            <input type="submit" value="Cancel Appointment" style="margin-top: 1.5rem; padding: 1rem" />
        </form>
        <?php if (isset($vaccineName)) { ?>
            <div style="margin-top: 1.5rem">
                <span style="font-size: 3rem"><b>Vaccination Record</b></span></br>
                <span style="font-size: 2rem"><b>Vaccine Name:</b> <?= "<a href='/Vaccine/{$vaccineName}'>" . $vaccineName . "</a>" ?></span></br>
                <span style="font-size: 2rem"><b>Vaccination Time:</b> <?= $vaccineShotTime ?></span></br>
                <span style="font-size: 2rem"><b>Vaccinator PHN:</b> <?= $vaccineHealthWorkerPHN ?></span></br>
            </div>
        <?php } else { ?>
            <div style="margin-top: 1.5rem">
                <a href="/VaccinationCenter/<?= $centerId ?>/appointment/<?= $appointmentId ?>/record">
                    <button style="font-size: 1.5rem; padding: 1rem;">Record a Vaccination</button>
                </a>
            </div>
        <?php } ?>
    <?php } ?>
</body>

</html>