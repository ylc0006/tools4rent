# Dummy data
INSERT INTO Clerk (Email, Username, Password, FirstName, MiddleName, LastName, DateOfHire)
VALUES ('Yan@tools4rent.com', 'Yan@tools4rent.com', '0000', 'Yan', 'm' ,'Clerk1', 20171021 ),
       ('Fred@tools4rent.com', 'Fred@tools4rent.com', '0000', 'Fred', 'm' ,'Clerk2', 20171021 ),
	   ('Anthony@tools4rent.com', 'Anthony@tools4rent.com', '0000', 'Anthony', 'm' ,'Clerk3', 20171021 ),
       ('CS6400@tools4rent.com', 'CS6400@tools4rent.com', '0000', 'CS6400', 'm' ,'Clerk4', 20171021 ),
	   ('Screw@tools4rent.com', 'Screw@tools4rent.com', '0000', 'Screw', 'm' ,'Clerk5', 20171021 );

INSERT INTO Phone (Email, PhoneType, AreaCode, MainNumber, Extension)
VALUES ('ylc0006@gmail.com', 'Home Phone', 111, 1111111, 1111),
       ('Fred@gmail.com', 'Work Phone', 222, 2222222, 2222), 
	   ('Anthony@gmail.com', 'Cell Phone', 333, 3333333, 3333),
       ('ylc0006@gmail.com', 'Work Phone', 111, 1111112, 1114),
       ('Fred@gmail.com', 'Home Phone', 123, 2222223, 2223), 
	   ('Anthony@gmail.com', 'Work Phone', 134, 3333334, 3331),
       ('ylc0006@gmail.com', 'Cell Phone', 145, 1111115, 1110),
       ('Fred@gmail.com', 'Cell Phone',    156, 2222226, 2229), 
	   ('Anthony@gmail.com', 'Home Phone', 167, 3333337, 3338),
       ('Customer4@gmail.com', 'Home Phone', 888, 8888888, 8888),
       ('Customer5@gmail.com', 'Home Phone', 999, 9999999, 9999); 

INSERT INTO Customer (FirstName, MiddleName, LastName, Email, Password, Street, City, State, ZipCode, AreaCode, MainNumber, Extension, Username, CreditCardNumber, NameOnCreditCard, CVC, ExpirationMonth, ExpirationYear)
VALUES ('Yan', 'm', 'Chen', 'ylc0006@gmail.com', '1234', 'Street', 'Taipei', 'Taiwan', 106, 111, 1111111, 1111, 'ylc0006@gmail.com', 1111111111111111, 'Yan', 222, 01, 2020),
	('Fred', 'm', 'Yu', 'Fred@gmail.com', '1234', 'Street', 'Sydney', 'Australia', 106, 222, 2222222, 2222, 'Fred@gmail.com', 2222222222222222, 'Fred', 222, 01, 2020),
	('Anthony', 'm', 'Suryabudi', 'Anthony@gmail.com', '1234', 'Street', 'Atlanta', 'USA', 106, 333, 3333333, 3333, 'Anthony@gmail.com', 3333333333333333, 'Anthony', 222, 01, 2020),
    ('Customer4', 'm', 'Tool', 'Customer4@gmail.com', '1234', 'Street', 'Atlanta', 'USA', 106, 888, 8888888, 8888, 'Customer4@gmail.com', 3333333333333333, 'Customer4', 222, 01, 2020),
    ('Customer5', 'm', 'Rent', 'Customer5@gmail.com', '1234', 'Street', 'Atlanta', 'USA', 106, 999, 9999999, 9999, 'Customer5@gmail.com', 3333333333333333, 'Customer5', 222, 01, 2020);

