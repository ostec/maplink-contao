<?php
/**
 * CMmapLink
 *
 * Copyright (c) 2014 by ostec
 *
 * @link    https://www.ostec.de
 */
require_once(dirname(__FILE__).'/contaoMapsTrait.php');

class CMmapLink extends Frontend
{
    use contaoMaps;

    /**
     * using by insert tag return map source code
     *
     * @param string $input
     *
     * @return mixed
     */
    protected function mapLink($input)
    {
        $input = explode('::', $input);

        if ($input[0] != 'mapLink') return false;
        if (!$input = explode(',', $input[1])) trigger_error('param not valid', E_USER_ERROR);

        $id    = $input[0];
        $where = is_numeric($id) ? 'id = '.$id : 'name = "'.$id.'"';
        /** @var \Contao\Database\Result $map */
        $map = DATABASE::getInstance()
                       ->query('SELECT * FROM tl_contaoMaps WHERE '.$where)
                       ->fetchAssoc();

        if (is_array($map)) {
            if ($map['useLongitudeAndLatitude']) {
                $map['longitudeAndLatitude'] = implode(',', unserialize($map['longitudeAndLatitude']));
                $adress                      = $map['longitudeAndLatitude'];
            } else {
                $map['adress'] = str_replace(" ", '+', $map['adress']);
                $adress        = $map['adress'];
            }
        } else {
            $map = array(
                'appButton' => true,
            );

            $adress = str_replace(" ", '+', $id);
        }

        $this->import('Environment');
        $this->appButton($map, $adress, $input[1]);

        return $this->map['appButton'];
    }
}