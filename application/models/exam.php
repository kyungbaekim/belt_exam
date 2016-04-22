<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exam extends CI_Model {

  function get_user_by_username($username){
    $query = "SELECT * FROM users WHERE username = '{$username}'";
    return $this->db->query($query)->row_array();
  }

  function get_user_by_id($id){
    $query = "SELECT * FROM users WHERE id = '{$id}'";
    return $this->db->query($query)->row_array();
  }

  function add_user($name, $username, $password){
    $query = "INSERT INTO users (name, username, password, created_at) VALUES ('{$name}', '{$username}', '{$password}', NOW())";
    return $this->db->query($query);
  }

  function add_travel($user_id, $destination, $description, $startdate, $enddate){
    $query = "INSERT INTO trip_schedules (user_id, destination, description, startdate, enddate, created_at) VALUES ('{$user_id}', '{$destination}', '{$description}', '{$startdate}', '{$enddate}', NOW())";
    return $this->db->query($query);
  }

  function get_all_travel(){
    $query = "SELECT users.id AS user_id, users.name, trip_schedules.id AS trip_id, trip_schedules.destination, trip_schedules.startdate, trip_schedules.enddate, trip_schedules.description, join_trips.user_id AS join_id FROM users
              LEFT JOIN trip_schedules
              ON users.id = trip_schedules.user_id
              LEFT JOIN join_trips
              ON trip_schedules.id = join_trips.trip_schedule_id";
    return $this->db->query($query)->result_array();
  }

  function get_travel_by_id($id){
    $query = "SELECT users.id AS user_id, users.name, trip_schedules.id AS trip_id, trip_schedules.destination, trip_schedules.startdate, trip_schedules.enddate, trip_schedules.description, join_trips.user_id AS join_id FROM users
              LEFT JOIN trip_schedules
              ON users.id = trip_schedules.user_id
              LEFT JOIN join_trips
              ON trip_schedules.id = join_trips.trip_schedule_id
              WHERE trip_schedules.id = '{$id}'";
    return $this->db->query($query)->row_array();
  }

  function get_joined_users($travel_id){
    $query = "SELECT users.name, join_trips.user_id, users2.name FROM users
              LEFT JOIN trip_schedules
              ON users.id = trip_schedules.user_id
              LEFT JOIN join_trips
              ON trip_schedules.id = join_trips.trip_schedule_id
              LEFT JOIN users as users2
              ON join_trips.user_id = users2.id
              WHERE trip_schedules.id = '{$travel_id}'";
    return $this->db->query($query)->result_array();
  }

  function join_travel($user_id, $travel_id){
    $query = "INSERT INTO join_trips (trip_schedule_id, user_id) VALUES ('{$travel_id}', '{$user_id}')";
    return $this->db->query($query);
  }
}
