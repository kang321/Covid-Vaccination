CREATE TABLE VaccineManufacturer(
    manufacturer_name CHAR(32),
    production_volume INTEGER,
    production_rate INTEGER,
    PRIMARY KEY (manufacturer_name)
);

CREATE TABLE VaccineReceiver(
    phn BIGINT,
    name CHAR(32),
    email CHAR(40),
    phone_number BIGINT,
    date_of_birth DATE,
    postal_code CHAR(7),
    PRIMARY KEY (phn)
);

CREATE TABLE HealthWorker(
    phn BIGINT,
    name CHAR(40),
    email CHAR(40),
    PRIMARY KEY (phn)
);

CREATE TABLE Vaccine(
    name CHAR(25),
    vaccine_type CHAR(32),
    number_of_shots INTEGER,
    cooldown_days INTEGER,
    manufacturer_name CHAR(32),
    PRIMARY KEY (name),
    FOREIGN KEY (manufacturer_name) REFERENCES VaccineManufacturer(manufacturer_name) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE VaccinationCenter(
    center_id INTEGER,
    name CHAR(32),
    address CHAR(32),
    postal_code CHAR(7),
    state CHAR(32),
    PRIMARY KEY (center_id)
);

CREATE TABLE VaccineOrder(
    order_id INTEGER,
    manufacturer_name CHAR(32),
    center_id INTEGER NOT NULL,
    order_amount INTEGER,
    order_date DATETIME,
    vaccine_name CHAR(25) NOT NULL,
    PRIMARY KEY (order_id, manufacturer_name),
    FOREIGN KEY (manufacturer_name) REFERENCES VaccineManufacturer(manufacturer_name) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (center_id) REFERENCES VaccinationCenter(center_id) ON DELETE NO ACTION ON UPDATE CASCADE,
    FOREIGN KEY (vaccine_name) REFERENCES Vaccine(name) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE VaccinationAppointment(
    appointment_id INTEGER,
    center_id INTEGER,
    date DATETIME,
    current BOOLEAN,
    receiver_phn BIGINT NOT NULL,
    PRIMARY KEY (appointment_id, center_id),
    FOREIGN KEY (center_id) REFERENCES VaccinationCenter(center_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (receiver_phn) REFERENCES VaccineReceiver(phn) ON DELETE NO ACTION ON UPDATE CASCADE
);

CREATE TABLE SideEffect(
    body_part CHAR(40),
    complaint CHAR(50),
    PRIMARY KEY (body_part, complaint)
);

CREATE TABLE SideEffectHappenedToVaccineReceiver(
    receiver_phn BIGINT,
    body_part CHAR(40),
    complaint CHAR(50),
    date_of_complaint DATE,
    PRIMARY KEY (receiver_phn, body_part, complaint),
    FOREIGN KEY (receiver_phn) REFERENCES VaccineReceiver(phn) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (body_part, complaint) REFERENCES SideEffect(body_part, complaint) ON  DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE VaccineHasSideEffect(
	vaccine_name CHAR(25),
    body_part CHAR(40),
    complaint CHAR(50),
    PRIMARY KEY (vaccine_name, body_part, complaint),
    FOREIGN KEY (vaccine_name) REFERENCES Vaccine(name) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (body_part, complaint) REFERENCES SideEffect(body_part, complaint) ON  DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE VaccineRecieverGetsShotVaccine(
    receiver_phn BIGINT NOT NULL,
    vaccine_name CHAR(50) NOT NULL,
    shot_time DATETIME,
    healthWorker_phn BIGINT NOT NULL,
    appointment_id INTEGER,
    center_id INTEGER,
    PRIMARY KEY (appointment_id, center_id),
    FOREIGN KEY (receiver_phn) REFERENCES VaccineReceiver(phn) ON DELETE NO ACTION ON UPDATE CASCADE,
    FOREIGN KEY (vaccine_name) REFERENCES Vaccine(name) ON DELETE NO ACTION ON UPDATE CASCADE,
    FOREIGN KEY (appointment_id, center_id) REFERENCES VaccinationAppointment(appointment_id, center_id) ON DELETE NO ACTION ON UPDATE NO ACTION,
    FOREIGN KEY (healthWorker_phn) REFERENCES HealthWorker(phn) ON DELETE NO ACTION ON UPDATE CASCADE,
    UNIQUE(appointment_id, center_id)
);

CREATE TABLE VaccinationCenterInventoriesVaccine(
	center_id INTEGER,
    vaccine_name CHAR(25),
    amount INTEGER,
    PRIMARY KEY (center_id, vaccine_name),
    FOREIGN KEY (center_id) REFERENCES VaccinationCenter(center_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (vaccine_name) REFERENCES Vaccine(name) ON DELETE NO ACTION ON UPDATE CASCADE
);
