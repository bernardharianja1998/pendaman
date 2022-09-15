<?php
require_once __DIR__ . 'database.php';

function insert($table, $value, $row = null)
{
    $insert = " INSERT INTO " . $table;
    if ($row != null) {
        $insert .= " (" . $row . " ) ";
    }
    for ($i = 0; $i < count($value); $i++) {
        if (is_string($value[$i])) {
            $value[$i] = '"' . $value[$i] . '"';
        }
    }
    $value = implode(',', $value);
    $insert .= ' VALUES (' . $value . ')';
    $ins = $mysqli->query($insert);
    if ($ins) {
        return true;
    } else {
        return false;
    }
}

function delete($table, $where = null)
{
    if ($where == null) {
        $delete = "DELETE " . $table;
    } else {
        $delete = "DELETE  FROM " . $table . " WHERE " . $where;
    }
    $del = $mysqli->query($delete);
    if ($del) {
        return true;
    } else {
        return false;
    }
}

function update($table, $rows, $where)
{
    // Parse the where values
    // even values (including 0) contain the where rows
    // odd values contain the clauses for the row
    for ($i = 0; $i < count($where); $i++) {
        if ($i % 2 != 0) {
            if (is_string($where[$i])) {
                if (($i + 1) != null)
                    $where[$i] = '"' . $where[$i] . '" AND ';
                else
                    $where[$i] = '"' . $where[$i] . '"';
            }
        }
    }
    $where = implode(" ", $where);


    $update = 'UPDATE ' . $table . ' SET ';
    $keys = array_keys($rows);
    for ($i = 0; $i < count($rows); $i++) {
        if (is_string($rows[$keys[$i]])) {
            $update .= $keys[$i] . '="' . $rows[$keys[$i]] . '"';
        } else {
            $update .= $keys[$i] . '=' . $rows[$keys[$i]];
        }

        // Parse to add commas
        if ($i != count($rows) - 1) {
            $update .= ',';
        }
    }
    $update .= ' WHERE ' . $where;
    $query = $mysqli->query($update);
    if ($query) {
        return true;
    } else {
        return false;
    }
}
