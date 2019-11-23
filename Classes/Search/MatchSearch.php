<?php
namespace System25\T3sports\Search;

/**
 * *************************************************************
 * Copyright notice
 *
 * (c) 2008-2019 Rene Nitzsche
 * Contact: rene@system25.de
 * All rights reserved
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 * *************************************************************
 */
define('MATCHSRV_FIELD_MATCH_COMPETITION', 'MATCH.COMPETITION');
define('MATCHSRV_FIELD_MATCH_ROUND', 'MATCH.ROUND');
define('MATCHSRV_FIELD_MATCH_DATE', 'MATCH.DATE');

/**
 * Class to search matches from database
 *
 * @author Rene Nitzsche
 */
class MatchSearch extends \tx_rnbase_util_SearchBase
{

    protected function getTableMappings()
    {
        $tableMapping = [];
        $tableMapping['MATCH'] = 'tx_cfcleague_games';
        $tableMapping['COMPETITION'] = 'tx_cfcleague_competition';
        $tableMapping['TEAM1'] = 't1';
        $tableMapping['TEAM2'] = 't2';
        // Hook to append other tables
        \tx_rnbase_util_Misc::callHook('cfc_league_fe', 'search_Match_getTableMapping_hook', array(
            'tableMapping' => &$tableMapping
        ), $this);
        return $tableMapping;
    }

    protected function getBaseTable()
    {
        return 'tx_cfcleague_games';
    }

    function getWrapperClass()
    {
        return 'tx_cfcleaguefe_models_match';
    }

    protected function getJoins($tableAliases)
    {
        $join = '';
        if (isset($tableAliases['COMPETITION'])) {
            $join .= ' JOIN tx_cfcleague_competition ON tx_cfcleague_games.competition = tx_cfcleague_competition.uid AND tx_cfcleague_competition.deleted=0 AND tx_cfcleague_competition.hidden=0';
        }
        if (isset($tableAliases['TEAM1'])) {
            $join .= ' INNER JOIN tx_cfcleague_teams As t1 ON tx_cfcleague_games.home = t1.uid ';
        }
        if (isset($tableAliases['TEAM2'])) {
            $join .= ' INNER JOIN tx_cfcleague_teams As t2 ON tx_cfcleague_games.guest = t2.uid ';
        }
        // Hook to append other tables
        \tx_rnbase_util_Misc::callHook('cfc_league_fe', 'search_Match_getJoins_hook', array(
            'join' => &$join,
            'tableAliases' => $tableAliases
        ), $this);
        return $join;
    }
}

