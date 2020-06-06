<?php if (!defined('TYPO3_MODE')) {
    die('Access denied.');
} ?>
<?php
  // Teaseransicht einer Ligatabelle
  // Wir zeigen nur die Tabellenposition und den Namen des Teams

//  tx_div::load('tx_rnbase_util_FormUtil');
  $viewData = &$configurations->getViewData();
  $pointSystem = $viewData->offsetGet('tablePointSystem'); // Das verwendete Punktesystem holen

  $league = $viewData->offsetGet('league'); // Die aktuelle Liga
  $marks = $league->getTableMarks();

?>



<div class="cfcleague-teaser">
<?php
  $data = $viewData->offsetGet('tableData');

  // Es werden nur 5 Teams gezeigt, dabei wird das markierte Team in die Mitte gesetzt
  // Suche des Tabellenplatz des markierten Teams
  $cnt = 0;
  $mark = 0;
  foreach ($data as $row) {
      if ($row['markClub']) {
          $markIdx = $cnt;
          $mark = 1;

          break;
      }
      ++$cnt;
  }
  if ($mark) {
      $teams2Show = 5;
      $offsetStart = intval($teams2Show / 2);
      $idxStart = ($markIdx - $offsetStart) >= 0 ? $markIdx - $offsetStart : 0;
      $idxEnd = $idxStart + $teams2Show;
      // Am Tabellenende nachregulieren
      if ($idxEnd > count($data)) {
          $idxEnd = count($data);
          $idxStart = $idxEnd - $teams2Show;
      }
  }

  $cnt = 0;
  for ($cnt = 0; $cnt < count($data); ++$cnt) {
      $row = $data[$cnt];
      if ($mark && !($cnt >= $idxStart && $cnt < $idxEnd)) {
          continue;
      } ?>
<p class="<?php if ($row['markClub']) { ?>rowTeam-teaser<?php } ?>">
  <?php echo $cnt + 1; ?>. <?php echo $row['teamNameShort']; ?><br />
</p>
<?php
  } // Close foreach
?>
</div>


