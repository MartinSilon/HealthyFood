<?php
$datum = date('Y-m-d');

//Vytvorenie tabuľky DRUH
    $sql_createTable = "
            CREATE TABLE IF NOT EXISTS druh (
                id TINYINT(1),
                druh CHAR(5),
                PRIMARY KEY (id)
            );
        ";
    mysqli_query($conn, $sql_createTable);
//INSERT do DRUH
    $sql_insertData = "
            INSERT INTO druh (id, druh) 
                SELECT * FROM (SELECT '1', 'jedlo') AS tmp
                WHERE NOT EXISTS (
                    SELECT id FROM druh WHERE id = '1'
                )
            UNION ALL
                SELECT * FROM (SELECT '2', 'napoj') AS tmp
                WHERE NOT EXISTS (
                    SELECT id FROM druh WHERE id = '2'
                )
            ";
    mysqli_query($conn, $sql_insertData);


//Vytvorenie tabuľky JEDLA
    $sql_createTable = "
            CREATE TABLE IF NOT EXISTS jedla (
                id INT AUTO_INCREMENT,
                id_uzivatela INT,
                nazov VARCHAR(15),
                kalorie SMALLINT,
                bielkoviny TINYINT,
                sacharidy TINYINT,
                objem DECIMAL(3,2),
                druh TINYINT(1),
                datum DATE,
                cas_vytvorenia TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id)
            );
            
        ";
    mysqli_query($conn, $sql_createTable);

//Vytvorenie tabuľky ÚDAJE
    $sql_createTable = "
            CREATE TABLE IF NOT EXISTS udaje (
                id INT AUTO_INCREMENT,
                id_uzivatela INT,
                max_kalorie SMALLINT,
                max_bielkoviny SMALLINT,
                max_sacharidy SMALLINT,
                max_voda DECIMAL(3,2),
                cas_vytvorenia TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id)
            );
        ";
    mysqli_query($conn, $sql_createTable);

//Vytvorenie tabuľky UŽÍVATELIA
$sql_createTable = "
            CREATE TABLE IF NOT EXISTS uzivatelia (
                id INT AUTO_INCREMENT,
                meno varchar(50),
                email VARCHAR(100),
                password VARCHAR(50),
                birth DATE,
                cas_registracie TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id)
            );
        ";
mysqli_query($conn, $sql_createTable);

