<?php
class EMFinfo{
    public static function getFinfos($path){
        $listOfLogs=array();
        $tmpLogs=array_values(array_diff(scandir($path), array('..', '.')));
        foreach ($tmpLogs as $key=>$log) {
            $listOfLogs[$key]['Name']=$log;
            $listOfLogs[$key]['Path']=$path.DIRECTORY_SEPARATOR.$log;
            $listOfLogs[$key]['FileSize']=filesize($listOfLogs[$key]['Path']);
            $listOfLogs[$key]['FileLastAccessTime']=fileatime($listOfLogs[$key]['Path']);
            $listOfLogs[$key]['FileLastModifyTime']=filectime($listOfLogs[$key]['Path']);
        }
        return $listOfLogs;
    }
}
