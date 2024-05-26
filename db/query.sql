
-- Creating department table
CREATE TABLE IF NOT EXISTS department (
    id int(11) NOT NULL AUTO_INCREMENT,
    deptName VARCHAR(50) NOT NULL,
    PRIMARY KEY(id)
);

-- Creating employees table
CREATE TABLE IF NOT EXISTS employees (
    id int(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    address VARCHAR(50) NOT NULL,
    designation VARCHAR(50) NOT NULL,
    deptID INT(11) NOT NULL,
    FOREIGN KEY(deptID) REFERENCES department(id) ON DELETE CASCADE,
    PRIMARY KEY(id)
);

-- Note: Value of the designation is manually typed
-------- (because this is a mini-mini project)