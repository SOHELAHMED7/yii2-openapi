<?php

/**
 * Table for Alldbdatatype
 */
class m200000_000000_create_table_alldbdatatypes extends \yii\db\Migration
{
    public function safeUp()
    {
        $this->createTable('{{%alldbdatatypes}}', [
            'id' => $this->bigPrimaryKey(),
            0 => 'string_col varchar NULL DEFAULT NULL',
            1 => 'varchar_col varchar NULL DEFAULT NULL',
            2 => 'text_col text NULL DEFAULT NULL',
            3 => 'varchar_4_col varchar(4) NULL DEFAULT NULL',
            4 => 'varchar_5_col varchar(5) NULL DEFAULT NULL',
            5 => 'char_4_col char(4) NULL DEFAULT NULL',
            6 => 'char_5_col char NULL DEFAULT NULL',
            7 => 'char_6_col char NOT NULL',
            8 => 'char_7_col char(6) NOT NULL',
            9 => 'char_8_col char NULL DEFAULT \'d\'',
            10 => 'decimal_col decimal(12,3) NULL DEFAULT NULL',
            11 => 'bytea_col_2 bytea NULL DEFAULT NULL',
            12 => 'bit_col bit NULL DEFAULT NULL',
            13 => 'bit_2 bit(1) NULL DEFAULT NULL',
            14 => 'bit_3 bit(64) NULL DEFAULT NULL',
            15 => 'ti smallint NULL DEFAULT NULL',
            16 => 'int2_col int2 NULL DEFAULT NULL',
            17 => 'smallserial_col smallserial NOT NULL',
            18 => 'serial2_col serial2 NOT NULL',
            19 => 'si_col smallint NULL DEFAULT NULL',
            20 => 'si_col_2 smallint NULL DEFAULT NULL',
            21 => 'bi bigint NULL DEFAULT NULL',
            22 => 'bi2 int8 NULL DEFAULT NULL',
            23 => 'int4_col int4 NULL DEFAULT NULL',
            24 => 'bigserial_col bigserial NOT NULL',
            25 => 'bigserial_col_2 serial8 NOT NULL',
            26 => 'int_col int NULL DEFAULT NULL',
            27 => 'int_col_2 integer NULL DEFAULT NULL',
            28 => 'numeric_col numeric NULL DEFAULT NULL',
            29 => 'numeric_col_2 numeric(10) NULL DEFAULT NULL',
            30 => 'numeric_col_3 numeric(10,2) NULL DEFAULT NULL',
            31 => 'double_p_2 double precision NULL DEFAULT NULL',
            32 => 'double_p_3 double precision NULL DEFAULT NULL',
            33 => 'real_col real NULL DEFAULT NULL',
            34 => 'float4_col float4 NULL DEFAULT NULL',
            35 => 'date_col date NULL DEFAULT NULL',
            36 => 'time_col time NULL DEFAULT NULL',
            37 => 'time_col_2 time with time zone NULL DEFAULT NULL',
            38 => 'time_col_3 time without time zone NULL DEFAULT NULL',
            39 => 'time_col_4 time(3) without time zone NULL DEFAULT NULL',
            40 => 'timetz_col timetz NULL DEFAULT NULL',
            41 => 'timetz_col_2 timetz(3) NULL DEFAULT NULL',
            42 => 'timestamp_col timestamp NULL DEFAULT NULL',
            43 => 'timestamp_col_2 timestamp with time zone NULL DEFAULT NULL',
            44 => 'timestamp_col_3 timestamp without time zone NULL DEFAULT NULL',
            45 => 'timestamp_col_4 timestamp(3) without time zone NULL DEFAULT NULL',
            46 => 'timestamptz_col timestamptz NULL DEFAULT NULL',
            47 => 'timestamptz_col_2 timestamptz(3) NULL DEFAULT NULL',
            48 => 'date2 date NULL DEFAULT NULL',
            49 => 'timestamp_col_z timestamp NULL DEFAULT NULL',
            50 => 'bit_varying bit varying NULL DEFAULT NULL',
            51 => 'bit_varying_n bit varying(8) NULL DEFAULT NULL',
            52 => 'bit_varying_n_2 varbit NULL DEFAULT NULL',
            53 => 'bit_varying_n_3 varbit(3) NULL DEFAULT NULL',
            54 => 'bool_col boolean NULL DEFAULT NULL',
            55 => 'bool_col_2 bool NULL DEFAULT NULL',
            56 => 'box_col box NULL DEFAULT NULL',
            57 => 'character_col character NULL DEFAULT NULL',
            58 => 'character_n character(12) NULL DEFAULT NULL',
            59 => 'character_varying character varying NULL DEFAULT NULL',
            60 => 'character_varying_n character varying(12) NULL DEFAULT NULL',
            61 => 'json_col json NOT NULL',
            62 => 'jsonb_col jsonb NOT NULL',
            63 => 'json_col_def json NOT NULL DEFAULT \'[]\'',
            64 => 'json_col_def_2 json NOT NULL DEFAULT \'[]\'',
            65 => 'bytea_def bytea NULL DEFAULT \'the bytea blob default\'',
            66 => 'text_def text NULL DEFAULT \'the text\'',
            67 => 'json_def json NOT NULL DEFAULT \'{"a":"b"}\'',
            68 => 'jsonb_def jsonb NOT NULL DEFAULT \'{"ba":"bb"}\'',
            69 => 'cidr_col cidr NULL DEFAULT NULL',
            70 => 'circle_col circle NULL DEFAULT NULL',
            71 => 'date_col_z date NULL DEFAULT NULL',
            72 => 'float8_col float8 NULL DEFAULT NULL',
            73 => 'inet_col inet NULL DEFAULT NULL',
            74 => 'interval_col interval NULL DEFAULT NULL',
            75 => 'interval_col_2 interval year NULL DEFAULT NULL',
            76 => 'interval_col_3 interval day to second(3) NULL DEFAULT NULL',
            77 => 'line_col line NULL DEFAULT NULL',
            78 => 'lseg_col lseg NULL DEFAULT NULL',
            79 => 'macaddr_col macaddr NULL DEFAULT NULL',
            80 => 'money_col money NULL DEFAULT NULL',
            81 => 'path_col path NULL DEFAULT NULL',
            82 => 'pg_lsn_col pg_lsn NULL DEFAULT NULL',
            83 => 'point_col point NULL DEFAULT NULL',
            84 => 'polygon_col polygon NULL DEFAULT NULL',
            85 => 'serial_col serial NOT NULL',
            86 => 'serial4_col serial4 NOT NULL',
            87 => 'tsquery_col tsquery NULL DEFAULT NULL',
            88 => 'tsvector_col tsvector NULL',
            89 => 'txid_snapshot_col txid_snapshot NULL DEFAULT NULL',
            90 => 'uuid_col uuid NULL DEFAULT NULL',
            91 => 'xml_col xml NULL DEFAULT NULL',
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%alldbdatatypes}}');
    }
}