INSERT INTO Tools (Type, SubType, SubOption, PowerSource, Manufacturer, Material, PurchasePrice, Weight, LengthInt,
LengthFraction, LengthUnit, Width_Diameter_Int, Width_Diameter_Fraction, Width_Diameter_Unit)
VALUES ('Power Tool', 'Saw', 'circular', 'cordless', 'Gatech', 'Metal' ,100, 10, 5, 0, 'inch', 6, 0, 'inch'), 
    ('Hand Tool', 'Socket', 'deep', 'manual', 'Gatech', 'Metal' ,200, 20, 10, 0, 'inch', 12, 0, 'inch'),
    ('Garden Tool', 'Pruner', 'sheer', 'manual', 'Gatech', 'Metal' ,50, 10, 5, 0, 'inch', 6, 0, 'inch'),
    ('Ladder Tool', 'Step', 'folding', 'manual', 'Gatech', 'Metal' ,100, 10, 5, 0, 'inch', 6, 0, 'inch' ),
    ('Power Tool', 'Sander', 'finish', 'electric', 'Gatech', 'Metal' ,100, 10, 5, 0, 'inch', 6, 0, 'inch'),
	('Hand Tool', 'Ratchet', 'fixed', 'manual', 'Gatech', 'Metal' ,200, 20, 10, 0, 'inch', 12, 0, 'inch'),
    ('Garden Tool', 'Rakes', 'leaf', 'manual', 'Gatech', 'Metal' ,50, 10, 5, 0, 'inch', 6, 0, 'inch'),
    ('Ladder Tool', 'Step', 'multi-position', 'manual', 'Gatech', 'Metal' ,100, 10, 5, 0, 'inch', 6, 0, 'inch' ),
    ('Power Tool', 'Air Compressor', 'reciprocating', 'gas', 'Gatech', 'Metal' ,100, 10, 5, 0, 'inch', 6, 0, 'inch'),
	('Hand Tool', 'Wrench', 'pipe', 'manual', 'Gatech', 'Metal' ,200, 20, 10, 0, 'inch', 12, 0, 'inch'),
    ('Garden Tool', 'Wheelbarrows', '1 wheel', 'manual', 'Gatech', 'Metal' ,50, 10, 5, 0, 'inch', 6, 0, 'inch'),
    ('Ladder Tool', 'Straight', 'telescoping', 'manual', 'Gatech', 'Metal' ,100, 10, 5, 0, 'inch', 6, 0, 'inch' ),
    ('Power Tool', 'Mixer', 'concrete', 'electric', 'Gatech', 'Metal' ,100, 10, 5, 0, 'inch', 6, 0, 'inch'),
	('Hand Tool', 'Pliers', 'cutting', 'manual', 'Gatech', 'Metal' ,200, 20, 10, 0, 'inch', 12, 0, 'inch'),
    ('Garden Tool', 'Striking', 'tamper', 'manual', 'Gatech', 'Metal' ,50, 10, 5, 0, 'inch', 6, 0, 'inch'),
    ('Power Tool', 'Generator', 'electric', 'gas', 'Gatech', 'Metal' ,100, 10, 5, 0, 'inch', 6, 0, 'inch'),
	('Hand Tool', 'Gun', 'nail', 'manual', 'Gatech', 'Metal' ,200, 20, 10, 0, 'inch', 12, 0, 'inch'),
    ('Hand Tool', 'Hammer', 'claw', 'manual', 'Gatech', 'Metal' ,200, 20, 10, 0, 'inch', 12, 0, 'inch'),
    ('Power Tool', 'Drill', 'driver', 'cordless', 'Gatech', 'Metal' ,100, 10, 5, 0, 'inch', 6, 0, 'inch'),
	('Hand Tool', 'Screwdriver', 'torx', 'manual', 'Gatech', 'Metal' ,200, 20, 10, 0, 'inch', 12, 0, 'inch'),
    ('Garden Tool', 'Digger', 'edger', 'manual', 'Gatech', 'Metal' ,50, 10, 5, 0, 'inch', 6, 0, 'inch'),
    ('Ladder Tool', 'Straight', 'rigid', 'manual', 'Gatech', 'Metal' ,100, 10, 5, 0, 'inch', 6, 0, 'inch' ),
    ('Ladder Tool', 'Straight', 'rigid', 'manual', 'Gatech', 'Metal' ,100, 10, 5, 0, 'inch', 6, 0, 'inch' ),
    ('Ladder Tool', 'Straight', 'rigid', 'manual', 'Gatech', 'Metal' ,100, 10, 5, 0, 'inch', 6, 0, 'inch' ),
    ('Ladder Tool', 'Straight', 'rigid', 'manual', 'Gatech', 'Metal' ,100, 10, 5, 0, 'inch', 6, 0, 'inch' ),
    ('Ladder Tool', 'Straight', 'rigid', 'manual', 'Gatech', 'Metal' ,100, 10, 5, 0, 'inch', 6, 0, 'inch' ),
    ('Ladder Tool', 'Straight', 'rigid', 'manual', 'Gatech', 'Metal' ,100, 10, 5, 0, 'inch', 6, 0, 'inch' ),
    ('Ladder Tool', 'Straight', 'rigid', 'manual', 'Gatech', 'Metal' ,100, 10, 5, 0, 'inch', 6, 0, 'inch' ),
    ('Ladder Tool', 'Straight', 'rigid', 'manual', 'Gatech', 'Metal' ,100, 10, 5, 0, 'inch', 6, 0, 'inch' ),
    ('Ladder Tool', 'Straight', 'rigid', 'manual', 'Gatech', 'Metal' ,100, 10, 5, 0, 'inch', 6, 0, 'inch' ),
    ('Ladder Tool', 'Straight', 'rigid', 'manual', 'Gatech', 'Metal' ,100, 10, 5, 0, 'inch', 6, 0, 'inch' ),
    ('Ladder Tool', 'Straight', 'rigid', 'manual', 'Gatech', 'Metal' ,100, 10, 5, 0, 'inch', 6, 0, 'inch' ),
    ('Ladder Tool', 'Straight', 'rigid', 'manual', 'Gatech', 'Metal' ,100, 10, 5, 0, 'inch', 6, 0, 'inch' ),
    ('Ladder Tool', 'Straight', 'rigid', 'manual', 'Gatech', 'Metal' ,100, 10, 5, 0, 'inch', 6, 0, 'inch' ),
    ('Ladder Tool', 'Straight', 'rigid', 'manual', 'Gatech', 'Metal' ,100, 10, 5, 0, 'inch', 6, 0, 'inch' ),
    ('Ladder Tool', 'Straight', 'rigid', 'manual', 'Gatech', 'Metal' ,100, 10, 5, 0, 'inch', 6, 0, 'inch' ),
    ('Ladder Tool', 'Straight', 'rigid', 'manual', 'Gatech', 'Metal' ,100, 10, 5, 0, 'inch', 6, 0, 'inch' ),
    ('Ladder Tool', 'Straight', 'rigid', 'manual', 'Gatech', 'Metal' ,100, 10, 5, 0, 'inch', 6, 0, 'inch' ),
    ('Ladder Tool', 'Straight', 'rigid', 'manual', 'Gatech', 'Metal' ,100, 10, 5, 0, 'inch', 6, 0, 'inch' ),
    ('Ladder Tool', 'Straight', 'rigid', 'manual', 'Gatech', 'Metal' ,100, 10, 5, 0, 'inch', 6, 0, 'inch' );

