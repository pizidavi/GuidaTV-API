<?php

class Mediaset {

  private $website = NULL;
  private $url = "https://api-ott-prod-fe.mediaset.net/PROD/play/alive/allListingFeedEpg/v1.0?byListingTime={}~{}&byCallSign={}";

  public function getSchedule($channel_id, $channel_name, $date) {
    $from = strtotime($date)."000";
    $to = strtotime($date." +1 day")."000";

    $url = str_format($this->url, $from, $to, $channel_id);
    $file = json_decode(file_get_contents($url), True);
    if ($file == False || $file["isOk"] == False) {
      return NULL; }

    $schedule = [
      "name" => $channel_name,
      "date" => date("d-m-Y", strtotime($file["time"])),
      "events" => []
    ];

    $events = $file["response"]["entries"][0]["listings"];
    foreach ($events as $e) {
      $event = [];
      $event["name"] = $e['mediasetlisting$epgTitle'];
      $event["description"] = $e["description"];
      $event["genres"] = $e["program"]['mediasetprogram$genres'];

      $event["hour"] = date('H:i', (int)$e["startTime"]/1000);

      $seconds = (int)$e["program"]['mediasetprogram$duration'];
      $hours = floor($seconds / 3600);
      $mins = floor($seconds / 60 % 60);
      $secs = floor($seconds % 60);
      $event["duration"] = sprintf("%02d:%02d:%02d", $hours, $mins, $secs);
      $event["duration_in_minutes"] = (int)round($seconds/60, 0);

      $image = NULL;
      foreach ($e["program"]['thumbnails'] as $key => $value) {
        if (strpos($key, 'vertical') !== False) {
          $image = $value['url'];
          break; }
      }
      $event["image"] = $image;

      $schedule["events"][] = $event;
    }

    return $schedule;
  }
}

 ?>
