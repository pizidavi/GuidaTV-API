<?php

class Sky {

  private $website = 'https://guidatv.sky.it';
  private $url = "https://apid.sky.it/gtv/v1/events?from={}&to={}&channels={}&pageSize=999&pageNum=0&env=DTH";

  public function getSchedule($channel_id, $channel_name, $date) {
    $from = date("Y-m-d", strtotime($date)).'T00:00:01Z';
    $to = date("Y-m-d", strtotime($date."+1 day")).'T23:59:59Z';

    $url = str_format($this->url, $from, $to, $channel_id);
    $file = json_decode(file_get_contents($url), True);
    if ($file == False) {
      return False; }

    $schedule = [
      "name" => $channel_name,
      "date" => $date,
      "events" => []
    ];

    foreach ($file["events"] as $e) {
      $event = [];
      $event["name"] = $e["eventTitle"] != NULL ? $e["eventTitle"] : $e["content"]["contentTitle"];
      $event["description"] = $e["eventSynopsis"];
      $event["genres"] = [ $e["content"]["genre"]["name"], $e["content"]["subgenre"]["name"] ];

      $start = strtotime($e["starttime"]);
      $end = strtotime($e["endtime"]);

      $event["hour"] = date("H:i", $start);

      $seconds = $end - $start;
      $hours = floor($seconds / 3600);
      $mins = floor($seconds / 60 % 60);
      $secs = floor($seconds % 60);
      $event["duration"] = sprintf("%02d:%02d:%02d", $hours, $mins, $secs);
      $event["duration_in_minutes"] = (int)round($seconds/60, 0);

      $cover = array_search('cover', array_column($e["content"]["imagesMap"], 'key'));
      $event["image"] = ($cover !== False ? $this->website.$e["content"]["imagesMap"][$cover]['img']['url'] : NULL);

      /*$event["is_show"] = $e["content"]["episodeNumber"] > 0 ? True : False;
      if ($event["is_show"] == True) {
        $event["episode"] = (int)$e["content"]["episodeNumber"];
        $event["episode_title"] = $e["content"]["contentTitle"];
        $event["season"] = (int)$e["content"]["seasonNumber"];  // Can be null
      }*/

      $schedule["events"][] = $event;
    }

    return $schedule;
  }
}

 ?>
