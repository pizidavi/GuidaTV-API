<?php

class RAI {

  private $website = "https://www.raiplay.it";
  private $url = "https://www.raiplay.it/palinsesto/app/{}/{}.json";

  public function getSchedule($channel_id, $channel_name, $date) {
    $url = str_format($this->url, $channel_id, $date);
    $file = json_decode(file_get_contents($url), True);
    if ($file == NULL) {
      return NULL; }

    $schedule = [
      "name" => $file["channel"],
      "date" => $file["date"],
      "events" => []
    ];

    foreach ($file["events"] as $e) {
      $event = [];
      $event["name"] = $e["name"];
      $event["description"] = $e["description"];

      $program = json_decode(file_get_contents($this->website.$e["program"]["path_id"]), True);
      $event["genres"] = array_column($program["program_info"]["genres"], "nome");

      $event["hour"] = $e["hour"];
      $event["duration"] = $e["duration"];
      $event["duration_in_minutes"] = (int)str_replace(" min", "", $e["duration_in_minutes"]);

      $event["image"] = $this->website.$e["image"];

      $schedule["events"][] = $event;
    }

    return $schedule;
  }
}

 ?>
