-- USERS TABLE
CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100),
    email VARCHAR(100),
    phone VARCHAR(15)
);

-- VEHICLES TABLE
CREATE TABLE vehicles (
    vehicle_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    model VARCHAR(100),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- SERVICES TABLE
CREATE TABLE services (
    service_id INT PRIMARY KEY AUTO_INCREMENT,
    service_name VARCHAR(100),
    cost INT
);

-- MECHANICS TABLE
CREATE TABLE mechanics (
    mechanic_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100)
);

-- SERVICE REQUESTS
CREATE TABLE service_requests (
    request_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    vehicle_id INT,
    service_id INT,
    mechanic_id INT,
    request_date DATE,
    status VARCHAR(50),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (vehicle_id) REFERENCES vehicles(vehicle_id),
    FOREIGN KEY (service_id) REFERENCES services(service_id),
    FOREIGN KEY (mechanic_id) REFERENCES mechanics(mechanic_id)
);

-- PAYMENTS
CREATE TABLE payments (
    payment_id INT PRIMARY KEY AUTO_INCREMENT,
    request_id INT,
    amount INT,
    payment_date DATE,
    FOREIGN KEY (request_id) REFERENCES service_requests(request_id)
);

-- SAMPLE QUERY (JOIN)
SELECT u.name, v.model, s.service_name, r.status
FROM service_requests r
JOIN users u ON r.user_id = u.user_id
JOIN vehicles v ON r.vehicle_id = v.vehicle_id
JOIN services s ON r.service_id = s.service_id;

-- AGGREGATE QUERY
SELECT SUM(amount) AS total_revenue FROM payments;