INSERT INTO Reservation (Email, PickUp_ClerkID, DropOff_ClerkID, StartDate, EndDate)
VALUES ('Customer4@gmail.com', 1, 1, 20171115, 20171125),
	   ('Customer4@gmail.com', 1, 1, 20171116, 20171125),
	   ('Customer4@gmail.com', 1, 2, 20171117, 20171125),
       ('Customer4@gmail.com', 1, 2, 20171117, 20171126),
       ('Customer5@gmail.com', 2, 2, 20171117, 20171124),
       ('Customer5@gmail.com', 3, 2, 20171118, 20171120),
       ('ylc0006@gmail.com', 3, 3, 20171118, 20171120),
       ('ylc0006@gmail.com', 4, 4, 20171118, 20171119),
       ('ylc0006@gmail.com', 5, 5, 20171118, 20171121),
       ('ylc0006@gmail.com', 3, 3, 20171119, 20171120),
       ('ylc0006@gmail.com', 4, 4, 20171119, 20171121),
       ('ylc0006@gmail.com', 5, 5, 20171119, 20171122),
       ('ylc0006@gmail.com', 3, 3, 20171120, 20171121),
       ('ylc0006@gmail.com', 4, 4, 20171121, 20171122);
    
	
INSERT INTO Reservation (Email, StartDate, EndDate)
VALUES ('Anthony@gmail.com', 20171210, 20171230),
       ('Fred@gmail.com', 20171215, 20171230) ;
       
INSERT INTO Reservation (Email, PickUp_ClerkID, StartDate, EndDate)
VALUES ('Fred@gmail.com', 5, 20171201, 20171230);

