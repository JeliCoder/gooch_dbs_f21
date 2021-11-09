

SET @payment_amount = 900.0;

DROP FUNCTION IF EXISTS balance_of_holder;

CREATE FUNCTION balance_of_holder (holder_name CHAR(16))
RETURNS FLOAT
RETURN (
    SELECT account_balance
        FROM accounts  
            WHERE 
)

DELIMITER //
START TRANSACTION;

IF 

UPDATE accounts
    SET account_balance = account_balance - @payment_amount 
    WHERE account_holder = 'Alice';

    UPDATE accounts
    SET account_balance = account_balance + @payment_amount
    WHERE account_holder = 'Bob';

END IF;

COMMIT; //
DELIMITER ;