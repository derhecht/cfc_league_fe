<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2008-2010 Rene Nitzsche (rene@system25.de)
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

// Die Datenbank-Klasse

/**
 * Implementors provide data necessary to compute league tables.
 */
interface tx_cfcleaguefe_util_league_TableProvider
{
    /**
     * Points for a winning match.
     *
     * @return int
     */
    public function getPointsWin();

    /**
     * Points for a draw match.
     *
     * @return int
     */
    public function getPointsDraw();

    /**
     * Points for a lost match.
     *
     * @return int
     */
    public function getPointsLoose();

    /**
     * Whether or not negative points of lost matches should be count. This is in case
     * if 2-point-system is used.
     *
     * @return boolean
     */
    public function isCountLoosePoints();

    /**
     * Draw a chart for teams of defined clubs. Only if chart is computed.
     *
     * @return array[int] UIDs of tx_cfcleaguefe_models_club
     */
    public function getChartClubs();

    /**
     * Highlight some teams in table.
     *
     * @return array[int] UIDs of tx_cfcleaguefe_models_club
     */
    public function getMarkClubs();

    /**
     * Tabletype means home or away matches only
     * 1 - home matches
     * 2 - away matches
     * 0 - all matches.
     *
     * @return int
     */
    public function getTableType();

    /**
     * Match penalties to handle.
     *
     * @return array[tx_cfcleaguefe_models_penalty]
     */
    public function getPenalties();

    /**
     * Name of compare method.
     * Es gibt die normale compareTeams() und die compareTeamsH2H für den Head-to-head modus. In letzterem
     * Fall zählt bei Punktgleichheit zuerst der direkte Vergleich gegeneinander.
     *
     * @return string name
     */
    public function getCompareMethod();

    /**
     * Teams to handle.
     *
     * @return array[tx_cfcleaguefe_models_team]
     */
    public function getTeams();

    /**
     * Matches sorted by rounds.
     *
     * @return array[int][tx_cfcleaguefe_models_match]
     */
    public function getRounds();

    /**
     * Returns the number of all round. This is used for chart generation.
     *
     * @return int
     */
    public function getMaxRounds();

    /**
     * Return a unique key for a given team. This is not necessarily the uid of the team. Maybe it is
     * wanted to join some team results.
     *
     * @param tx_cfcleaguefe_models_team $team
     */
    public function getTeamId($team);
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/cfc_league_fe/util/league/class.tx_cfcleaguefe_util_league_TableProvider.php']) {
    include_once $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/cfc_league_fe/util/league/class.tx_cfcleaguefe_util_league_TableProvider.php'];
}