INSERT INTO Been (ToolID, ReservationID)
VALUES (1,1), (2,1), (3,1), (4, 1), (5,1),
	   (6,2), (7,2), (8,2), (9,2),
       (10,3), (11,3), (12, 3), (13,3),
       (14,4), (15,4), (16,4), (17,4),
       (18,5), (19,5), (20,5), (21, 5), (22,5),
       (23,6), (24,6), (25,6), (26,6),
       (27,7), (28,7),
       (29,8), (30,8),
       (31,9),
       (32,10),
       (33,11),
       (34,12),
       (35,13),
       (36,14),
       (37,15),
       (38,16),
       (39,17);

INSERT INTO HandTools (ToolID)
VALUES (2),(6),(10),(14),(17),(18),(20);

INSERT INTO Screwdriver (ToolID, ScrewSize)
VALUES (20, 2);

INSERT INTO Socket (ToolID, DriveSize, SaeSize, DeepSocket)
VALUES (2, 0.5, 0.25, 1);

INSERT INTO Ratchet (ToolID, DriveSize)
VALUES (6, 0.5);

INSERT INTO Plier (ToolID, Adjustable)
VALUES (14,0 );

INSERT INTO Gun (ToolID, GaugeRating, Capacity)
VALUES (17, 18,20);

INSERT INTO Hammer (ToolID, AntiVibration)
VALUES (18, 1);

INSERT INTO LadderTools (ToolID, WeightCapacity, StepCount)
VALUES (4, 100, 1),(8,100,1), (12,100,1), (22,100,1), (23,100,1),
        (24,100,1), (25,100,1), (26,100,1), (27,100,1),(28,100,1),
        (29,100,1), (30,100,1), (31,100,1), (32,100,1), (33,100,1),
        (34,100,1), (35,100,1), (36,100,1), (37,100,1), (38,100,1),
        (39,100,1), (40,100,1);

INSERT INTO Straight (ToolID, RubberFeet)
VALUES (12,0), (22,1), (23,1), (24,1), (25,1), (26,1), (27,1), (28,1), (29,1), (30,1),
	    (31,1), (32,1), (33,1), (34,1), (35,1), (36,1), (37,1), (38,1), (39,1), (40,1);


INSERT INTO Step (ToolID, PailShelf)
VALUES (4, 0), (8, 1);

INSERT INTO GardenTools (ToolID, HandleMaterial)
VALUES (3, 'wooden'),(7, 'fiberglass'),(11, 'poly'),(15, 'metal'),(21, 'steel');

INSERT INTO PruningTools(ToolID, BladeMaterial, BladeLength)
VALUES (3, 'steel', 10);

INSERT INTO StrikingTools(ToolID, HeadWeight)
VALUES (15, 3.5);

INSERT INTO DiggingTools(ToolID, BladeWidth, BladeLength)
VALUES (21,10,10);

INSERT INTO RakeTools(ToolID, TineCount)
VALUES (7, 14);

INSERT INTO WheelbarrowTools(ToolID, BinMaterial, BinVolume , WheelCount)
VALUES (11, 'poly', 5, 2);

INSERT INTO PowerTools(ToolID, VoltRating, AmpRating, RPMRatingMin, RPMRatingMax)
VALUES (1, 10, 1, 10, 20), (5, 10,1 , 10, 20),  (9,10,1, 10, 20), (13,10,1, 10, 20), (16,10,1, 10, 20), (19,10,1, 10, 20);

INSERT INTO Generator(ToolID, PowerGenerated)
VALUES (16, 10);

INSERT INTO Drill(ToolID, TorqueRatingMin, TorqueRatingMax, AdjustableClutch)
VALUES (19, 10,20, 1);

INSERT INTO  Saw(ToolID, BladeSize)
VALUES (1,10);

INSERT INTO Sander(ToolID, Dustbag)
VALUES (5, 0);

INSERT INTO AirCompressor(ToolID,PressureRatingMin,PressureRatingMax ,TankSize)
VALUES (9, 10,20, 10);

INSERT INTO  Mixer(ToolID ,MotorRating ,DrumSize)
VALUES (13, 10, 10);

INSERT INTO Accessories(ToolID, AccessoryDescription, Quantity, BatteryType, VoltRating, BatteryQuantity)
VALUES (1, 'Saw Blade', 1, 'NiCd', 5, 5 ), (5, 'Hard Case', 1, null, null, null);

INSERT INTO Contain(ToolID, AccessoryID)
VALUES (1, 1), (5,2);




