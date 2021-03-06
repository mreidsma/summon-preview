<?php

header("Access-Control-Allow-Origin: *");

/*

Summon Preview Tracker
v 0.1a - 4/7/2014
by Matthew Reidsma, reidsmam@gvsu.edu
for Grand Valley State University

Quick and dirty script to test how often the Summon preview banner is:

* shown
* hidden
* clicked for preview
* clicked for feedback

I should use Google Analytics for this but I think it is showing 1.0 and 2.0
together on the same account so I can't be sure that I'm getting an accurate
count of the number of shows.

URL structure:

/show/yes
/show/no
/click/preview
/click/feedback
/click/close

*/

// First, parse the URL into little parts

$navString = $_SERVER['REQUEST_URI'];

$parts = explode('/', $navString); // Break into an array
$now = time();
$data = array($now, $parts[3], $parts[4]);

if (!$DataFile = fopen("preview.csv", "a")) {echo "Failure: cannot open file"; die;};

// Is the banner showing? Track yes and track no (hidden)

if($parts[3] == 'show') {

  if($parts[4] == 'yes') {
    if (!fputcsv($DataFile, $data)) {echo "Failure: cannot write to file"; die;};
  } else {
    if (!fputcsv($DataFile, $data)) {echo "Failure: cannot write to file"; die;};
  }

}

if($parts[3] == 'click') {

  if($parts[4] == 'close') {
    // Clicked to hide banner?
    if (!fputcsv($DataFile, $data)) {echo "Failure: cannot write to file"; die;};
  }

  if($parts[4] == 'preview') {
    // Clicked to show preview?
    if (!fputcsv($DataFile, $data)) {echo "Failure: cannot write to file"; die;};
  }

  if($parts[4] == 'feedback') {
    // Clicked to Give feedback?
    if (!fputcsv($DataFile, $data)) {echo "Failure: cannot write to file"; die;};
  }
}
