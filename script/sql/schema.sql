-- CREATE USER 'newuser'@'localhost' IDENTIFIED BY 'password';
CREATE USER IF NOT EXISTS gatechUser@localhost IDENTIFIED BY 'gatech123';

DROP DATABASE IF EXISTS `tools4rent`;
SET default_storage_engine=InnoDB;
SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE DATABASE IF NOT EXISTS tools4rent
    DEFAULT CHARACTER SET utf8mb4
    DEFAULT COLLATE utf8mb4_unicode_ci;
USE tools4rent;

GRANT SELECT, INSERT, UPDATE, DELETE, FILE ON *.* TO 'gatechUser'@'localhost';
GRANT ALL PRIVILEGES ON `gatechuser`.* TO 'gatechUser'@'localhost';
GRANT ALL PRIVILEGES ON `cs6400_fa17_team003`.* TO 'gatechUser'@'localhost';
FLUSH PRIVILEGES;

CREATE TABLE Clerk(
	Email VARCHAR(50) NOT NULL,
	ClerkID INT(10) AUTO_INCREMENT,
	Username VARCHAR(50) NOT NULL,
	Password VARCHAR(50) NOT NULL,
	FirstName VARCHAR(50) NOT NULL,
	MiddleName VARCHAR(50),
	LastName VARCHAR(50) NOT NULL,
	DateOfHire DATE NOT NULL,
	PRIMARY KEY (Email),
	UNIQUE KEY(ClerkID)
);

CREATE TABLE Phone(
  Email VARCHAR(50) NOT NULL,
  PhoneType VARCHAR(10) NOT NULL,
  AreaCode VARCHAR(10) NOT NULL,
  MainNumber VARCHAR(30) NOT NULL,
  Extension VARCHAR(10) NOT NULL,
  UNIQUE KEY (Email, AreaCode, MainNumber, Extension)
);

CREATE TABLE Customer(
	Email VARCHAR(50) NOT NULL,
    CustomerID INT(10) AUTO_INCREMENT,
    Username VARCHAR(50) NOT NULL,
	Password VARCHAR(50) NOT NULL,
	FirstName VARCHAR(50) NOT NULL,
	MiddleName VARCHAR(50),
	LastName VARCHAR(50) NOT NULL,
	Street VARCHAR(100) NOT NULL,
	City VARCHAR(50) NOT NULL,
	ZipCode VARCHAR(10) NOT NULL,
	State VARCHAR(10) NOT NULL,
    AreaCode VARCHAR(10) NOT NULL,
    MainNumber VARCHAR(30) NOT NULL,
    Extension VARCHAR(10) NOT NULL,
	CreditCardNumber VARCHAR(16) NOT NULL ,
	NameOnCreditCard VARCHAR(50) NOT NULL,
	CVC				VARCHAR(4)	NOT NULL,
	ExpirationMonth	VARCHAR(2)	NOT NULL,
	ExpirationYear	VARCHAR(4)	NOT NULL,
	PRIMARY KEY (Email),
    UNIQUE KEY(CustomerID),
	UNIQUE KEY(Username),
    FOREIGN KEY (Email, AreaCode, MainNumber, Extension) REFERENCES Phone (Email, AreaCode, MainNumber, Extension)
);

CREATE TABLE Tools(
	ToolID INT(10) AUTO_INCREMENT,
	Type VARCHAR(15) NOT NULL,
    SubType VARCHAR(20) NOT NULL,
	SubOption VARCHAR(20) NOT NULL,
	PowerSource VARCHAR(20) NOT NULL,
	Manufacturer VARCHAR(20) NOT NULL,
	Material VARCHAR(20),
	PurchasePrice FLOAT(10,2) NOT NULL,
	Weight FLOAT(10,2) NOT NULL,
	LengthInt INT(5) NOT NULL,
	LengthFraction VARCHAR(5) NOT NULL,
	LengthUnit VARCHAR(5) NOT NULL,
	Width_Diameter_Int INT(5) NOT NULL,
	Width_Diameter_Fraction VARCHAR(5) NOT NULL,
	Width_Diameter_Unit VARCHAR(5) NOT NULL,
    PRIMARY KEY (ToolID)
);

