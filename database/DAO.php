<?php
require 'controls/connect.php';

class DAO {

  function __construct($config) {
    $this->db = new Database($config['host'], $config['username'], $config['password'], $config['database']);
  }

  function getUser($api_key) {
    $sql = "SELECT intIdUser
            FROM users
            WHERE strApiKey = ?
              and boolDelete=0";
    return $this->db->query($sql, $api_key);
  }

  function setUser($name, $email, $project_name, $project_description, $api_key) {
    $sql = "INSERT INTO users (strName, strEmail, strProjectName, strProjectDescription, strApiKey)
            VALUES (?, ?, ?, ?, ?)";
    return $this->db->query($sql, $name, $email, $project_name, $project_description, $api_key);
  }

  function existApiKey($api_key) {
    $sql = "SELECT intIdUser
            FROM users
            WHERE strApiKey = ?";
    return $this->db->query($sql, $api_key);
  }

  function getChannels() {
    $sql = "SELECT c.*, s.strName AS strNameStation
            FROM channels c
            JOIN stations s ON s.intIdStation = c.intIdStation
            WHERE c.boolDelete=0
            ORDER BY c.intIdStation ASC, c.intChannelNumber ASC";
    return $this->db->query($sql);
  }

  function getChannel($channel_id) {
    $sql = "SELECT c.strIdChannelStation as id,
                   c.strName as name,
                   s.strName as station
            FROM stations s
            INNER JOIN channels c ON c.intIdStation = s.intIdStation
            WHERE c.strIdChannel = ?
              and s.boolDelete=0 and c.boolDelete=0";
    return $this->db->query($sql, $channel_id);
  }

  function updateLastUsage($api_key) {
    $sql = "UPDATE users
            SET dtaLastUsage=CURRENT_TIMESTAMP
            WHERE strApiKey = ?
              and boolDelete=0";
    return $this->db->query($sql, $api_key);
  }

}

 ?>
