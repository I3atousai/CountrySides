<?php

namespace App\Model;

use App\DB\DB;

abstract class ModelBase
{
    public static $table;

    public static function get_all(): array|null
    {
        try {
            $connect = DB::connect();
            $table = static::$table; // название таблицы
            $sql = "SELECT * FROM $table";
            $req = $connect->prepare($sql);
            $req->execute();
            return $req->fetchAll();
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return null;
        }
    }

    public static function count(): int|null
    {
        try {
            $connect = DB::connect();
            $table = static::$table; // название таблицы
            $sql = "SELECT COUNT(*) as count FROM $table";
            $req = $connect->prepare($sql);
            $req->execute();
            $res = $req->fetch();
            if ($res) {
                return $res["count"];
            }
            return null;
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return null;
        }
    }

    public static function get_one(int $id): array|null
    {
        try {
            $connect = DB::connect();
            $table = static::$table; // название таблицы
            $sql = "SELECT * FROM $table WHERE id = :id";
            $req = $connect->prepare($sql);
            $req->execute(params: ["id" => $id]);
            return $req->fetch();
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return null;
        }
    }


    public static function add(array $data, string $mode = "count"): int|null
    {
        try {
            $connect = DB::connect();
            $table = static::$table; // название таблицы
            $sql = "INSERT INTO $table ";
            $keys = array_keys($data);
            $count_keys = count($keys);
            $keys_str = implode(",", $keys);
            $sql .= " ($keys_str) VALUES (";
            for ($i = 0; $i < $count_keys; $i++) {
                $sql .= "?,";
            }
            $sql = substr($sql, 0, -1); // убираем лишнюю ,
            $sql .= ")";

            $req = $connect->prepare($sql);
            $req->execute(array_values($data));
            if ($mode == "id") {
                return $connect->lastInsertId();
            } else if ($mode == "count") {
                return $req->rowCount();
            }
            return null;
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return null;
        }
    }

    public static function delete(array $params = []): int|null
    {
        try {
            $exec = [];
            $table = static::$table;
            $sql = "DELETE FROM $table ";
            if ($params) { // если параметры есть
                $sql .= " WHERE ";
                foreach ($params as $param) {
                    $key = $param[0];
                    $oper = $param[1];
                    $value = $param[2];
                    $type_value = $param[3];
                    $logic = isset($param[4]) ? $param[4] : ""; // лог оператор
                    if ($type_value == 'system') {
                        $sql .= " $key $oper $value $logic";
                    } else if ($type_value == 'value') {
                        array_push($exec, $value);
                        $sql .= " $key $oper ? $logic";
                    }
                }
            }
            $connect = DB::connect();
            $req = $connect->prepare($sql);
            $req->execute($exec);
            return $req->rowCount();
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return null;
        }
    }

    public static function update(array $data, array $params = [])
    {
        try {
            $table = static::$table;
            $sql = "UPDATE $table SET ";
            $exec = [];
            foreach ($data as $key => $value) {
                $sql .= "$key = ?,";
                array_push($exec, $value);
            }
            $sql = substr($sql, 0, -1);
            if ($params) {
                $sql .= " WHERE ";
                foreach ($params as $param) {
                    $key = $param[0];
                    $oper = $param[1];
                    $value = $param[2];
                    $type_value = $param[3];
                    $logic = isset($param[4]) ? $param[4] : ""; // лог оператор
                    if ($type_value == 'system') {
                        $sql .= " $key $oper $value $logic";
                    } else if ($type_value == 'value') {
                        array_push($exec, $value);
                        $sql .= " $key $oper ? $logic";
                    }
                }
            }
            $connect = DB::connect();
            $req = $connect->prepare($sql);
            $req->execute($exec);
            $connect = null;
            return $req->rowCount();
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return null;
        }
    }

    // SELECT (что взять...) FROM (таблицы ?JOIN?) (WHERE ключ оператор значение (лог оператор) ) (SORTED BY колонка тип сортировки) (LIMIT OFFSET)
    public static function query(array $get, string $fetch_mode = "all", array $tables = [], array $params = [], array $sorted = [], int|null $limit = null, int|null $offset = null)
    {
        try {
            $sql = "SELECT ";
            $exec = [];
            $table = static::$table;
            $sql .= implode(",", $get);
            $sql .= " FROM ";
            if ($tables) {
                $sql .= implode(" JOIN ", $tables);
            } else {
                $sql .= " $table ";
            }
            if ($params) {
                $sql .= " WHERE ";
                foreach ($params as $param) {
                    $key = $param[0];
                    $oper = $param[1];
                    $value = $param[2];
                    $type_value = $param[3];
                    $logic = isset($param[4]) ? $param[4] : ""; // лог оператор
                    if ($type_value == 'system') {
                        $sql .= " $key $oper $value $logic ";
                    } else if ($type_value == 'value') {
                        array_push($exec, $value);
                        $sql .= " $key $oper ? $logic ";
                    }
                }
            }
            if ($sorted) {
                $sql .= " ORDER BY {$sorted['col']} {$sorted['type']} ";
            }
            if ($limit) {
                $sql .= " LIMIT $limit ";
            }
            if ($offset) {
                $sql .= " OFFSET $offset ";
            }
            $connect = DB::connect();
            $req = $connect->prepare($sql);
            $req->execute($exec);
            $connect = null;
            if ($fetch_mode == "all") {
                return $req->fetchAll();
            } else if ($fetch_mode == "one") {
                return $req->fetch();
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return null;
        }
    }
}