CREATE TABLE Reservation(
  Email VARCHAR(50) NOT NULL,
  PickUp_ClerkID  INT(10) ,
  DropOff_ClerkID INT(10) ,
  ReservationID INT(10) AUTO_INCREMENT,
  StartDate DATE NOT NULL,
  EndDate DATE NOT NULL,
  PRIMARY KEY (ReservationID),
  FOREIGN KEY (Email) REFERENCES Customer(Email),
  FOREIGN KEY (PickUp_ClerkID) REFERENCES Clerk(ClerkID),
  FOREIGN KEY (DropOff_ClerkID) REFERENCES Clerk(ClerkID)
);

CREATE TABLE Been(
	ToolID INT(10) NOT NULL,
	ReservationID INT(10) NOT NULL,
    PRIMARY KEY (ToolID, ReservationID),
    FOREIGN KEY (ToolID) REFERENCES Tools(ToolID),
    FOREIGN KEY (ReservationID) REFERENCES Reservation(ReservationID)
);

CREATE TABLE HandTools(
	ToolID INT(10) NOT NULL,
    FOREIGN KEY (ToolID) REFERENCES Tools(ToolID)
);

CREATE TABLE Screwdriver(
	ToolID INT(10) NOT NULL,
	ScrewSize INT(5) NOT NULL,
    FOREIGN KEY (ToolID) REFERENCES Tools(ToolID)
);

CREATE TABLE Socket(
	ToolID INT(10) NOT NULL,
	DriveSize FLOAT(5,2) NOT NULL,
	SaeSize FLOAT(5,2) NOT NULL,
    DeepSocket BOOLEAN,
    FOREIGN KEY(ToolID) REFERENCES Tools(ToolID)
);

CREATE TABLE Ratchet(
	ToolID INT(10) NOT NULL,
	DriveSize FLOAT(5,2) NOT NULL,
    FOREIGN KEY(ToolID) REFERENCES Tools(ToolID)
);

CREATE TABLE Plier(
	ToolID INT(10) NOT NULL,
	Adjustable BOOLEAN,
    FOREIGN KEY(ToolID) REFERENCES Tools(ToolID)
);

CREATE TABLE Gun(
	ToolID INT(10) NOT NULL,
	GaugeRating INT(3) NOT NULL,
	Capacity INT(10) NOT NULL,
    FOREIGN KEY(ToolID) REFERENCES Tools(ToolID)
);

CREATE TABLE Hammer(
	ToolID INT(10) NOT NULL,
	AntiVibration BOOLEAN,
    FOREIGN KEY(ToolID) REFERENCES Tools(ToolID)
);

CREATE TABLE LadderTools(
	ToolID INT(10) NOT NULL,
	WeightCapacity FLOAT(10,2),
	StepCount INT(5),
    FOREIGN KEY(ToolID) REFERENCES Tools(ToolID)
);

CREATE TABLE Straight(
	ToolID INT(10) NOT NULL,
	RubberFeet BOOLEAN,
    FOREIGN KEY(ToolID) REFERENCES Tools(ToolID)
);


CREATE TABLE Step(
	ToolID INT(10) NOT NULL,
	PailShelf	BOOLEAN,
    FOREIGN KEY(ToolID) REFERENCES Tools(ToolID)
);

CREATE TABLE GardenTools(
	ToolID INT(10) NOT NULL,
    HandleMaterial VARCHAR(50) NOT NULL,
    FOREIGN KEY(ToolID) REFERENCES Tools(ToolID)
);

CREATE TABLE PruningTools(
   ToolID INT(10) NOT NULL,
   BladeMaterial VARCHAR(50),
   BladeLength FLOAT(5,2) NOT NULL,
   FOREIGN KEY(ToolID) REFERENCES Tools(ToolID)
);

