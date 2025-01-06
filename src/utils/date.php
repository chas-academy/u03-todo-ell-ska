<?php
function getRelativeDate(string $dateString) {
  $date = new DateTime($dateString);
  $currentDate = new DateTime();

  $differenceDays = (int)$currentDate->diff($date)->format('%R%a');

  switch ($differenceDays) {
    case 0:
      return 'Today';
    case -1:
      return 'Yesterday';
    case 1:
      return 'Tomorrow';
  }

  $year = (int)$date->format('Y');
  $currentYear = (int)$currentDate->format('Y');

  if ($year === $currentYear) {
    return $date->format('M j');
  } else {
    return $date->format('M j Y');
  }
}