CREATE TABLE StrikingTools(
	ToolID INT(10) NOT NULL,
	HeadWeight FLOAT(5,2) NOT NULL,
    FOREIGN KEY(ToolID) REFERENCES Tools(ToolID)
);

CREATE TABLE DiggingTools(
	ToolID INT(10) NOT NULL,
	BladeWidth FLOAT(5,2),
	BladeLength FLOAT(5,2) NOT NULL,
    FOREIGN KEY(ToolID) REFERENCES Tools(ToolID)
);

CREATE TABLE RakeTools(
	ToolID INT(10) NOT NULL,
	TineCount INT(5) NOT NULL,
    FOREIGN KEY(ToolID) REFERENCES Tools(ToolID)
);

CREATE TABLE WheelbarrowTools(
	ToolID INT(10) NOT NULL,
	BinMaterial VARCHAR(50) NOT NULL,
	BinVolume FLOAT(5,2),
	WheelCount INT(5) NOT NULL,
    FOREIGN KEY(ToolID) REFERENCES Tools(ToolID)
);

CREATE TABLE PowerTools(
	ToolID INT(10) NOT NULL,
	VoltRating FLOAT(5,2) NOT NULL,
	AmpRating FLOAT(5,2) NOT NULL,
	RPMRatingMin FLOAT(10,2) NOT NULL,
	RPMRatingMax FLOAT(10,2),
    FOREIGN KEY(ToolID) REFERENCES Tools(ToolID)
);

CREATE TABLE Generator(
	ToolID INT(10) NOT NULL,
	PowerGenerated FLOAT(10,2) NOT NULL,
    FOREIGN KEY(ToolID) REFERENCES Tools(ToolID)
);

CREATE TABLE Drill(
	ToolID INT(10) NOT NULL,
	TorqueRatingMin FLOAT(10,2) NOT NULL,
	TorqueRatingMax FLOAT(10,2),
    AdjustableClutch BOOLEAN,
    FOREIGN KEY(ToolID) REFERENCES Tools(ToolID)
);

CREATE TABLE Saw(
	ToolID INT(10) NOT NULL,
	BladeSize FLOAT(5,2) NOT NULL,
    FOREIGN KEY(ToolID) REFERENCES Tools(ToolID)
);

CREATE TABLE Sander(
	ToolID INT(10) NOT NULL,
	Dustbag BOOLEAN,
    FOREIGN KEY(ToolID) REFERENCES Tools(ToolID)
);

CREATE TABLE AirCompressor(
	ToolID INT(10)  NOT NULL,
	PressureRatingMin FLOAT(10,2),
	PressureRatingMax FLOAT(10,2),
	TankSize FLOAT(10,2) NOT NULL,
    FOREIGN KEY(ToolID) REFERENCES Tools(ToolID)
);

CREATE TABLE Mixer(
	ToolID INT(10)  NOT NULL,
	MotorRating FLOAT(5,2) NOT NULL,
	DrumSize FLOAT(5,2),
    FOREIGN KEY(ToolID) REFERENCES Tools(ToolID)
);

CREATE TABLE Accessories(
	ToolID INT(10)  NOT NULL,
    AccessoryID INT(10) AUTO_INCREMENT,
    AccessoryDescription VARCHAR(100) NOT NULL,
    Quantity INT(3) NOT NULL,
    BatteryType VARCHAR(20),
    VoltRating FLOAT(5,2),
    BatteryQuantity INT(3),
    UNIQUE KEY (AccessoryID),
    FOREIGN KEY(ToolID) REFERENCES Tools(ToolID)
);

CREATE TABLE Contain(
	ToolID INT(10) NOT NULL,
    AccessoryID INT(10) NOT NULL,
    PRIMARY KEY (ToolID, AccessoryID),
    FOREIGN KEY(ToolID) REFERENCES Tools(ToolID),
    FOREIGN KEY (AccessoryID) REFERENCES Tools(ToolID)
);
